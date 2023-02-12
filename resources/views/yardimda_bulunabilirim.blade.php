@extends('layouts.master')

@section('styles')
    <style>
        .toolbox>nav {
            display: inline-block;
        }

        .toolbox>nav>ul {
            margin: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h2">YARDIMA İHTİYACI OLANLAR</h1>
        </div>

        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card bg-success mx-sm-1 p-3">
                    <div class="text-white text-center mt-3">
                        <h4>Yardım Ulaştırılan Kişi Sayısı</h4>
                    </div>
                    <div class="text-white text-center mt-2">
                        <h1>{{ $success_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-warning mx-sm-1 p-3">
                    <div class="text-dark text-center mt-3">
                        <h4>Yardım Bekleyen Kişi Sayısı</h4>
                    </div>
                    <div class="text-dark text-center mt-2">
                        <h1>{{ $warning_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-info mx-sm-1 p-3">
                    <div class="text-white text-center mt-3">
                        <h4>Yardım Ulaştırılacak Kişi Sayısı</h4>
                    </div>
                    <div class="text-white text-center mt-2">
                        <h1>{{ $info_count }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap flex-row w-100 toolbox align-items-center my-4">
            {{-- <a target="_blank" class="btn btn-primary" href="{{ route('api.export-spreadsheet')  }}">
                Excel Indir
            </a> --}}

            {{ $data->onEachSide(5)->links() }}

            <div class="col-12 col-md-6 mt-4 mt-md-0 d-flex align-items-center gap-3 ms-auto">
                <span>Filtre:</span>
                <select name="sehir" class="form-select filter-input">
                    <option value="">Şehir</option>
                    @foreach (config('cities.avaliable_cities') as $city)
                        <option value="{{ $city }}" {{ request()->input('sehir') == $city ? 'selected' : '' }}>{{ $city }}</option>
                    @endforeach
                </select>
                <select name="ihtiyac_turu" class="form-select filter-input">
                    <option value="">İhtiyaç Türü</option>
                    @foreach (config('needs') as $need)
                        <option value="{{ $need }}" {{ request()->input('ihtiyac_turu') == $need ? 'selected' : '' }}>{{ $need }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            @foreach ($data as $item)
                <div class="card shadow my-1 mb-2">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6 col-lg-3 col-xl-2">
                                <b>İSİM</b>
                                <p class="text-truncate"> {{ $item->name }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>ŞEHİR</b>
                                <p>{{ $item->sehir }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>SANA UZAKLIĞI</b>
                                <p class="coordinates">
                                    @if (!empty($item->lat) && !empty($item->lng))
                                        <span class="d-none">{{ $item->lat . ',' . $item->lng }}</span>
                                    @else
                                        <span>-</span>
                                    @endif
                                </p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>İHTİYAÇ TÜRÜ</b>
                                <p>{{ $item->ihtiyac_turu }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>KAÇ KİŞİLİK</b>
                                <p>{{ $item->kac_kisilik }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>TALEP TARİHİ</b>
                                <p>{{ $item->created_at->format('d-m-Y H:i') }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 d-md-none">
                                <b>İHTİYAÇ DETAY</b>
                                <p class="text-truncate">{{ $item->ihtiyac_turu_detayi }}</p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-6 col-lg-3 col-xl">
                                <b>DURUMU</b>
                                <p>
                                    <span
                                        class="badge {{ $item->help_status == 'Yardım Geliyor' ? 'bg-info' : 'bg-warning' }}">
                                        {{ $item->help_status }}
                                    </span>
                                </p>
                                <hr class="d-md-none">
                            </div>

                            <div class="col-12 col-md mx-auto">
                                <a href="{{ route('yardimda-bulunabilirim', ['id' => $item->id]) }}"
                                    class="btn btn-primary col-12">Detaylar</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex flex-row w-100 toolbox justify-content-between align-items-center my-4">
            {{-- <a target="_blank" class="btn btn-primary" href="{{ route('api.export-spreadsheet')  }}">
                Excel Indir
            </a> --}}

            {{ $data->onEachSide(5)->links() }}
        </div>

    </div>
@endsection
