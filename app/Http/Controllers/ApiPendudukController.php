<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use Illuminate\Support\Facades\Storage;

class ApiPendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Penduduk::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'penNik' => 'required|unique:penduduk,penNik',
            'penNama' => 'required',
            'penTempatLahir' => 'required',
            'penTglLahir' => 'required|date',
            'penImage' => 'nullable|string'  // base64 format
        ]);
    
        $data = $request->all();
    
        $penduduk = Penduduk::create($data);
        return response()->json($penduduk, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penduduk = Penduduk::find($id);
        if ($penduduk) {
            return response()->json($penduduk, 200);
        }
        return response()->json(['message' => 'Data not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $request->validate([
            'penNik' => 'required|unique:penduduk,penNik,' . $id . ',penId',
            'penNama' => 'required',
            'penTempatLahir' => 'required',
            'penTglLahir' => 'required|date',
            'penImage' => 'nullable|string'  // base64 format
        ]);

        $data = $request->all();

        $penduduk->update($data);
        return response()->json($penduduk, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penduduk = Penduduk::find($id);

        if (!$penduduk) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $penduduk->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}
