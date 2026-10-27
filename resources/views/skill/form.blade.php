@extends('layout')
@section('title', isset($skill) ? 'Edit Skill' : 'Tambah Skill')
@section('content')
<h4>{{ isset($skill) ? 'Edit' : 'Tambah' }} Skill</h4>
<form method="POST"
      action="{{ isset($skill) ? route('admin.skill.update', $skill) : route('admin.skill.store') }}"
      class="card card-body shadow-sm">
    @csrf
    @isset($skill) @method('PUT') @endisset

    <div class="mb-3">
        <label class="form-label">Nama Skill</label>
        <input type="text" name="nama_skill" class="form-control @error('nama_skill') is-invalid @enderror"
               value="{{ old('nama_skill', $skill->nama_skill ?? '') }}">
        @error('nama_skill')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
               value="{{ old('kategori', $skill->kategori ?? '') }}" placeholder="Programming / Design / Soft Skill">
        @error('kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Level (0-100)</label>
        <input type="number" name="level" min="0" max="100" class="form-control @error('level') is-invalid @enderror"
               value="{{ old('level', $skill->level ?? '') }}">
        @error('level')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.skill.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
