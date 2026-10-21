<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ulasan;
use Illuminate\Support\Facades\Auth;

class ResponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah-respon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Id_Respon' => 'required|exists:ulasan,Id_Ulasan',
            'Respon' => 'required|string|max:255',
        ]);

        $ulasan = ulasan::findOrFail($validatedData['Id_Respon']);
        $this->ensureSellerOwns($ulasan);
        $ulasan->respon()->updateOrCreate([], [
            'Respon' => $validatedData['Respon'],
        ]);

        return redirect()->back()->with('success', 'Respon berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ulasan $ulasan)
    {
        $validatedData = $request->validate([
            'Respon' => 'required|string|max:255',
        ]);

        $this->ensureSellerOwns($ulasan);
        $ulasan->respon()->firstOrFail()->update([
            'Respon' => $validatedData['Respon'],
        ]);

        return redirect()->back()->with('success', 'Respon berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ulasan $ulasan)
    {
        $this->ensureSellerOwns($ulasan);
        $ulasan->delete();

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    private function ensureSellerOwns(ulasan $ulasan): void
    {
        abort_unless((int) $ulasan->Id_Penjual === (int) Auth::id(), 403);
    }
}
