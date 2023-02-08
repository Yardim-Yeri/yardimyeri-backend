@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1 class="h2">YARDIMA İHTİYACI OLANLAR</h1>
        </div>

        <div class="mt-4 table-responsive">
            <table class="table table-striped table-hover table-bordered" id="datatable" style="table-layout: fixed">
                <thead>
                    <tr>
                        <th width="100" scope="col">İSİM</th>
                        <th width="100" scope="col">UZAKLIK</th>
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
                                <span class="d-none">{{ $item->lat . ',' . $item->lng }}</span>
                            </th>
                            <th>
                                {{ $item->ihtiyac_turu }}
                            </th>
                            <th>
                                {{ $item->kac_kisilik }} Kişilik
                            </th>
                            <th>
                                {{ $item->created_at->format('d.m.Y H:i') }}
                            </th>
                            <th>
                                <span class="btn btn-warning">{{ $item->help_status }}</span>
                            </th>
                            <th>
                                <a href="{{ route('yardimda-bulunabilirim', ['id' => $item->id]) }}"
                                    class="btn btn-primary">Detaylar</a>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
