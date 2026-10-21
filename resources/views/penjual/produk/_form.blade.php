@php($produk = $produk ?? null)

<div class="space-y-5">
    <div>
        <label for="Nama_Produk" class="block text-sm font-bold mb-2">Nama Produk</label>
        <input id="Nama_Produk" name="Nama_Produk" type="text" maxlength="100" value="{{ old('Nama_Produk', $produk?->Nama_Produk) }}" required class="w-full px-3.5 py-3 border border-[#dde1ea] rounded-xl text-sm outline-none focus:border-[#2878eb]">
        @error('Nama_Produk')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="Deskripsi" class="block text-sm font-bold mb-2">Deskripsi</label>
        <textarea id="Deskripsi" name="Deskripsi" rows="4" maxlength="5000" class="w-full px-3.5 py-3 border border-[#dde1ea] rounded-xl text-sm outline-none focus:border-[#2878eb] resize-y">{{ old('Deskripsi', $produk?->Deskripsi) }}</textarea>
        @error('Deskripsi')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-5">
        <div>
            <label for="Harga" class="block text-sm font-bold mb-2">Harga (Rp)</label>
            <input id="Harga" name="Harga" type="number" min="0" max="9999999999.99" step="0.01" value="{{ old('Harga', $produk?->Harga) }}" required class="w-full px-3.5 py-3 border border-[#dde1ea] rounded-xl text-sm outline-none focus:border-[#2878eb]">
            @error('Harga')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="Stok" class="block text-sm font-bold mb-2">Stok</label>
            <input id="Stok" name="Stok" type="number" min="0" max="4294967295" step="1" value="{{ old('Stok', $produk?->Stok ?? 0) }}" required class="w-full px-3.5 py-3 border border-[#dde1ea] rounded-xl text-sm outline-none focus:border-[#2878eb]">
            @error('Stok')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div>
        <label for="Status" class="block text-sm font-bold mb-2">Status Produk</label>
        <select id="Status" name="Status" required class="w-full px-3.5 py-3 border border-[#dde1ea] rounded-xl text-sm outline-none focus:border-[#2878eb]">
            <option value="tersedia" @selected(old('Status', $produk?->Status ?? 'tersedia') === 'tersedia')>Tersedia</option>
            <option value="habis" @selected(old('Status', $produk?->Status) === 'habis')>Habis</option>
        </select>
        @error('Status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
