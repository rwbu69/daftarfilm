@extends('layouts.app')

@section('title', 'Daftar Film')

@section('content')
<div class="page-header">
    <h1>Daftar Film</h1>
    <a href="{{ route('films.create') }}" class="btn btn-primary">Tambah Film Baru</a>
</div>

<!-- Filter Form -->
<div class="filter-section">
    <form method="GET" action="{{ route('films.index') }}" class="filter-form">
        <div class="filter-row">
            <div class="filter-group">
                <label for="genre">Genre:</label>
                <select name="genre" id="genre" class="form-control">
                    <option value="">Semua Genre</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                            {{ $genre }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <label for="rating">Rating Minimum:</label>
                <select name="rating" id="rating" class="form-control">
                    <option value="">Semua Rating</option>
                    <option value="8" {{ request('rating') == '8' ? 'selected' : '' }}>8.0+</option>
                    <option value="7" {{ request('rating') == '7' ? 'selected' : '' }}>7.0+</option>
                    <option value="6" {{ request('rating') == '6' ? 'selected' : '' }}>6.0+</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5.0+</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label for="watched">Status:</label>
                <select name="watched" id="watched" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="true" {{ request('watched') == 'true' ? 'selected' : '' }}>Sudah Ditonton</option>
                    <option value="false" {{ request('watched') == 'false' ? 'selected' : '' }}>Belum Ditonton</option>
                </select>
            </div>
            
            <div class="filter-actions">
                <button type="submit" class="btn btn-secondary">Filter</button>
                <a href="{{ route('films.index') }}" class="btn btn-outline">Reset</a>
            </div>
        </div>
    </form>
</div>

<!-- Films Grid -->
<div class="films-grid">
    @forelse($films as $film)
        <div class="film-card">
            @if($film->image)
                <div class="film-poster">
                    <img src="{{ asset('storage/' . $film->image) }}" alt="{{ $film->title }}" class="poster-image">
                </div>
            @endif
            
            <div class="film-header">
                <h3 class="film-title">{{ $film->title }}</h3>
                <div class="film-rating">{{ $film->rating }}/10</div>
            </div>
            
            <div class="film-details">
                <p class="film-genre">{{ $film->genre }}</p>
                <p class="film-year">{{ $film->year }}</p>
            </div>
            
            <div class="film-status">
                @if($film->watched)
                    <span class="status-badge watched">Sudah Ditonton</span>
                @else
                    <span class="status-badge unwatched">Belum Ditonton</span>
                @endif
            </div>
            
            <div class="film-actions">
                <a href="{{ route('films.show', $film) }}" class="btn btn-sm btn-info" onclick="console.log('Detail clicked')">Detail</a>
                <a href="{{ route('films.edit', $film) }}" class="btn btn-sm btn-secondary" onclick="console.log('Edit clicked')">Edit</a>
                
                <form action="{{ route('films.toggle-watched', $film) }}" method="POST" class="inline-form" onsubmit="console.log('Toggle form submitted')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-sm btn-outline" onclick="console.log('Toggle button clicked')">
                        {{ $film->watched ? 'Tandai Belum' : 'Tandai Sudah' }}
                    </button>
                </form>
                
                <form action="{{ route('films.destroy', $film) }}" method="POST" class="inline-form" 
                      onsubmit="console.log('Delete form submitted'); return confirm('Yakin ingin menghapus film ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="console.log('Delete button clicked')">Hapus</button>
                </form>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <h3>Belum ada film</h3>
            <p>Silakan tambahkan film pertama Anda!</p>
            <a href="{{ route('films.create') }}" class="btn btn-primary">Tambah Film</a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if($films->hasPages())
    <div class="pagination-wrapper">
        {{ $films->withQueryString()->links() }}
    </div>
@endif
@endsection