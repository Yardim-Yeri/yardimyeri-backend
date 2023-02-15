@extends('admin.layouts.master')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('admin-content')

    <div class="row">
        <div class="col-md-2">
            <label for="">Yardım Durumu</label>
            <select class="form-select select2-input">
                <option value="">Filtreyi Temizle</option>
                <option {{ $status == 'Yardım Ulaştı' ? 'selected' : '' }}>Yardım Ulaştı</option>
                <option {{ $status == 'Yardım Bekliyor' ? 'selected' : '' }}>Yardım Bekliyor</option>
                <option {{ $status == 'Yardım Geliyor' ? 'selected' : '' }}>Yardım Geliyor</option>
            </select>
        </div>

        

    </div>

    <div class="card mt-4">
        <div class="card-header">Konum Filtreleme</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <label for="">Şehir</label>
                    <select name="" id="select_city" class="form-select form-select-sm">
                        <option value="">Filtreyi Temizle</option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->sehir_key }}">{{ $city->sehir_title }}</option>
                        @endforeach
                    </select>
                </div>
        
                <div class="col-md">
                    <label for="">İlçe</label>
                    <select name="" disabled  id="select_district" class="form-select select2">
                        <option value="">Filtreyi Temizle</option>
                    </select>
                </div>
        
                <div class="col-md">
                    <label for="">Mahalle</label>
                    <select name="" disabled id="select_neighborhood" class="form-select select2">
                        <option value="">Filtreyi Temizle</option>
                    </select>
                </div>
        
                <div class="col-md">
                    <label for="">Sokak/Köy/Cadde</label>
                    <select name="" disabled id="select_street" class="form-select select2">
                        <option value="">Filtreyi Temizle</option>
                    </select>
                </div>

                <div class="col-md mt-4">
                    
                    <button id="location_filter" class="btn btn-primary btn-sm col-12">Filtrele</button>
                </div>
            </div>
        </div>
    </div>

  

    
    <div class="mt-4">

        <b>Toplam: </b>{{ $data->total() }} Kayıt {{ $data->onEachSide(1)->links() }}
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
                        <td align="center">
                            <input data-id="{{ $item->id }}" class="form-check-input approved-input" type="checkbox" {{ $item->approved == 1 ? 'checked' : '' }}>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('show.admin-demand', $item->id) }}" class="btn btn-primary">Detaylar</a>
                                @if (auth()->user()->role == 1)
                                    <form action="{{ route('delete.admin-demand', ['id' => $item->id]) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Sil</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <b>Toplam: </b>{{ $data->total() }} Kayıt {{ $data->onEachSide(1)->links() }}

    </div>
    
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@push('sc')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var url = "{{ route('get.admin-demands') }}";

        $('#help_status').change(function() {
            this.value == "" ? open(url, "_self") : open(url + "?status=" + this.value, "_self")
        });

        $('.approved-input').on('change', function() {
            var url = "/admin/demands/update-approved-status/" + $(this).data('id');
            $.get(url);
        });

            $('#location_filter').click(function() {
                var province= $('#select_city').val() ? '?province='+$('#select_city option:selected').text() : '';
                var district= $('#select_district').val() ? '&district='+$('#select_district').val() : '';
                var neighborhood= $('#select_neighborhood').val() ? '&neighborhood='+$('#select_neighborhood').val() : '';
                var street= $('#select_street').val() ? '&street='+$('#select_street').val() : '';

                var loc_url=url+province+district+neighborhood+street;
                open(loc_url,"_self");
            });

            $('.delete-form').on('submit', function() {
                if (confirm('Veri silinecek emin misiniz?')) {
                    alert('Veri silindi');
                }
            });

            // $(element).on('select2:select', function(e) {
            //     var value = e.params.data;

            //     var url = new URL(window.location.href);
            //     url.searchParams.get($(this).data('type')) ? url.searchParams.set($(this).data('type'),
            //         value.id) : url.searchParams.append($(this).data('type'), value.id);
            //     window.location.href = url.href;
            // });


            $('#select_city').change(function(){
                $('#select_district').prop('disabled',false)
                $("#select_district").select2({
                    placeholder: "İlçeler getiriliyor",
                    ajax: {
                        url: "districts/"+this.value,
                        delay: 200,
                        dataType: 'json', 
                        processResults: function(data) {  
                            return {
                                results: data
                            };
                        },
                    },
                })
            })

            $('#select_district').change(function(){
                $('#select_neighborhood').prop('disabled',false)
                $("#select_neighborhood").select2({
                    placeholder: "Mahalleler getiriliyor",
                    ajax: {
                        url: "neighborhood/"+this.value,
                        delay: 200,
                        dataType: 'json', 
                        processResults: function(data) {  
                            return {
                                results: data
                            };
                        },
                    },
                })
            })

            $('#select_neighborhood').change(function(){
                $('#select_street').prop('disabled',false)
                $("#select_street").select2({
                    placeholder: "Sokaklar getiriliyor",
                    ajax: {
                        url: "street/"+this.value,
                        delay: 200,
                        dataType: 'json', 
                        processResults: function(data) {  
                            return {
                                results: data
                            };
                        },
                    },
                })
            })
            
            
        </script>
    @endpush
