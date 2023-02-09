import "./bootstrap";

import IMask from "imask";

import Leaflet from "leaflet";
import "leaflet/dist/leaflet.css";

import Swal from "sweetalert2";
import "sweetalert2/src/sweetalert2.scss";

let map;

const setMapMarkerAndIcon = (lat, lng) => {
    Leaflet.marker([lat, lng]).addTo(map);

    // Leaflet.icon({
    //     iconUrl: myIcon,
    // });
};

function init() {
    var map_div = document.querySelector("#map");

    if (map_div) {
        map = Leaflet.map("map").setView([37.5, 37], 6);

        Leaflet.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        var get_location_button = document.querySelector("#get_location");

        if (get_location_button) {
            get_location_button.addEventListener("click", getLocation);
        }
    }

    var set_location = document.querySelector("#set_location");

    if (set_location) {
        var [lat, lng] = set_location.value.split(",");

        setMapMarkerAndIcon(lat, lng);

        map.setView([lat, lng], 13);
    } else {
        getLocation();
    }

    var telInput = document.querySelector("#tel");

    if (telInput) {
        IMask(telInput, {
            mask: "(000) 000-00-00",
        });
    }

    getIlceler();
    getMahalleler();
    getSokaklar();
    sendForm();

    var started_id = localStorage.getItem("started_help_id");
    if (started_id && started_id == location.pathname.split("/")[2]) {
        var remove_started = document.querySelectorAll(".remove-started");
        remove_started.forEach((item) => item.remove());

        var show_started = document.querySelectorAll(".show-started");
        show_started.forEach((item) => (item.style.display = "block"));
    } else {
        startHelp();
    }

    helpFinished();
    helpCancel();
}

init();

function getIlceler() {
    var sehir = document.querySelector("#sehirInput");
    var ilce_input = document.querySelector("#ilceInput");

    if (!sehir || !ilce_input) {
        return false;
    }

    sehir.addEventListener("change", function () {
        if (this.value == "Şehir") {
            clearIlceInput();
            return false;
        }

        fetch("/api/get-country-data?type=ilceler&sehir=" + this.value)
            .then((res) => res.json())
            .then((data) => {
                clearIlceInput();
                data.forEach((item) => {
                    ilce_input.innerHTML += `<option value="${item.ilce_key}">${item.ilce_title}</option>`;
                });
            });
    });

    const clearIlceInput = () => {
        ilce_input.removeAttribute("disabled");
        ilce_input.innerHTML = "<option selected>İlçe</option>";
    };
}

function getMahalleler() {
    var ilce_input = document.querySelector("#ilceInput");
    var mahalle_input = document.querySelector("#mahalleInput");

    if (!ilce_input || !mahalle_input) {
        return false;
    }

    ilce_input.addEventListener("change", function () {
        if (this.value == "İlçe") {
            clearMahalleInput();
            return false;
        }

        fetch("/api/get-country-data?type=mahalle&ilce=" + this.value)
            .then((res) => res.json())
            .then((data) => {
                clearMahalleInput();
                data.forEach((item) => {
                    mahalle_input.innerHTML += `<option value="${item.mahalle_key}">${item.mahalle_title}</option>`;
                });
            });
    });

    const clearMahalleInput = () => {
        mahalle_input.removeAttribute("disabled");
        mahalle_input.innerHTML = "<option selected>Mahalle</option>";
    };
}

function getSokaklar() {
    var mahalle_input = document.querySelector("#mahalleInput");
    var sokak_input = document.querySelector("#sokakInput");

    if (!mahalle_input || !sokak_input) {
        return false;
    }

    mahalle_input.addEventListener("change", function () {
        if (this.value == "Mahalle") {
            clearSokakInput();
            return false;
        }

        fetch("/api/get-country-data?type=sokak&mahalle=" + this.value)
            .then((res) => res.json())
            .then((data) => {
                clearSokakInput();
                data.forEach((item) => {
                    sokak_input.innerHTML += `<option value="${item.sokak_cadde_id}">${item.sokak_cadde_title}</option>`;
                });
            });
    });

    const clearSokakInput = () => {
        sokak_input.removeAttribute("disabled");
        sokak_input.innerHTML = "<option selected>Sokak</option>";
    };
}

function sendForm() {
    var form = document.querySelector("form");

    if (!form) {
        return false;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData = Object.fromEntries(formData.entries());

        fetch(this.getAttribute("action"), {
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                "X-CSRF-Token": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify(formData),
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Başarılı!",
                        text: res.message,
                        confirmButtonText: "Kapat",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Lütfen boş alan bırakmayın!",
                        confirmButtonText: "Kapat",
                    });
                }
            });
    });
}

function getLocation() {
    // var local_coords = JSON.parse(localStorage.getItem("coords"));
    // if (local_coords && local_coords.expired_time < new Date().getTime()) {
    //     return locationProcess(local_coords.lat, local_coords.lng);
    // }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // localStorage.setItem("coords", JSON.stringify({lat, lng, expired_time: (new Date()).getTime()}));

            locationProcess(lat, lng);
        });
    } else {
        alert(
            "Konum verilerini alamadık. Daha iyi bir veri ulaştırabilmemiz için lütfen konum sistemini destekleyen bir tarayıcı ile giriş yap."
        );
    }
}

function setAdress(sehir, ilce, mahalle, sokak) {
    var sehir_input = document.querySelector("#sehirInput");
    var ilce_input = document.querySelector("#ilceInput");
    var mahalle_input = document.querySelector("#mahalleInput");
    var sokak_input = document.querySelector("#sokakInput");

    if (!sehir_input) {
        return false;
    }

    for (let index = 0; index < sehir_input.options.length; index++) {
        const item = sehir_input.options[index];
        if (item.text == sehir) {
            item.selected = true;
            sehir_input.dispatchEvent(new Event("change"));
        }
    }

    setTimeout(() => {
        for (let index = 0; index < ilce_input.options.length; index++) {
            const item = ilce_input.options[index];
            if (item.text == ilce) {
                item.selected = true;
                ilce_input.dispatchEvent(new Event("change"));
            }
        }

        setTimeout(() => {
            for (let index = 0; index < mahalle_input.options.length; index++) {
                const item = mahalle_input.options[index];
                if (item.text == mahalle) {
                    item.selected = true;
                    mahalle_input.dispatchEvent(new Event("change"));
                }
            }

            setTimeout(() => {
                for (
                    let index = 0;
                    index < sokak_input.options.length;
                    index++
                ) {
                    const item = sokak_input.options[index];
                    if (item.text == sokak) {
                        item.selected = true;
                        sokak_input.dispatchEvent(new Event("change"));
                    }
                }
            }, 200);
        }, 200);
    }, 200);
}

function distance(lat1, lon1, lat2, lon2, unit) {
    if (lat1 == lat2 && lon1 == lon2) {
        return 0;
    } else {
        var radlat1 = (Math.PI * lat1) / 180;
        var radlat2 = (Math.PI * lat2) / 180;
        var theta = lon1 - lon2;
        var radtheta = (Math.PI * theta) / 180;
        var dist =
            Math.sin(radlat1) * Math.sin(radlat2) +
            Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        if (dist > 1) {
            dist = 1;
        }
        dist = Math.acos(dist);
        dist = (dist * 180) / Math.PI;
        dist = dist * 60 * 1.1515;
        if (unit == "K") {
            dist = dist * 1.609344;
        }
        if (unit == "N") {
            dist = dist * 0.8684;
        }
        return dist;
    }
}

function startHelp() {
    var button = document.querySelector(".start-help");
    var name = document.querySelector("#name");
    var tel = document.querySelector("#tel");
    var email = document.querySelector("#email");

    if (!button) {
        return false;
    }

    button.addEventListener("click", function () {
        var api_url = this.getAttribute("data-url");

        fetch(api_url, {
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                "X-CSRF-Token": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                name: name.value,
                tel: tel.value,
                email: email.value,
                status: "Yardım Geliyor",
            }),
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.success) {
                    localStorage.setItem("started_help_id", res.help_id);
                    this.remove();
                    Swal.fire({
                        icon: "success",
                        title: "Başarılı!",
                        text: res.message,
                        confirmButtonText: "Kapat",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Hata!",
                        text: "Lütfen boş alan bırakmayın!",
                        confirmButtonText: "Kapat",
                    });
                }
            });
    });
}

function locationProcess(lat, lng) {
    var map_div = document.querySelector("#map");
    var table = document.querySelector("#datatable");

    if (table) {
        var coordinates = table.querySelectorAll(".coordinates");

        coordinates.forEach((item) => {
            var value = item.querySelector("span").innerHTML;
            var [item_lat, item_lng] = value.split(",");
            item_lat = item_lat.replace(/\s/g, "");
            item_lng = item_lng.replace(/\s/g, "");

            if (item_lat && item_lng) {
                item.innerHTML =
                    distance(lat, lng, item_lat, item_lng, "K").toFixed(1) +
                    " KM";
            }
        });

        let trs = Array.from(table.rows);
        trs = trs.slice(1);

        trs.sort((a, b) => {
            return (
                parseInt(a.cells[1].innerHTML) - parseInt(b.cells[1].innerHTML)
            );
        }).forEach((tr) => table.querySelector("tbody").appendChild(tr));
    }

    var latInput = document.querySelector("#lat");
    var lngInput = document.querySelector("#lng");

    if (latInput && lngInput) {
        latInput.value = lat;
        lngInput.value = lng;
    }

    if (map_div) {
        setMapMarkerAndIcon(lat, lng);
        map.setView([lat, lng], 16);

        fetch(
            `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`
        )
            .then((res) => res.json())
            .then((res) => {
                setAdress(
                    res.address.province,
                    res.address.town.toLocaleUpperCase("tr-TR"),
                    res.address.suburb.toLocaleUpperCase("tr-TR"),
                    res.address.road.toLocaleUpperCase("tr-TR")
                );
            });
    }
}

function helpFinished() {
    var button = document.querySelector("#help-finished");

    if (!button) {
        return false;
    }

    button.addEventListener("click", function () {
        var api_url = this.getAttribute("data-url");

        fetch(api_url, {
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                "X-CSRF-Token": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                status: "Yardım Ulaştı",
            }),
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.success) {
                    localStorage.removeItem("started_help_id");
                    Swal.fire({
                        icon: "success",
                        title: "Başarılı!",
                        text: res.message,
                        confirmButtonText: "Kapat",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
    });
}

function helpCancel() {
    var button = document.querySelector("#help-cancel");

    if (!button) {
        return false;
    }

    button.addEventListener("click", function () {
        var api_url = this.getAttribute("data-url");

        fetch(api_url, {
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                "X-CSRF-Token": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            method: "POST",
            credentials: "same-origin",
            body: JSON.stringify({
                status: "Yardım Bekliyor",
            }),
        })
            .then((res) => res.json())
            .then((res) => {
                if (res.success) {
                    localStorage.removeItem("started_help_id");
                    Swal.fire({
                        icon: "success",
                        title: "Başarılı!",
                        text: res.message,
                        confirmButtonText: "Kapat",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            });
    });
}
