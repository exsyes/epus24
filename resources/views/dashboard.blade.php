@extends('layouts.main')

@section('container')
{{--notif error atau sukses--}}
    <div class="row">
        @if(session('error'))

            <div class="col-md-6 alert alert-danger alert-dismissible fade show mt-4 shadow" role="alert">
                <strong>Error:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="col-md-6 alert alert-success alert-dismissible fade show mt-4 shadow" role="alert">
                <strong>Sukses:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
{{--notif error atau sukses--}}

{{--  tombol tambah pinjaman  --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mt-3 mb-3 border-bottom">
        <h1 class="h2">Dashboard Pinjaman Buku</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#formPinjaman"><span data-feather="plus-circle"></span> Tambah pinjaman</button>
            </div>
        </div>
    </div>

<div class="row mb-3">
    <div class="col-sm-6">
        <div class="card shadow-lg">
            <div class="card-body bg-primary rounded-3">
               <h1>TOTAL BUKU</h1>
                <br>
                <h3>{{$books->count()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card shadow-lg">
            <div class="card-body bg-warning rounded-3">
                <h1>DATA PEMINJAM</h1>
                <br>
                <h3>{{$borrowers->count()}}</h3>
            </div>
        </div>
    </div>
</div>
{{--akhir tombol pinjaman--}}

{{--form pinjaman--}}
<div class="modal fade" id="formPinjaman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/borrowed-books/store" method="POST" class="needs-validation">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Pinjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Buku</label>
                        <select class="form-select" id="buku" name="book_id" aria-label="Default select example" required>
                            <option selected disabled value="">pilih</option>
                            @foreach ($books as $book)
                                    <option value="{{$book->id}}">{{$book->title}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Pilih buku yang dipinjam
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Nama Peminjam</label>
                        <select class="form-select" id="peminjam" name="borrower_id" aria-label="Default select example" required>
                            <option selected disabled value="">pilih</option>
                            @foreach ($borrowers as $borrower)
                                    <option value="{{$borrower->id}}">{{$borrower->name}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Pilih Peminjam terlebih dahulu
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Jumlah</label>
                        <input type="number" class="form-control" id="total" name="total" rows="3" placeholder="0" required>
                        <div class="invalid-feedback">
                            Masukan jumlah buku yang mau dipinjam
                        </div>
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
{{--akhir form pinjaman--}}

{{--tabel data buku--}}
@if(count($borrowedBook))
<h2>Data Pinjaman</h2>
<div class="row" style="height: 50vh">
    <div class="table-responsive">
        <table class="table table-bordered table-sm">
            <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Tanggal Peminjaman</th>
                <th scope="col">Judul Buku</th>
                <th scope="col">Jumlah Buku Pinjaman</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Jumlah Kembali</th>
                <th scope="col">Tanggal Kembali</th>
                <th scope="col">Opsi</th>

            </tr>
            </thead>
            <tbody>
                @foreach ($borrowedBook as $key => $b)
            <tr>
                @php
                $iterated = $key + 1 + (($borrowedBook->currentPage() - 1) * $borrowedBook->perPage())
                @endphp
                        <td>{{ $iterated}}</td>
                        <td>{{ $b->created_at }}</td>
                        <td>{{ $b->title }}</td>
                        <td>
                            @if($b->jumlah_pinjaman != 0)
                                {{ $b->jumlah_pinjaman }}
                            @else
                                <span data-feather="check"></span>
                            @endif
                        </td>
                        <td>{{ $b->name }}</td>
                        <td>{{ $b->jumlah_kembali }}</td>
                        <td>{{ $b->updated_at}}</td>
                        <td>
                            {{-- form edit   --}}
                            <div class="modal fade" id="edit{{$b->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="/borrowed-books/{{$b->id}}/update" method="POST" class="needs-validation">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Form Pinjaman</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="book" class="form-label">Judul</label>
                                                        <input class="form-control" rows="3" id="title" placeholder="{{ $b->title }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="mb-3">
                                                            <label for="peminjam" class="form-label">Peminjam</label>
                                                            <input type="text" class="form-control" id="nama" rows="3" placeholder="{{ $b->name }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="total" class="form-label">Jumlah Pinjaman</label>
                                                        <input type="number" class="form-control" id="total" rows="3" placeholder="{{ $b->jumlah_pinjaman }}" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="kembali" class="form-label">Jumlah Kembali</label>
                                                        <input type="number" class="form-control" id="kembali" name="jumlah_kembali" rows="3" placeholder="{{ $b->jumlah_kembali }}">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="hidden" name="book_id" value="{{ $b->book_id }}">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            {{-- akhir form edit   --}}

                            {{--form hapus--}}
                            <div class="modal fade" id="hapus_{{$b->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="/borrowed-books/{{$b->id}}/delete" method="POST">
                                        @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">HAPUS DATA</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            hapus data {{$b->name}} dengan pinjaman buku {{$b->title}} sebanyak {{$b->jumlah_pinjaman}} ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TUTUP</button>
                                            <button type="submit" class="btn btn-primary">YA</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            {{--akhir form hapus--}}
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{$b->id}}"><span data-feather="edit"></span></button>
                            @if($b->jumlah_pinjaman == 0)
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#hapus_{{$b->id}}"><span data-feather="x-circle"></span></button>
                            @endif
                        </td>
            </tr>
                @endforeach
            </tbody>
        </table>

    </div>
        {{$borrowedBook->links()}}
</div>
{{--akhir tabel--}}
@else
    <div class="alert alert-dark" role="alert">
        <h4 class="alert-heading">Data peminjaman tidak ditemukan!</h4>
        <p>Mohon maaf, saat ini belum ada data peminjaman buku yang tersedia. Hal ini bisa disebabkan karena belum ada buku yang dipinjam, atau mungkin belum ada catatan peminjaman yang ditambahkan ke dalam sistem. Silakan pastikan untuk menambahkan data peminjaman setiap kali ada buku yang dipinjam agar informasi tersedia secara lengkap dan akurat. Terima kasih.</p>
        <hr>
        <p class="mb-0">- pesan sistem</p>
    </div>
@endif
    <script>
        const total =  document.getElementById("total");
        const peminjam = document.getElementById("peminjam");
        const buku = document.getElementById("buku");

        total.addEventListener("invalid", function(event) {
            event.preventDefault();
        });
        total.addEventListener("invalid", function() {
            this.classList.add("is-invalid");
            document.getElementById("totalError").style.display = "block";
        });
        total.addEventListener("input", function() {
            this.classList.remove("is-invalid");
            document.getElementById("totalError").style.display = "none";
        });

        peminjam.addEventListener("invalid", function(event) {
            event.preventDefault();
        });
        peminjam.addEventListener("invalid", function() {
            this.classList.add("is-invalid");
            document.getElementById("totalError").style.display = "block";
        });
        peminjam.addEventListener("input", function() {
            this.classList.remove("is-invalid");
            document.getElementById("totalError").style.display = "none";
        });

        buku.addEventListener("invalid", function(event) {
            event.preventDefault();
        });
        buku.addEventListener("invalid", function() {
            this.classList.add("is-invalid");
            document.getElementById("totalError").style.display = "block";
        });
        buku.addEventListener("input", function() {
            this.classList.remove("is-invalid");
            document.getElementById("totalError").style.display = "none";
        });
    </script>

@endsection
