@extends('_layouts.admin.app')

@section('pretitle', 'Laporan')

@section('title', 'Laporan Per Hari')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Laporan Per Hari</h3>
            <form target="_blank" action="{{ route('admin.reports.print.date') }}">
                <button name="date" value="{{ date('Y-m-d') }}" class="btn btn-primary">Hari Ini</button>
                <button name="date" value="{{ date('Y-m-d', strtotime('yesterday')) }}" class="btn btn-primary">Kemarin</button>
            </form>
        </div>
        <div class="card-body">
            <form target="_blank" action="{{ route('admin.reports.print.date') }}" class="mb-3">
                <label class="form-label">Tanggal</label>
                <div class="input-group mb-2">
                    <input type="date" class="form-control" name="date">
                    <button class="btn" type="submit">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>

@endsection