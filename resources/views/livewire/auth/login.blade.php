@section('title', 'Masuk ke aplikasi')


<form class="card card-md" wire:submit.prevent="login">
  <div class="card-body">
    <img src="{{ asset('logo.png') }}" width="100" height="60" style="display:block; margin:auto;" > </P>
    <h2 class="card-title text-center mb-4">Masuk Ke Akun</h2>
    <div class="mb-3">
      <label class="form-label">Your Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your Name" wire:model.defer="name" autofocus>

      @error('name')
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