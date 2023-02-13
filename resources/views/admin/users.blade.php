@extends('admin.layouts.master')
@section('admin-content')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
        Kullancı Ekle
    </button>

    <!-- Modal -->
    <form action="{{ route('store.admin-users') }}" method="POST">
        @csrf
        <div class="modal fade" id="addUser" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Kullancı Ekle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kullanıcı Adı</label>
                            <input required type="text" class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input required type="email" class="form-control" name="email">
                        </div>
                        <div class="mb-3">
                            <label>Şifre</label>
                            <input required type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label>Kullanıcı Rolü</label>
                            <select name="role" class="form-select">
                                <option value="1">Admin</option>
                                <option value="2">Teyitçi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="mt-4">
        @include('includes.messages')
        <table class="table table-striped table-hover table-bordered" id="datatable">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">KULLANICI ADI</th>
                    <th scope="col">E-MAIL</th>
                    <th scope="col">Kullanıcı Rolü</th>
                    <th scope="col">İŞLEMLER</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role == 1 ? 'Admin' : 'Teyitçi' }}</td>
                        <td>
                            <a href="{{ route('delete.admin-users', $user->id) }}"
                                onclick="return confirm('Kullanıcıyı Silmek İstediğinize Emin misinmiz?');"
                                class="btn btn-danger">Sil</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>




    </div>

    @push('sc')
    @endpush
@endsection
