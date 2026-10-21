<?php

namespace App\Http\Controllers;

use App\Models\penjual;
use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(): View
    {
        $produkList = Produk::where('Id_Penjual', Auth::id())
            ->latest()
            ->get();

        return view('penjual.produk.index', compact('produkList'));
    }

    public function create(): View
    {
        $this->ensureSellerProfileExists();

        return view('penjual.produk.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $penjual = $this->ensureSellerProfileExists();
        $validatedData = $request->validate($this->rules(), $this->validationMessages());

        $penjual->produk()->create($validatedData);

        return redirect()->route('penjual.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(string $id): View
    {
        $produk = $this->findSellerProduct($id);

        return view('penjual.produk.edit', compact('produk'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $produk = $this->findSellerProduct($id);
        $validatedData = $request->validate($this->rules(), $this->validationMessages());
        $produk->update($validatedData);

        return redirect()->route('penjual.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $this->findSellerProduct($id)->delete();

        return redirect()->route('penjual.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    private function rules(): array
    {
        return [
            'Nama_Produk' => ['required', 'string', 'max:100', 'regex:/\pL/u'],
            'Deskripsi' => 'nullable|string|max:5000',
            'Keterangan_Tambahan' => 'nullable|string|max:5000',
            'Harga' => 'required|numeric|decimal:0,2|min:0|max:9999999999.99',
            'Stok' => 'required|integer|min:0|max:4294967295',
            'Status' => 'required|in:tersedia,habis',
        ];
    }

    private function validationMessages(): array
    {
        return [
            'Nama_Produk.required' => 'Nama produk wajib diisi.',
            'Nama_Produk.regex' => 'Nama produk harus mengandung setidaknya satu huruf.',
            'Nama_Produk.max' => 'Nama produk maksimal 100 karakter.',
            'Deskripsi.max' => 'Deskripsi maksimal 5000 karakter.',
            'Keterangan_Tambahan.max' => 'Keterangan atau request tambahan maksimal 5000 karakter.',
            'Harga.required' => 'Harga wajib diisi.',
            'Harga.numeric' => 'Harga harus berupa angka.',
            'Harga.decimal' => 'Harga hanya boleh memiliki maksimal 2 angka di belakang koma.',
            'Harga.min' => 'Harga tidak boleh kurang dari 0.',
            'Harga.max' => 'Harga melebihi batas maksimum.',
            'Stok.required' => 'Stok wajib diisi.',
            'Stok.integer' => 'Stok harus berupa bilangan bulat.',
            'Stok.min' => 'Stok tidak boleh kurang dari 0.',
            'Stok.max' => 'Stok melebihi batas maksimum.',
            'Status.required' => 'Status produk wajib dipilih.',
            'Status.in' => 'Status produk tidak valid.',
        ];
    }

    private function findSellerProduct(string $id): Produk
    {
        return Produk::where('Id_Penjual', Auth::id())->findOrFail($id);
    }

    private function ensureSellerProfileExists(): penjual
    {
        return penjual::where('Id_Penjual', Auth::id())->firstOrFail();
    }
}
