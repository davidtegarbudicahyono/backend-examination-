@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Daftar Buku</h1>

    <!-- Form Filter -->
    <form method="GET" action="{{ route('books.index') }}" class="row g-3 align-items-center mb-4">
        <div class="col-auto">
            <label for="per_page" class="col-form-label">Tampilkan:</label>
        </div>
        <div class="col-auto">
            <select name="per_page" id="per_page" class="form-select form-select-sm">
                @for($i = 10; $i <= 100; $i += 10)
                    <option value="{{ $i }}" {{ $i == $perPage ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-auto">
            <label for="search" class="col-form-label">Cari:</label>
        </div>
        <div class="col-auto">
            <input type="text" name="search" id="search" value="{{ $search }}" 
                   class="form-control form-control-sm" 
                   placeholder="Nama buku atau penulis">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
        </div>
    </form>

    <!-- Daftar Buku -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Buku</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th class="text-center">Rata-Rata Rating</th>
                    <th class="text-center">Jumlah Voter</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $index => $book)
                    <tr>
                        <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author->name }}</td>
                        <td>{{ $book->BookCategory->name }}</td>
                        <td class="text-center">{{ $book->avarage_rating }}</td>
                        <td class="text-center">{{ $book->voter }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
</div>

@endsection
