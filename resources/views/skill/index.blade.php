@extends('layout')
@section('title', 'Kelola Skill')
@section('content')
<div class="d-flex justify-content-between mb-3">
    <h4>Data Skill</h4>
    <a href="{{ route('admin.skill.create') }}" class="btn btn-primary">+ Tambah</a>
</div>
<table class="table table-bordered bg-white">
    <thead><tr><th>#</th><th>Skill</th><th>Kategori</th><th>Level</th><th width="160">Aksi</th></tr></thead>
    <tbody>
    @forelse($data as $i => $s)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $s->nama_skill }}</td>
            <td>{{ $s->kategori }}</td>
            <td>{{ $s->level }}%</td>
            <td>
                <a href="{{ route('admin.skill.edit', $s) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.skill.destroy', $s) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Hapus skill ini?')">
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
