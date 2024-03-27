@extends('layouts.main')

@section('container')

        <div class="row" >
    @if(session('error'))

        <div class="col-md-6 alert alert-danger alert-dismissible fade show mt-4" role="alert">
            <strong>Error:</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="col-md-6 alert alert-success alert-dismissible fade show mt-4" role="alert">
            <strong>Sukses:</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        </div>

{{--tombol tambah buku--}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Buku</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><span data-feather="plus-circle"></span> Tambah Buku</button>
            </div>
        </div>
    </div>
{{--form buku--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/books/store" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Masukan Judul">
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Jumlah</label>
                            <input type="number" class="form-control" id="stock" name="stock" rows="3" placeholder="0">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
{{--akhir data tambahan--}}

{{--ini tabel--}}
        <div class="row-6" style="height: 50vh">
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Jumlah Buku</th>
                <th scope="col">Tanggal Ditambahkan</th>
                <th scope="col">Tanggal Diperbarui</th>
                <th scope="col">Opsi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($books as $key => $book)
                <tr>
                    @php
                    $iteratePage = $key + 1 + (($books->currentPage()-1) * $books->perPage());
                    @endphp
                <td>{{$iteratePage}}</td>
                <td>{{$book->title}}</td>
                <td>{{$book->stock}}</td>
                <td>{{$book->created_at}}</td>
                <td>{{$book->updated_at}}</td>
                <td>
                    <form action="/books/{{$book->id}}/delete" method="POST">
                        @csrf
                        <div class="modal fade" id="hapus_{{$book->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">HAPUS DATA</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        HAPUS DATA BUKU {{$book->title}} ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                                        <button type="submit" class="btn btn-primary">YA</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn btn-sm btn-primary" ><span data-feather="edit"></span></button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus_{{$book->id}}"><span data-feather="x-circle"></span></button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>

    </div>
        </div>
{{$books->links()}}
@endsection



