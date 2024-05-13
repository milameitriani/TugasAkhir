<div class="modal modal-blur fade" id="logout">
    <div class="modal-dialog modal-sm">
        <form class="modal-content" action="{{ route('logout') }}" method="post">
            @csrf
            <div class="modal-body">
                <h3 class="modal-title">Keluar</h3>
                <div class="text-muted">Keluar dari aplikasi?</div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-white" type="button" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Keluar</button>
            </div>
        </form>
    </div>
</div>