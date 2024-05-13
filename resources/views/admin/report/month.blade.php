@extends('_layouts.admin.app')

@section('pretitle', 'Laporan')

@section('title', 'Laporan Per Bulan')

@section('content')

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">Laporan Per Bulan</h3>
            <form target="_blank" action="{{ route('admin.reports.print.month') }}">
                <button name="month" value="{{ date('m') }}" class="btn btn-primary">Bulan Ini</button>
            </form>
        </div>
        <div class="card-body">
            <form target="_blank" action="{{ route('admin.reports.print.month') }}" class="mb-3">
                <label class="form-label">Tanggal</label>
                <div class="input-group mb-2">
                    <select name="month" class="form-control">
                        @for ($i = 1; $i <= 12; $i++)
                            @php
                                $month = mktime(0,0,0,$i)
                            @endphp

                            <option value="{{ date('m', $month) }}">{{ date('M', $month) }}</option>
                        @endfor
                    </select>
                    <select name="year" class="form-control">
                        @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <button class="btn" type="submit">Tampilkan</button>
                </div>
            </form>
        </div>
    </div>

@endsection