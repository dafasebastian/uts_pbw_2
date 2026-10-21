@extends('layouts.penjual')
@section('title', 'Kelola Produk')

@section('isi')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-7">
    <div>
        <h1 class="text-3xl font-bold mb-1.5">Kelola Produk</h1>
        <p class="text-sm text-[#6b7385]">Daftar produk yang dijual di toko Anda.</p>
    </div>
    <a href="{{ route('penjual.produk.create') }}" class="inline-flex justify-center px-5 py-2.5 rounded-lg font-bold bg-[#2878eb] text-white hover:bg-blue-700 transition">
        + Tambah Produk
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="border border-[#dde1ea] rounded-[32px] p-5 md:p-7 bg-white">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left">
                    <th class="px-3 py-3">Nama Produk</th>
                    <th class="px-3 py-3">Harga</th>
                    <th class="px-3 py-3">Stok</th>
                    <th class="px-3 py-3">Status</th>
                    <th class="px-3 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produkList as $produk)
                    <tr>
                        <td class="px-3 py-4 border-t border-[#dde1ea]">
                            <div class="font-semibold">{{ $produk->Nama_Produk }}</div>
                            @if($produk->Deskripsi)
                                <p class="mt-1 max-w-md text-xs text-[#6b7385]">{{ $produk->Deskripsi }}</p>
                            @else
                                <p class="mt-1 text-xs text-[#9aa1af]">Tidak ada deskripsi.</p>
                            @endif
                        </td>
                        <td class="px-3 py-4 border-t border-[#dde1ea] whitespace-nowrap">
                            Rp{{ number_format((float) $produk->Harga, 0, ',', '.') }}
                        </td>
                        <td class="px-3 py-4 border-t border-[#dde1ea]">{{ $produk->Stok }}</td>
                        <td class="px-3 py-4 border-t border-[#dde1ea]">
                            @if($produk->Status === 'tersedia' && $produk->Stok > 0)
                                <span class="inline-flex px-2.5 py-1 rounded-full bg-green-50 text-green-700 text-xs font-semibold">Tersedia</span>
                            @else
                                <span class="inline-flex px-2.5 py-1 rounded-full bg-red-50 text-red-700 text-xs font-semibold">Habis</span>
                            @endif
                        </td>
                        <td class="px-3 py-4 border-t border-[#dde1ea]">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('penjual.produk.edit', $produk->Id_Produk) }}" class="px-3 py-1.5 rounded-lg border border-[#dde1ea] font-semibold hover:bg-gray-50">Edit</a>
                                <form action="{{ route('penjual.produk.destroy', $produk->Id_Produk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg border border-red-200 text-red-600 font-semibold hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-[#6b7385]">
                            Belum ada produk. Klik “Tambah Produk” untuk mulai menambahkan produk toko.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
