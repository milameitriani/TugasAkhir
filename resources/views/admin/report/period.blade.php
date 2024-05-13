@extends('_layouts.admin.app')

@section('pretitle', 'Laporan')

@section('title', 'Laporan Per Periode')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Laporan Per Periode</h3>
        </div>
        <div class="card-body">
            <form target="_blank" action="{{ route('admin.reports.print.period') }}" class="mb-3">
                <label class="form-label">Periode</label>
                <div class="input-group mb-2">
                    <input type="date" class="form-control" name="start">
                    <input type="date" class="form-control" name="end">
                    <button class="btn" type="submit">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>

@endsection