@extends('layouts.app')

@section('title', $film->title)

@section('content')
<div class="page-header">
    <h1>{{ $film->title }}</h1>
    <div class="header-actions">
        <a href="{{ route('films.edit', $film) }}" class="btn btn-secondary">Edit Film</a>
        <a href="{{ route('films.index') }}" class="btn btn-outline">Kembali ke Daftar</a>
    </div>
</div>

<div class="film-detail">
    <div class="detail-card">
        <div class="detail-header">
            <h2>{{ $film->title }}</h2>
            <div class="film-rating-large">{{ $film->rating }}/10</div>
        </div>
        
        @if($film->image)
            <div class="detail-poster">
                <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->title }}" class="detail-poster-image">
            </div>
        @endif
        
        <div class="detail-content">
            <div class="detail-row">
                <div class="detail-item">
                    <label>Genre:</label>
                    <span class="genre-tag">{{ $film->genre }}</span>
                </div>
                
                <div class="detail-item">
                    <label>Tahun:</label>
                    <span>{{ $film->year }}</span>
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-item">
                    <label>Rating:</label>
                    <span class="rating-display">{{ $film->rating }}/10</span>
                </div>
                
                <div class="detail-item">
                    <label>Status:</label>
                    @if($film->watched)
                        <span class="status-badge watched">✓ Sudah Ditonton</span>
                    @else
                        <span class="status-badge unwatched">○ Belum Ditonton</span>
                    @endif
                </div>
            </div>
            
            <div class="detail-row">
                <div class="detail-item">
                    <label>Ditambahkan:</label>
                    <span>{{ $film->created_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="detail-item">
                    <label>Terakhir Diupdate:</label>
                    <span>{{ $film->updated_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>
        
        <div class="detail-actions">
            <form action="{{ route('films.toggle-watched', $film) }}" method="POST" class="inline-form">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-primary">
                    @if($film->watched)
                        Tandai Belum Ditonton
                    @else
                        Tandai Sudah Ditonton
                    @endif
                </button>
            </form>
            
            <a href="{{ route('films.edit', $film) }}" class="btn btn-secondary">Edit Film</a>
            
            <form action="{{ route('films.destroy', $film) }}" method="POST" class="inline-form"
                  onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus Film</button>
            </form>
        </div>
    </div>
</div>
@endsection