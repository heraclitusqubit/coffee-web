@csrf
<div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control">{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Harga</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
            class="form-control" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="form-control"
            required>
    </div>
</div>
<div class="form-group mb-2">
    <label>Kategori</label>
    <select name="category_id" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
                {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" name="image" class="form-control">
    @if (!empty($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" alt="" style="max-width:120px;margin-top:8px;">
    @endif
</div>
<button class="btn btn-primary">Simpan</button>
