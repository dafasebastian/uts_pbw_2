@extends('layouts.penjual')
@section('title', 'Edit Produk')

@section('isi')
<h1 class="text-3xl font-bold mb-1.5">Edit Produk</h1>
<p class="text-sm text-[#6b7385] mb-7">Perbarui informasi produk toko Anda.</p>

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

    <form action="{{ route('penjual.produk.update', $produk->Id_Produk) }}" method="POST">
        @csrf
        @method('PUT')
        @include('penjual.produk._form', ['produk' => $produk])
        <div class="flex justify-end gap-3 mt-8">
            <a href="{{ route('penjual.produk.index') }}" class="px-5 py-2.5 text-sm text-[#6b7385]">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-lg font-bold bg-[#2878eb] text-white hover:bg-blue-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
