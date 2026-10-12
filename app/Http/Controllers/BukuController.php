<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return response()->json([
            'message' => 'data buku berhasil diambil',
            'data' => $buku
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|string|max:255|unique:bukus,kode_buku',
            'judul' => 'required|string|max:255',
            'author' => 'required|string|max:255'
        ]);

        $buku = Buku::create($request->all());

        return response()->json([
            'message' => 'data buku berhasil ditambahkan',
            'data' => $buku
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        return response()->json([
            'message' => 'data buku ketemu loh ya',
            'data' => $buku
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        $request->validate([
            'kode_buku' => 'required|string|max:255|unique:bukus,kode_buku,' . $id,
            'judul' => 'required|string|max:255',
            'author' => 'required|string|max:255'
        ]);

        $buku->update($request->all());

        return response()->json([
            'message' => 'data buku berhasil diupdate',
            'data' => $buku
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);

        if (!$buku) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'message' => 'data buku berhasil dihapus'
        ], 200);
    }
}
