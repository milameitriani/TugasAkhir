@section('title', 'Buat akun baru')

<form class="card card-md" wire:submit.prevent="register">
  <div class="card-body">
    <h2 class="card-title text-center mb-4">Buat akun baru</h2>
    <div class="mb-3">
       <label class="form-label">Nama Pengguna</label>
       <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Nama Pengguna" wire:model.defer="username" autofocus>

       @error('username')
           <span class="invalid-feedback">{{ $message }}</span>
       @enderror
   </div>
   <div class="mb-3">
       <label class="form-label">Nama</label>
       <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nama" wire:model.defer="name">

       @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
       @enderror
   </div>
   <div class="mb-3">
       <label class="form-label">Kata Sandi</label>
       <div class="col">
           <div class="row gx-2">
               <div class="col">
                   <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" wire:model.defer="password">

                   @error('password')
                       <span class="invalid-feedback">{{ $message }}</span>
                   @enderror
               </div>
               <div class="col">
                   <input type="password" class="form-control" placeholder="Konfirmasi Kata Sandi" wire:model.defer="password_confirmation">
               </div>
           </div>
       </div>
   </div>
    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="register">Daftar</button>
    </div>
  </div>
</form>

<div class="text-center text-muted mt-3">
  Sudah memiliki akun? <a href="{{ route('login') }}" tabindex="-1">Masuk ke akun</a>
</div>