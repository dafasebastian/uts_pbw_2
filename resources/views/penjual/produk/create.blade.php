@extends('layouts.penjual')
@section('title', 'Tambah Produk')

@section('isi')
<h1 class="text-3xl font-bold mb-1.5">Tambah Produk</h1>
<p class="text-sm text-[#6b7385] mb-7">Masukkan informasi produk yang ingin ditampilkan di toko.</p>

<div class="border border-[#dde1ea] rounded-[32px] p-6 md:p-8 bg-white max-w-3xl">
    @if($errors->any())
        <div class="px-4 py-3 rounded-xl mb-5 text-sm bg-[#fdeaea] text-[#e03a3a]">
            <ul class="list-disc ml-4">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjual.produk.store') }}" method="POST">
        @csrf
        @include('penjual.produk._form')
        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('penjual.produk.index') }}" class="px-5 py-2.5 text-sm text-[#6b7385]">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-lg font-bold bg-[#2878eb] text-white hover:bg-blue-700">Simpan Produk</button>
        </div>
    </form>
</div>
@endsection
