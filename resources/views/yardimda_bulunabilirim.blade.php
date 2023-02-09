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

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label><b>İSİM</b></label>
                                    <p class="text-truncate"> {{ $item->name }}</p>
                                    <hr>
                                </div>
                               
                                <div class="col-6">
                                    <label><b>ŞEHİR</b></label>
                                    <p>{{ $item->sehir }}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label><b>SANA OLAN UZAKLIK</b></label>
                                    <p  class="coordinates" >
                                        @if (!empty($item->lat) && !empty($item->lng))
                                            <span class="d-none">{{ $item->lat . ',' . $item->lng }}</span>
                                        @else
                                            <span>-</span>
                                        @endif    
                                    </p>
                                    <hr>
                                </div>
                               
                                <div class="col-6">
                                    <label><b>İHTİYAÇ TÜRÜ</b></label>
                                    <p>{{ $item->ihtiyac_turu }}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        

                      

                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label><b>KAÇ KİŞİLİK</b></label>
                                    <p>{{ $item->kac_kisilik }}</p>
                                    <hr>
                                </div>
                               
                                <div class="col-6">
                                    <label><b>TALEP TARİHİ</b></label>
                                    <p>{{ $item->created_at->format('d-m-Y H:i') }}</p>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-6">
                                    <label><b>İHTİYAÇ DETAY</b></label>
                                    <p class="text-truncate">{{ $item->ihtiyac_turu_detayi }}</p>
                                    <hr>
                                </div>
                                <div class="col-6">
                                    <label><b>DURUMU</b></label>
                                    <p>
                                       <span class="badge {{ $item->help_status=="Yardım Geliyor" ? 'bg-info' : 'bg-warning' }}">
                                       {{ $item->help_status }}
                                       </span>
                                    </p>
                                    <hr>
                                </div>
                            </div>
                        </div>

                       

                        <div class="col-md-3 mx-auto">
                                <a href="{{ route('yardimda-bulunabilirim', ['id' => $item->id]) }}" class="btn btn-primary col-12">Detaylar</a>
                             
                        </div>
                        
                    </div>  
                </div>
            </div>
        @endforeach
        </div>
        

    </div>
@endsection
