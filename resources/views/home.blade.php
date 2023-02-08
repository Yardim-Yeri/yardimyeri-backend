@extends('layouts.master')

@section('content')
    <div class="container pt-3 pb-6 d-flex flex-column align-items-center justify-content-center">
        <h1 class="d-block text-center lh-base strong fw-bold">İHTİYAÇLARINIZ İÇİN <br> YARDIM TALEP EDEBİLİR YADA YARDIM EDEBİLİRSİNİZ</h1>

        <div class="text-center mt-5 pt-5 mb-3">
            <h3 class="mt-4 pt-4 text-dark-50">NE YAPMAK İSTEDİĞİNİZİ SEÇİN</h3>
        </div>

        <div class="d-grid gap-3 w-75">
            <a href="{{ route('yardim-talebim-var') }}" class="btn fs-3 py-3 btn-dark rounded-pill">YARDIM TALEBİM VAR</a>
            <a href="{{ route('yardimda-bulunabilirim') }}" class="btn fs-3 py-3 btn-dark rounded-pill">YARDIMDA BULUNABİLİRİM</a>
        </div>
    </div>
@endsection
