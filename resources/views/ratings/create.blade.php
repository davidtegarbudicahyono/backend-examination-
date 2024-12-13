@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h1>Insert Rating</h1>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf
        {{-- Dropdown Author --}}
        <div class="mb-3">
            <label for="author_id" class="form-label">Book Author</label>
            <select id="author_id" class="form-select" required>
                <option value="" disabled selected>Select an author</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Book --}}
        <div class="mb-3">
            <label for="book_id" class="form-label">Book Name</label>
            <select name="book_id" id="book_id" class="form-select" required>
                <option value="" disabled selected>Select a book</option>
            </select>
        </div>

        {{-- Dropdown Rating --}}
        <div class="mb-3">
            <label for="rating" class="form-label">Rating</label>
            <select name="rating" id="rating" class="form-select" required>
                @for ($i = 1; $i <= 10; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

{{-- JavaScript untuk menghubungkan dropdown --}}
<script>
    const authors = @json($authors); // Ambil data authors dengan buku
    const authorDropdown = document.getElementById('author_id');
    const bookDropdown = document.getElementById('book_id');

    // Event listener untuk memperbarui buku berdasarkan penulis
    authorDropdown.addEventListener('change', function () {
        const authorId = this.value;

        // Hapus semua opsi pada dropdown buku
        bookDropdown.innerHTML = '<option value="" disabled selected>Select a book</option>';

        // Temukan buku berdasarkan penulis yang dipilih
        const selectedAuthor = authors.find(author => author.id == authorId);
        if (selectedAuthor) {
            selectedAuthor.books.forEach(book => {
                const option = document.createElement('option');
                option.value = book.id;
                option.textContent = book.name;
                bookDropdown.appendChild(option);
            });
        }
    });
</script>
@endsection
