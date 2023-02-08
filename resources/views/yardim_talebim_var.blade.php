@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h2">YARDIM TALEBİM VAR</h1>
        </div>

        <div class="row align-item-center justify-content-center mt-4 pt-4">
            <div class="col-12 col-xl-6">
                <form action="{{ route('api-send-yardim-talebi-form') }}" method="POST">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="name" name="name" placeholder="İsim">
                        <label for="name" class="form-label">İsim</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="tel" name="tel"
                            placeholder="Telefon Numaranız">
                        <label for="tel" class="form-label">Telefon Numaranız</label>
                        <div class="form-text">Lütfen numaranızı başında sıfır olmadan girin.</div>
                    </div>

                    <div class="form-control mb-3">
                        <label class="form-label">İhtiyaç Türü</label>
                        <div class="row m-0">
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Barınma"
                                    id="barinma" checked>
                                <label class="form-check-label" for="barinma">
                                    Barınma
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" id="insan_gucu"
                                    value="İnsan Gücü">
                                <label class="form-check-label" for="insan_gucu">
                                    İnsan Gücü
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Gıda"
                                    id="gida">
                                <label class="form-check-label" for="gida">
                                    Gıda
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Su"
                                    id="su">
                                <label class="form-check-label" for="su">
                                    Su
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Ulaşım"
                                    id="ulasim">
                                <label class="form-check-label" for="ulasim">
                                    Ulaşım
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Kıyafet"
                                    id="kiyafet">
                                <label class="form-check-label" for="kiyafet">
                                    Kıyafet
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Isınma"
                                    id="isinma">
                                <label class="form-check-label" for="isinma">
                                    Isınma
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Bebek Ürünleri"
                                    id="bebek_urunleri">
                                <label class="form-check-label" for="bebek_urunleri">
                                    Bebek Ürünleri
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Hijyen"
                                    id="hijyen">
                                <label class="form-check-label" for="hijyen">
                                    Hijyen
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="İlaç"
                                    id="ilac">
                                <label class="form-check-label" for="ilac">
                                    İlaç
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Şarj"
                                    id="sarj">
                                <label class="form-check-label" for="sarj">
                                    Şarj Cihazları
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Aydınlatma"
                                    id="aydinlatma">
                                <label class="form-check-label" for="aydinlatma">
                                    Aydınlatma
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Kutu / Koli"
                                    id="kutu">
                                <label class="form-check-label" for="kutu">
                                    Kutu / Koli
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Evcil Hayvan"
                                    id="evcil_hayvan">
                                <label class="form-check-label" for="evcil_hayvan">
                                    Evcil Hayvan
                                </label>
                            </div>
                            <div class="form-check col-4 col-md-3">
                                <input class="form-check-input" type="radio" name="ihtiyac_turu" value="Diğer"
                                    id="diger">
                                <label class="form-check-label" for="diger">
                                    Diğer
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="ihtiyac_turu_detayi" name="ihtiyac_turu_detayi"
                            placeholder="Varsa İhtiyaç Türü Detayı">
                        <label for="kac_kisilik" class="form-label">Varsa İhtiyaç Türü Detayı</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" id="kac_kisilik" name="kac_kisilik"
                            placeholder="Kaç Kişinin İhtiyacı Var?">
                        <label for="kac_kisilik" class="form-label">Kaç Kişinin İhtiyacı Var?</label>
                    </div>

                    <button id="get_location" class="btn btn-link p-0 w-100 text-end mb-2" type="button">Konum bilgimi getir</button>
                    <div id="map" style="height: 180px"></div>
                    <div class="form-text text-danger mb-3">Konum izni verdiğiniz takdirde, alt tarafta bulunan seçenekler konum bilginize göre otomatik olarak çekilecektir. <br> Lütfen verinin doğrulunu kontrol edin.</div>

                    <div class="input-group mb-3">
                        <select class="form-select" name="sehir" id="sehirInput">
                            <option selected>Şehir</option>
                            <option value="KAHRAMANMARAŞ">Kahramanmaraş</option>
                            <option value="GAZİANTEP">Gaziantep</option>
                            <option value="MALATYA">Malatya</option>
                            <option value="DİYARBAKIR">Diyarbakır</option>
                            <option value="KİLİS">Kilis</option>
                            <option value="ŞANLIURFA">Şanlıurfa</option>
                            <option value="ADIYAMAN">Adıyaman</option>
                            <option value="HATAY">Hatay</option>
                            <option value="OSMANİYE">Osmaniye</option>
                            <option value="ADANA">Adana</option>
                        </select>
                        <select class="form-select" name="ilce" id="ilceInput" disabled>
                            <option selected>İlçe</option>
                        </select>
                        <select class="form-select" name="mahalle" id="mahalleInput" disabled>
                            <option selected>Mahalle</option>
                        </select>
                        <select class="form-select" name="sokak" id="sokakInput" disabled>
                            <option selected>Sokak</option>
                        </select>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="apartman" name="apartman"
                            placeholder="Apartman (Zorunlu Değil)">
                        <label for="apartman" class="form-label">Apartman (Zorunlu Değil)</label>
                    </div>

                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="adres_tarifi" name="adres_tarifi"
                            placeholder="Adres Tarifi">
                        <label for="adres_tarifi" class="form-label">Adres Tarifi (Zorunlu Değil)</label>
                    </div>

                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">

                    <button type="submit" class="btn btn-lg btn-primary w-100">Yardım Talebi Gönder</button>
                </form>
            </div>
        </div>
    </div>
@endsection