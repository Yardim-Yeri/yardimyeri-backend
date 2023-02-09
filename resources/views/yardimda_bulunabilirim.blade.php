@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h2">YARDIMA İHTİYACI OLANLAR</h1>
        </div>

        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card bg-success mx-sm-1 p-3">
                    <div class="text-white text-center mt-3">
                        <h4>Ulaştırılan Yardım Sayısı</h4>
                    </div>
                    <div class="text-white text-center mt-2">
                        <h1>{{ $success_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-warning mx-sm-1 p-3">
                    <div class="text-dark text-center mt-3">
                        <h4>Bekleyen Yardım Sayısı</h4>
                    </div>
                    <div class="text-dark text-center mt-2">
                        <h1>{{ $warning_count }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card bg-info mx-sm-1 p-3">
                    <div class="text-white text-center mt-3">
                        <h4>Ulaştırılmakta Olan Yardım Sayısı</h4>
                    </div>
                    <div class="text-white text-center mt-2">
                        <h1>{{ $info_count }}</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            @foreach ($data as $item)
                <div class="card shadow my-1">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-6 col-lg-3 col-xl-1">
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


    </div>
@endsection
