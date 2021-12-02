@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Data Berita') }}</div>

                <div class="card-body">
                    <a href="/berita/create" class="btn btn-success mb-4">Add Berita</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($berita as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kategori->nama }}</td>
                                    <td>
                                        <form action="/berita/{{ $item->id }}" method="post">
                                            <a href="/berita/{{ $item->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                                          
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="4">Data Masih Kosong</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
