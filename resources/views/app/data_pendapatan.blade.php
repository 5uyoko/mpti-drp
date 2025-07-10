@extends('app.master')

<style>
    * {
        box-sizing: border-box;
    }

    .btn-primary,
    .btn-save,
    .btn-add {
        background: #2563eb;
        color: #fff;
        border: none;
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 14px;
        transition: background 0.2s;
    }

    .btn-primary:hover,
    .btn-add:hover,
    .btn-save:hover {
        background: #1d4ed8;
    }

    .btn-danger,
    .btn-delete {
        background: #dc2626 !important;
        color: #fff !important;
        border: none;
        padding: 6px 14px;
        border-radius: 10px;
    }

    .btn-danger:hover,
    .btn-delete:hover {
        background: #b91c1c !important;
    }

    .btn-edit {
        background: #2563eb;
        color: #fff;
        border-radius: 10px;
        padding: 6px 14px;
        border: none;
    }

    .btn-edit:hover {
        background: #1d4ed8;
    }

    .filter-bar-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        margin: 16px 18px 0 18px;
        gap: 12px;
    }

    .filter-bar-top form {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .filter-bar-top input,
    .filter-bar-top select {
        border-radius: 8px;
        border: 1px solid #bfc9da;
        padding: 6px 10px;
        min-width: 130px;
        font-size: 14px;
    }

    .btn-add {
        margin-left: auto;
    }

    .card-income {
        background-color: #ffffff;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #d1d5db;
        transition: transform 0.2s;
    }

    .card-income:hover {
        transform: translateY(-4px);
    }

    .card-income .info-row {
        background: #f3f4f6;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 15px;
        margin-bottom: 8px;
    }

    .card-income strong {
        display: inline-block;
        width: 150px;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .grid-income-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .filter-bar-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-bar-top form {
            flex-direction: column;
            align-items: stretch;
            width: 100%;
        }

        .btn-add {
            width: 100%;
            margin-left: 0;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

@php
    $isAdmin = auth()->user()->role === 'admin';
@endphp

@section('konten')
<div class="content-body">

    <div class="filter-bar-top">
        <form method="GET" action="{{ url()->current() }}">
            <input type="text" name="search" placeholder="Cari Nama Kapal" value="{{ request('search') }}">
            <select name="year">
                <option value="">Tahun</option>
                @for ($i = now()->year - 10; $i <= now()->year; $i++)
                    <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <select name="month">
                <option value="">Bulan</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                    </option>
                @endfor
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <a href="{{ route('input_pendapatan') }}" class="btn btn-add">+ Tambah Data</a>
    </div>

    <div class="container-fluid mt-4">
        <div class="grid-income-cards">
            @foreach ($pendapatan as $item)
                <div class="card-income">
                    <div class="info-row"><strong>Nama Kapal:</strong> {{ $item->nama_kapal ?? '-' }}</div>
                    <div class="info-row"><strong>Rute:</strong> {{ $item->kota_asal}} - {{ $item->kota_tujuan }}</div>
                    <div class="info-row"><strong>Jenis Muatan:</strong> {{ $item->jenis_muatan }}</div>
                    <div class="info-row"><strong>Harga per Ton:</strong> Rp{{ number_format($item->harga_per_ton) }}</div>
                    <div class="info-row"><strong>Jumlah Muatan:</strong> {{ $item->jumlah_muatan }} ton</div>
                    <div class="info-row"><strong>Total Pendapatan:</strong> Rp{{ number_format($item->total_pendapatan) }}</div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('edit_pendapatan', $item->income_id) }}" class="btn btn-sm btn-edit">Edit</a>
                        <form method="POST" action="{{ route('destroy_pendapatan', $item->income_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-sm btn-danger btn-delete"
                                    @if(!$isAdmin) disabled style="opacity: 0.5; pointer-events: none;" @endif>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
