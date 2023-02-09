@extends('admin.layouts.master')
@section('admin-content')

<div class="row">
    <div class="col-md-3">
        <label for="">Yardım Durumu</label>
        <select name=""  id="help_status" class="form-select">
            <option value="">Filtreyi Temizle</option>
            <option {{ $status=="Yardım Ulaştı" ? 'selected' : '' }}>Yardım Ulaştı</option>
            <option {{ $status=="Yardım Bekliyor" ? 'selected' : '' }}>Yardım Bekliyor</option>
            <option {{ $status=="Yardım Geliyor" ? 'selected' : '' }}>Yardım Geliyor</option>
        </select>
    </div>
   
</div>


<div class="mt-4">
    <table class="table table-sm table-striped table-hover table-bordered" id="datatable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">İSİM</th>
                <th scope="col">ŞEHİR</th>
                <th scope="col">İHTİYAÇ TÜRÜ</th>
                <th scope="col">KAÇ KİŞİLİK</th>
                <th scope="col">TALEP TARİHİ</th>
                <th scope="col">TELEFON</th>
                <th scope="col">ADRES</th>
                <th scope="col">DURUMU</th>
                <th scope="col">YARDIM EDEN</th>
                <th scope="col">YARDIM EDEN TEL</th>
                <th scope="col">YARDIM EDEN EMAıL</th>
                <th scope="col">İŞLEMLER</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th>{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
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
                        {{ $item->tel }}
                    </td>
                    <td style="word-break: break-word;">
                        {{ $item->adres_tarifi }}
                    </td>
                    <td>
                        {{ $item->help_status }}
                    </td>
                    <td>
                        {{ $item->helper?->name }}
                    </td>
                    <td>
                        {{ $item->helper?->tel }}
                    </td>
                    <td>
                        {{ $item->helper?->email }}
                    </td>
                    <td>
                        <a href="{{ route('show.admin-demand', $item->id) }}" class="btn btn-primary">Detaylar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
        {{ $data->links() }}
    
    
</div>
@push('sc')
    <script>
        var url="{{ route('get.admin-demands') }}";

        $('#help_status').change(function(){
            this.value=="" ? open(url,"_self") : open(url+"?status="+this.value,"_self")
        })
    </script>
@endpush
@endsection

