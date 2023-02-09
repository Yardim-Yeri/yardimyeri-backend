@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h2">TALEP AYRINTILARI</h1>
        </div>

        <div class="row align-item-center justify-content-center mt-4 pt-4">
            <div class="col-12 col-xl-7">
                <div class="table-responsive">
                    <table class="table border-top">
                        <tr>
                            <td width="250">İSİM</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->name }}</td>
                        </tr>
                        @if($helpers->isNotEmpty())
                        <tr>
                            <td>TELEFON NUMARASI</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->tel }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>İHTİYAÇ TÜRÜ</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->ihtiyac_turu }}</td>
                        </tr>
                        <tr>
                            <td>İHTİYAÇ TÜRÜ DETAYI</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->ihtiyac_turu_detayi ?? 'Yok' }}</td>
                        </tr>
                        <tr>
                            <td>KAÇ KİŞİLİK</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->kac_kisilik }}</td>
                        </tr>
                        <tr>
                            <td>ADRES</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->adres }}</td>
                        </tr>
                        <tr>
                            <td>ADRES TARİFİ</td>
                            <td class="text-center">:</td>
                            <td>{{ $item->adres_tarifi ?? 'Boş' }}</td>
                        </tr>
                        <tr>
                            <td>YARDIM DURUMU</td>
                            <td class="text-center">:</td>
                            <td>
                                @if ($item->help_status == "Yardım Geliyor")
                                <span class="badge p-2 bg-info">{{ $item->help_status }}</span>
                                @else
                                <span class="badge p-2 bg-warning">{{ $item->help_status }}</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>

                @if (!empty($item->lat) && !empty($item->lng))
                    <div>
                        <span class="fs-6 d-block mb-2">Talebin gönderildiği konum bilgisi</span>
                        <div id="map" style="height: 300px"></div>
                    </div>
                    <input type="hidden" id="set_location" value="{{ $item->lat . ',' . $item->lng }}">
                @endif


                @if ($item->help_status != 'Yardım Ulaştı')
                    <div class="mt-4">
                        <div class="fs-6 text-danger mb-2">Yardıma gidiyorsan veya yardım ettiysen aşağıdaki buton aracılığı ile bize bildir. <br/> Yardıma ihtiyacı olanlara doğru veriyi aktarabilmemiz için gerekli</div>
                        <button data-bs-toggle="modal" data-bs-target="#startHelpModal" class="remove-started btn btn-lg btn-success w-100">YARDIM ET</button>
                    </div>
                @endif

                <div class="show-started" style="display: none">
                    <div class="d-flex gap-3">
                        <button id="help-cancel" data-url="{{ route('api-change-help-status', ['id' => $item->id]) }}"
                            class="btn btn-lg mt-4 btn-danger w-100">YARDIMI İPTAL ET</button>
                        <button id="help-finished" data-url="{{ route('api-change-help-status', ['id' => $item->id]) }}"
                            class="btn btn-lg mt-4 btn-success w-100">YARDIMI TAMAMLA</button>
                    </div>
                </div>

                @if ($helpers->isNotEmpty())
                    <h4 class="mt-3">Yardıma Gidenler</h4>
                    <table class="table">
                        <thead>
                            <th>İSİM</th>
                            <th>TELEFON NUMARASI</th>
                        </thead>
                        <tbody>
                            @foreach ($helpers as $helper)
                                <tr>
                                    <td>{{ $helper->name }}</td>
                                    <td>{{ $helper->tel }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <div class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true"
                    id="startHelpModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Yardım Başlatılacak!</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Aşağıda bulunan bilgileri doldurduktan sonra yardımı başlatabilirsiniz. <span class="text-danger">Yardımı başlattığınız takdirde yardım talep edenin iletişim bilgilerine ulaşabilirsiniz.</span></p>
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="İsim">
                                    <label for="name" class="form-label">İsim</label>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="E-Posta Adresiniz">
                                    <label for="email" class="form-label">E-Posta Adresiniz</label>
                                    <div class="form-text">Bu alan zorunlu değildir. Ancak e-posta adresinizi girdiğiniz
                                        takdirde yeni oluşan talepleri mail olarak sizlere bildiriyoruz.</div>
                                </div>
                                <div class="mb-3 form-floating">
                                    <input type="text" class="form-control" id="tel" name="tel"
                                        placeholder="Telefon Numaranız">
                                    <label for="tel" class="form-label">Telefon Numaranız</label>
                                    <div class="form-text">Lütfen numaranızı başında sıfır olmadan girin.</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Vazgeçtim</button>
                                <button data-url="{{ route('api-change-help-status', ['id' => $item->id]) }}"
                                    type="button" class="btn btn-success start-help">Yardımı Başlat</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
