@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Berita') }}</div>

                <form action="/berita/{{ $berita->id }}" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">Judul</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ $berita->nama }}" required autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">Kategori</label>

                            <div class="col-md-8">
                                <select class="form-control" name="kategori_id">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $item)
                                        @if ($item->id === $berita->kategori_id)
                                            <option value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('kategori_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">Deskripsi</label>

                            <div class="col-md-8">
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="8">{{ $berita->deskripsi }}</textarea>

                                @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label text-md-right">Gambar</label>
                                
                            <div class="col-md-8">
                                <img src="{{ asset('img/berita/'.$berita->gambar) }}" width="20%" class="mb-3">
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">

                                @error('gambar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
