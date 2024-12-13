@extends('layouts.main')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">10 Penulis Paling Populer</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Nama Penulis</th>
                    <th class="text-center">Total Voter</th>
                </tr>
            </thead>
            <tbody>
                @foreach($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td class="text-center">{{ $author->voter }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
