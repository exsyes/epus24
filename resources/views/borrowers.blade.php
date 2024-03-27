@extends('layouts.main')

@section('container')
    <h2>User Peminjaman</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama</th>
                <th scope="col">NIP</th>
                <th scope="col">Opsi</th>

            </tr>
            </thead>
            <tbody>
            @foreach($borrowers as $borrower)
                <tr>
                    <td>{{$borrower->id}}</td>
                    <td>{{$borrower->name}}</td>
                    <td>{{$borrower->NIP}}</td>
                    <td>
                        <form>
                            @csrf
                            <div class="modal fade" id="hapus_{{$borrower->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">HAPUS DATA</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            HAPUS DATA PEMINJAM {{$borrower->name}} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                                            <button type="submit" class="btn btn-primary">YA</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary"><span data-feather="edit"></span></button>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-target="#hapus_{{$borrower->id}}"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
