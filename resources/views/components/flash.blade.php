@if (session()->has('success'))
    <div class="alert alert-dismissible alert-success">
        {{ session('success') }}

        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif