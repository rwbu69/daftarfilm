@extends('layouts.app')

@section('title', 'Tambah Film Baru')

@section('content')
<div class="page-header">
    <h1>Tambah Film Baru</h1>
    <a href="{{ route('films.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
</div>

<div class="form-container">
    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="film-form">
        @csrf
        
        <div class="form-group">
            <label for="title">Judul Film <span class="required">*</span></label>
            <input type="text" name="title" id="title" class="form-control @error('title') error @enderror" 
                   value="{{ old('title') }}" required>
            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Poster Film</label>
            <input type="file" name="image" id="image" class="form-control @error('image') error @enderror" 
                   accept="image/*">
            @error('image')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <small class="form-help">Format: JPEG, PNG, JPG, GIF. Maksimal 2MB.</small>
        </div>

        <div class="form-group">
            <label for="genre">Genre <span class="required">*</span></label>
            <input type="text" name="genre" id="genre" class="form-control @error('genre') error @enderror" 
                   value="{{ old('genre') }}" placeholder="Contoh: Action, Drama, Comedy" required>
            @error('genre')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="year">Tahun <span class="required">*</span></label>
                <input type="number" name="year" id="year" class="form-control @error('year') error @enderror" 
                       value="{{ old('year', date('Y')) }}" min="1900" max="2030" required>
                @error('year')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="rating">Rating <span class="required">*</span></label>
                <input type="number" name="rating" id="rating" class="form-control @error('rating') error @enderror" 
                       value="{{ old('rating') }}" min="0" max="10" step="0.1" placeholder="0.0 - 10.0" required>
                @error('rating')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="checkbox-wrapper">
                <input type="checkbox" name="watched" id="watched" value="1" {{ old('watched') ? 'checked' : '' }}>
                <label for="watched">Sudah ditonton</label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Simpan Film</button>
            <a href="{{ route('films.index') }}" class="btn btn-outline">Batal</a>
        </div>
    </form>
</div>
@endsection