<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json([
            'message' => 'data siswa berhasil diambil',
            'data' => $siswa
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'nis' => 'required|string|max:255|unique:siswas,nis'
        ]);

        $siswa = Siswa::create($request->all());

        return response()->json([
            'message' => 'data siswa berhasil ditambahkan',
            'data' => $siswa
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        return response()->json([
            'message' => 'data siswa ketemu loh ya',
            'data' => $siswa
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'kelas' => 'sometimes|required|string|max:255',
            'nis' => 'sometimes|required|string|max:255|unique:siswas,nis,' . $siswa->id
        ]);

        $siswa->update($request->all());

        return response()->json([
            'message' => 'data siswa berhasil diupdate',
            'data' => $siswa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        if (!$siswa) {
            return response()->json([
                'message' => 'gaada loh ya'
            ], 404);
        }

        $siswa->delete();

        return response()->json([
            'message' => 'data siswa berhasil dihapus'
        ], 200);
    }
}
