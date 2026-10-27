@extends('layout')
@section('title', isset($pengalaman) ? 'Edit Pengalaman' : 'Tambah Pengalaman')
@section('content')
<h4>{{ isset($pengalaman) ? 'Edit' : 'Tambah' }} Pengalaman</h4>
<form method="POST"
      action="{{ isset($pengalaman) ? route('admin.pengalaman.update', $pengalaman) : route('admin.pengalaman.store') }}"
      class="card card-body shadow-sm">
    @csrf
    @isset($pengalaman) @method('PUT') @endisset

    <div class="mb-3">
        <label class="form-label">Judul (jabatan / jurusan)</label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
               value="{{ old('judul', $pengalaman->judul ?? '') }}">
        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Instansi</label>
        <input type="text" name="instansi" class="form-control @error('instansi') is-invalid @enderror"
               value="{{ old('instansi', $pengalaman->instansi ?? '') }}">
        @error('instansi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Tahun Mulai</label>
            <input type="text" name="tahun_mulai" class="form-control @error('tahun_mulai') is-invalid @enderror"
                   value="{{ old('tahun_mulai', $pengalaman->tahun_mulai ?? '') }}" placeholder="2023">
            @error('tahun_mulai')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Tahun Selesai (kosongkan jika masih berjalan)</label>
            <input type="text" name="tahun_selesai" class="form-control"
                   value="{{ old('tahun_selesai', $pengalaman->tahun_selesai ?? '') }}">
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $pengalaman->deskripsi ?? '') }}</textarea>
    </div>
    <div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.pengalaman.index') }}" class="btn btn-secondary">Batal</a>
    </div>
</form>
@endsection
