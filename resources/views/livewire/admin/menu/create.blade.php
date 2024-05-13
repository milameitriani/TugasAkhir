@section('pretitle', 'Menu')

@section('title', 'Tambah Menu')

@section('button')

    <a class="btn btn-light" href="{{ route('admin.menus.index') }}">Kembali</a>

@endsection

<form class="row" wire:submit.prevent="save">
    <div class="col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambah Menu</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" wire:model.defer="name">

                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-group @error('price') is-invalid @enderror">
                    <label class="form-label">Harga</label>
                    <div wire:ignore>
                        <input type="text" class="form-control" name="price" placeholder="Harga">
                    </div>

                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Deksripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" placeholder="Deksripsi" wire:model.defer="description"></textarea>

                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Jenis Menu</label>
                    <select class="form-control @error('type') is-invalid @enderror" wire:model="type">
                        <option value="food">Makanan</option>
                        <option value="drink">Minuman</option>
                    </select>

                    @error('type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-group @error('category_id') is-invalid @enderror">
                    <label class="form-label">Kategori</label>
                    <div wire:ignore>
                        <input class="form-control custom-tagify" name="category_id" placeholder="Kategori">
                    </div>

                    @error('category_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror" wire:model.defer="photo">

                    @error('photo')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.menus.index') }}" class="btn btn-light">Batal</a>
                <button class="btn btn-primary" wire:loading.attr="disabled">Simpan</button>
            </div>
        </div>
    </div>
</form>

@push('css')
    <link rel="stylesheet" href="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.css') }}">
@endpush

@push('js')

    <script src="{{ asset('tabler-dev/dist/libs/tagify/dist/tagify.min.js') }}"></script>
    <script src="{{ asset('tabler-dev/dist/libs/inputmask/dist/inputmask.min.js') }}"></script>

    <script>
        const getCategoryUrl = '{{ route('ajax.admin.categories.search') }}'

        const setCategory = val => @this.set('category_id', val)
        const setPrice = val => @this.set('price', val)
        const removeCategory = () => @this.set('category_id', null)
        
        const getType = () => @this.get('type')
    </script>

    <script src="{{ asset('js/admin/menu/create.js') }}"></script>

@endpush