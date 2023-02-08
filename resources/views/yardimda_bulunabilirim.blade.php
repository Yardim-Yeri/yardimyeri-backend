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

        <div class="mt-4 table-responsive">
            <table class="table table-striped table-hover table-bordered" id="datatable" style="table-layout: fixed">
                <thead>
                    <tr>
                        <th width="100" scope="col">İSİM</th>
                        <th width="160" scope="col">SANA OLAN UZAKLIK</th>
                        <th width="160" scope="col">ŞEHİR</th>
                        <th width="120" scope="col">İHTİYAÇ TÜRÜ</th>
                        <th width="110" scope="col">KAÇ KİŞİLİK</th>
                        <th width="200" scope="col">TALEP TARİHİ</th>
                        <th width="150" scope="col">DURUMU</th>
                        <th width="100" scope="col">İŞLEMLER</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <th>{{ $item->name }}</th>
                            <th class="coordinates">
                                @if (!empty($item->lat) && !empty($item->lng))
                                    <span class="d-none">{{ $item->lat . ',' . $item->lng }}</span>
                                @else
                                    <span>-</span>
                                @endif
                            </th>
                            <td>
                                {{ $item->sehir }}
                            </td>
                            <td>
                                {{ $item->ihtiyac_turu }}
                            </td>
                            <td>
                                {{ $item->kac_kisilik }} Kişilik
                            </td>
                            <td>
                                {{ $item->created_at->format('d.m.Y H:i') }}
                            </td>
                            <td>
                                <span class="btn btn-warning">{{ $item->help_status }}</span>
                            </td>
                            <td>
                                <a href="{{ route('yardimda-bulunabilirim', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Detaylar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
