@section('title', 'Masuk ke aplikasi')

<form class="card card-md" wire:submit.prevent="login">
  <div class="card-body">
    <img src="{{ asset('logo.png') }}" width="100" height="60" style="display:block; margin:auto;" > </P>
    <h2 class="card-title text-center mb-4">Masuk Ke Admin</h2>
    <div class="mb-3">
      <label class="form-label">Nama Pengguna</label>
      <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Masukan Nama Pengguna" wire:model.defer="username" autofocus>

      @error('username')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-2">
      <label class="form-label">
        Kata Sandi
      </label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kata Sandi" wire:model.defer="password" autofocus>

      @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
      @enderror
    </div>
    <div class="mb-2">
      <label class="form-check">
        <input type="checkbox" class="form-check-input" wire:model.defer="remember" />
        <span class="form-check-label">Remember me on this device</span>
      </label>
    </div>
    <div class="form-footer">
      <button type="submit" class="btn btn-primary w-100" wire:loading.attr="disabled" wire:target="login">Masuk</button>
    </div>
  </div>
</form>