import "./bootstrap";

import IMask from "imask";

import Leaflet from "leaflet";
import "leaflet/dist/leaflet.css";

import Swal from "sweetalert2";
import "sweetalert2/src/sweetalert2.scss";

let map;

var myIcon = Leaflet.icon({iconUrl: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABkAAAApCAYAAADAk4LOAAAFgUlEQVR4Aa1XA5BjWRTN2oW17d3YaZtr2962HUzbDNpjszW24mRt28p47v7zq/bXZtrp/lWnXr337j3nPCe85NcypgSFdugCpW5YoDAMRaIMqRi6aKq5E3YqDQO3qAwjVWrD8Ncq/RBpykd8oZUb/kaJutow8r1aP9II0WmLKLIsJyv1w/kqw9Ch2MYdB++12Onxee/QMwvf4/Dk/Lfp/i4nxTXtOoQ4pW5Aj7wpici1A9erdAN2OH64x8OSP9j3Ft3b7aWkTg/Fm91siTra0f9on5sQr9INejH6CUUUpavjFNq1B+Oadhxmnfa8RfEmN8VNAsQhPqF55xHkMzz3jSmChWU6f7/XZKNH+9+hBLOHYozuKQPxyMPUKkrX/K0uWnfFaJGS1QPRtZsOPtr3NsW0uyh6NNCOkU3Yz+bXbT3I8G3xE5EXLXtCXbbqwCO9zPQYPRTZ5vIDXD7U+w7rFDEoUUf7ibHIR4y6bLVPXrz8JVZEql13trxwue/uDivd3fkWRbS6/IA2bID4uk0UpF1N8qLlbBlXs4Ee7HLTfV1j54APvODnSfOWBqtKVvjgLKzF5YdEk5ewRkGlK0i33Eofffc7HT56jD7/6U+qH3Cx7SBLNntH5YIPvODnyfIXZYRVDPqgHtLs5ABHD3YzLuespb7t79FY34DjMwrVrcTuwlT55YMPvOBnRrJ4VXTdNnYug5ucHLBjEpt30701A3Ts+HEa73u6dT3FNWwflY86eMHPk+Yu+i6pzUpRrW7SNDg5JHR4KapmM5Wv2E8Tfcb1HoqqHMHU+uWDD7zg54mz5/2BSnizi9T1Dg4QQXLToGNCkb6tb1NU+QAlGr1++eADrzhn/u8Q2YZhQVlZ5+CAOtqfbhmaUCS1ezNFVm2imDbPmPng5wmz+gwh+oHDce0eUtQ6OGDIyR0uUhUsoO3vfDmmgOezH0mZN59x7MBi++WDL1g/eEiU3avlidO671bkLfwbw5XV2P8Pzo0ydy4t2/0eu33xYSOMOD8hTf4CrBtGMSoXfPLchX+J0ruSePw3LZeK0juPJbYzrhkH0io7B3k164hiGvawhOKMLkrQLyVpZg8rHFW7E2uHOL888IBPlNZ1FPzstSJM694fWr6RwpvcJK60+0HCILTBzZLFNdtAzJaohze60T8qBzyh5ZuOg5e7uwQppofEmf2++DYvmySqGBuKaicF1blQjhuHdvCIMvp8whTTfZzI7RldpwtSzL+F1+wkdZ2TBOW2gIF88PBTzD/gpeREAMEbxnJcaJHNHrpzji0gQCS6hdkEeYt9DF/2qPcEC8RM28Hwmr3sdNyht00byAut2k3gufWNtgtOEOFGUwcXWNDbdNbpgBGxEvKkOQsxivJx33iow0Vw5S6SVTrpVq11ysA2Rp7gTfPfktc6zhtXBBC+adRLshf6sG2RfHPZ5EAc4sVZ83yCN00Fk/4kggu40ZTvIEm5g24qtU4KjBrx/BTTH8ifVASAG7gKrnWxJDcU7x8X6Ecczhm3o6YicvsLXWfh3Ch1W0k8x0nXF+0fFxgt4phz8QvypiwCCFKMqXCnqXExjq10beH+UUA7+nG6mdG/Pu0f3LgFcGrl2s0kNNjpmoJ9o4B29CMO8dMT4Q5ox8uitF6fqsrJOr8qnwNbRzv6hSnG5wP+64C7h9lp30hKNtKdWjtdkbuPA19nJ7Tz3zR/ibgARbhb4AlhavcBebmTHcFl2fvYEnW0ox9xMxKBS8btJ+KiEbq9zA4RthQXDhPa0T9TEe69gWupwc6uBUphquXgf+/FrIjweHQS4/pduMe5ERUMHUd9xv8ZR98CxkS4F2n3EUrUZ10EYNw7BWm9x1GiPssi3GgiGRDKWRYZfXlON+dfNbM+GgIwYdwAAAAASUVORK5CYII='})

function init() {
    var map_div = document.querySelector("#map");

    if (map_div) {
        map = Leaflet.map("map").setView([37.5, 37], 6);

        Leaflet.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            maxZoom: 19,
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);
    }

    var set_location = document.querySelector("#set_location");

    if (set_location) {
        var [lat, lng] = set_location.value.split(",");

        Leaflet.marker([lat, lng], {icon: myIcon}).addTo(map);
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
            body: JSON.stringify({ name: name.value, tel: tel.value, status: 'Yardım Geliyor' }),
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
        Leaflet.marker([lat, lng], {icon: myIcon}).addTo(map);
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
