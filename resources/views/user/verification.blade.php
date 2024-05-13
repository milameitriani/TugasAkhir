@extends('_layouts.app')

@section('pretitle', 'Akun')

@section('title', 'Akun Belum Aktif')

@section('content')
  
  <div class="card">
    <div class="card-body">
      <div class="alert alert-danger mb-3">Akun anda belum aktif</div>

      Silakan hubungi admin/petugas untuk mengaktifkan akun anda.
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <tr>
            <th>Nama</th>
            <td>{{ user('name') }}</td>
          </tr>
          <tr>
            <th>Nama Pengguna</th>
            <td>{{ user('username') }}</td>
          </tr>
        </table>
      </div>
    </div>
  </div>

@endsection