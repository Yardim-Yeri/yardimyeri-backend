@extends('admin.layouts.master')

@section('admin-content')
    <div class="row">
<<<<<<< Updated upstream
        <div class="col-md-3">
            <label for="">Yardım Durumu</label>
            <select name="" id="help_status" class="form-select">
=======
        <div class="col-md-2">
            <label for="">Yardım Durumu</label>
            <select class="form-select select2-input">
>>>>>>> Stashed changes
                <option value="">Filtreyi Temizle</option>
                <option {{ $status == 'Yardım Ulaştı' ? 'selected' : '' }}>Yardım Ulaştı</option>
                <option {{ $status == 'Yardım Bekliyor' ? 'selected' : '' }}>Yardım Bekliyor</option>
                <option {{ $status == 'Yardım Geliyor' ? 'selected' : '' }}>Yardım Geliyor</option>
            </select>
        </div>
<<<<<<< Updated upstream
=======
        <div class="col-md-2">
            <label for="">Şehir</label>
            <select class="form-select select2-input">
                <option value="">Filtreyi Temizle</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->sehir_title }}">{{ $province->sehir_title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="">İlçe</label>
            <select class="form-select select2-input">
                <option value="">Filtreyi Temizle</option>
                @foreach ($districts as $district)
                    <option value="{{ $district->ilce_sehirkey }}">{{ $district->ilce_title }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Mahalle</label>
            <select class="form-select select2-input-ajax" data-type="mahalle">
                <option value="">Filtreyi Temizle</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="">Sokak Cadde</label>
            <select class="form-select select2-input-ajax" data-type="sokak_cadde">
                <option value="">Filtreyi Temizle</option>
            </select>
        </div>
>>>>>>> Stashed changes
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
                    <th scope="col">TEYİTLİ</th>
                    <th width="150" scope="col">İŞLEMLER</th>
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
@endsection

@push('sc')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        // var url = "{{ route('get.admin-demands') }}";

        // $('#help_status').change(function() {
        //     this.value == "" ? open(url, "_self") : open(url + "?status=" + this.value, "_self")
        // });

        var ajax_url = "{{ route('ajax.country-data-select2') }}";

        $('.select2-input').select2({
            theme: 'bootstrap-5'
        });

        $(element).on('select2:select', function(e) {
            var value = e.params.data;

            var url = new URL(window.location.href);
            url.searchParams.get($(this).data('type')) ? url.searchParams.set($(this).data('type'), value.id) : url
                .searchParams.append($(this).data('type'), value.id);
            window.location.href = url.href;
        });

        $('.select2-input-ajax').each(function(_, element) {
            $(element).select2({
                theme: 'bootstrap-5',
                ajax: {
                    url: ajax_url,
                    dataType: 'json',
                    data: function(params) {
                        var query = {
                            term: params.term,
                            type: $(this).data('type')
                        }

                        return query;
                    }
                },
            });

            $(element).on('select2:select', function(e) {
                var value = e.params.data;

                var url = new URL(window.location.href);
                url.searchParams.get($(this).data('type')) ? url.searchParams.set($(this).data('type'),
                    value.id) : url.searchParams.append($(this).data('type'), value.id);
                window.location.href = url.href;
            });
        });
    </script>
@endpush
