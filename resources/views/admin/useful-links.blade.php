@extends('admin.layouts.master')
@section('admin-content')


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLink">
    Faydalı Link Ekle
  </button>
  
  <!-- Modal -->
  <form action="{{ route('store.useful-links') }}" method="POST">
 @csrf
    <div class="modal fade" id="addLink"  aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Faydalı Link Ekle</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label>Başlık</label>
              <input required type="text" class="form-control" name="title">
            </div>
            <div class="mb-3">
              <label>Url</label>
              <input required type="text" class="form-control" name="url">
            </div>
            <div class="mb-3">
              <label>Açıklama</label>
              <input required type="text" class="form-control" name="description">
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
                <th scope="col">BAŞLIK</th>
                <th scope="col">URL</th>
                <th scope="col">AÇIKLAMA</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($links as $link)
                <tr>
                    <td>{{ $link->id }}</td>
                    <td>{{ $link->title }}</td>
                    <td>{{ $link->url }}</td>
                    <td class="text-truncate">{{ $link->description }}</td>
                    <td class="text-truncate">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#update{{ $link->id }}">
                            Güncelle
                          </button>
                        <a href="{{ route('delete.useful-links',$link->id) }}" onclick="return confirm('Linki Silmek İstediğinize Emin misiniz?');" class="btn btn-danger">Sil</a>
                    </td>
                </tr>

             <!-- Modal -->
             <form action="{{ route('update.useful-links',$link->id) }}" method="POST">
                @csrf
                   <div class="modal fade" id="update{{ $link->id }}"  aria-hidden="true">
                     <div class="modal-dialog">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Güncelle</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                           <div class="mb-3">
                             <label>Başlık</label>
                             <input required type="text" value="{{ $link->title }}" class="form-control" name="title">
                           </div>
                           <div class="mb-3">
                             <label>Url</label>
                             <input required type="text" value="{{ $link->url }}" class="form-control" name="url">
                           </div>
                           <div class="mb-3">
                             <label>Açıklama</label>
                             <input required type="text" value="{{ $link->description }}" class="form-control" name="description">
                           </div>
                         </div>
                         <div class="modal-footer">
                           <button type="submit" class="btn btn-primary">Kaydet</button>
                         </div>
                       </div>
                     </div>
                   </div>
                   </form>
            @endforeach
        </tbody>
    </table>
    
    
    
    
</div>

@endsection

