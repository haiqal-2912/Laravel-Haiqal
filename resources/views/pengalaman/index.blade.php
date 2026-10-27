@extends('layout')
@section('title', 'Kelola Pengalaman')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Pengalaman &amp; Pendidikan</h4>
    <a href="{{ route('admin.pengalaman.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
<table class="table table-bordered bg-white">
    <thead><tr><th>#</th><th>Judul</th><th>Instansi</th><th>Tahun</th><th width="160">Aksi</th></tr></thead>
    <tbody>
    @forelse($data as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->judul }}</td>
            <td>{{ $p->instansi }}</td>
            <td>{{ $p->tahun_mulai }} - {{ $p->tahun_selesai ?? 'Sekarang' }}</td>
            <td>
                <a href="{{ route('admin.pengalaman.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.pengalaman.destroy', $p) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus data ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
