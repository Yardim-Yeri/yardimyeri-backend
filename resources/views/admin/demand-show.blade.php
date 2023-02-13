@extends('admin.layouts.master')
@section('admin-content')
    <form action="{{ route('update.admin-demand', $data->id) }}" method="POST">

        @csrf

        @include('includes.messages')
        <div class="card">
            <div class="card-header">
                <h1>Talep Güncelle</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">İsim</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Telefon</label>
                        <input type="text" class="form-control" id="name" name="tel"
                            value="{{ $data->tel }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">İhtiyaç Türü</label>
                        <p class="form-control">{{ $data->ihtiyac_turu_detayi }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Varsa İhtiyaç Türü Detayı</label>
                        <input type="text" class="form-control" id="name" name="ihtiyac_turu_detayi"
                            value="{{ $data->ihtiyac_turu_detayi }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kaç Kişinin İhtiyacı Var</label>
                        <input type="number" class="form-control" id="name" name="kac_kisilik"
                            value="{{ $data->kac_kisilik }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Adres</label>
                        <p class="form-control">{{ $data->getAdresAttribute() }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Apartman</label>
                        <p class="form-control">{{ $data->apartman }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Adres Tarifi</label>
                        <p class="form-control">{{ $data->adres_tarifi }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Talep Durumu</label>
                        <select name="help_status" class="form-select">
                            <option value="">Seçim Yap</option>
                            <option {{ $data->help_status == 'Yardım Ulaştı' ? 'selected' : '' }}>Yardım Ulaştı</option>
                            <option {{ $data->help_status == 'Yardım Bekliyor' ? 'selected' : '' }}>Yardım Bekliyor</option>
                            <option {{ $data->help_status == 'Yardım Geliyor' ? 'selected' : '' }}>Yardım Geliyor</option>
                        </select>
                    </div>

                    <div class="col-3">
                        @if (auth()->user()->role == 1)
                            <button type="submit" class="btn btn-primary px-5">Kaydet</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </form>
@endsection
