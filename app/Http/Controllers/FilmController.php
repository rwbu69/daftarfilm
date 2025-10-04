<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Film::where('user_id', auth()->id());

        // Filter berdasarkan genre
        if ($request->filled('genre')) {
            $query->where('genre', 'like', '%' . $request->genre . '%');
        }

        // Filter berdasarkan rating
        if ($request->filled('rating')) {
            $query->where('rating', '>=', $request->rating);
        }

        // Filter berdasarkan status watched
        if ($request->filled('watched')) {
            $query->where('watched', $request->watched === 'true');
        }

        $films = $query->orderBy('created_at', 'desc')->paginate(12);
        $genres = Film::where('user_id', auth()->id())->distinct()->pluck('genre')->filter();
        
        return view('films.index', compact('films', 'genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2030',
            'rating' => 'required|numeric|min:0|max:10',
            'watched' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('films', 'public');
        }

        Film::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'year' => $request->year,
            'rating' => $request->rating,
            'watched' => $request->has('watched'),
            'image' => $imagePath,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        // Check if the film belongs to the authenticated user
        if ($film->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        // Check if the film belongs to the authenticated user
        if ($film->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        // Check if the film belongs to the authenticated user
        if ($film->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2030',
            'rating' => 'required|numeric|min:0|max:10',
            'watched' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $updateData = [
            'title' => $request->title,
            'genre' => $request->genre,
            'year' => $request->year,
            'rating' => $request->rating,
            'watched' => $request->has('watched')
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($film->image && \Storage::disk('public')->exists($film->image)) {
                \Storage::disk('public')->delete($film->image);
            }
            $updateData['image'] = $request->file('image')->store('films', 'public');
        }

        $film->update($updateData);

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        // Check if the film belongs to the authenticated user
        if ($film->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Delete image if exists
        if ($film->image && \Storage::disk('public')->exists($film->image)) {
            \Storage::disk('public')->delete($film->image);
        }
        
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus!');
    }

    /**
     * Toggle watched status
     */
    public function toggleWatched(Film $film)
    {
        // Check if the film belongs to the authenticated user
        if ($film->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $film->update(['watched' => !$film->watched]);
        return redirect()->back()->with('success', 'Status film berhasil diperbarui!');
    }
}
