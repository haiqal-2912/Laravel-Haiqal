@extends('layout')
@section('title', 'Kelola Profil')
@section('content')
<h4>Profil &amp; Foto</h4>
<form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data"
      class="card card-body shadow-sm">
    @csrf
    @method('PUT')

    <div class="mb-3 text-center">
        <img id="preview"
             src="{{ $profil?->foto ? asset('storage/'.$profil->foto) : '' }}"
             class="rounded-circle border mb-2 {{ $profil?->foto ? '' : 'd-none' }}"
             style="width:140px;height:140px;object-fit:cover" alt="Foto profil">
        <input type="file" name="foto" accept="image/*"
               class="form-control @error('foto') is-invalid @enderror"
               onchange="previewFoto(this)">
        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <small class="text-muted">JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Lengkap</label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
               value="{{ old('nama', $profil->nama ?? '') }}">
        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Headline</label>
        <input type="text" name="headline" class="form-control"
               value="{{ old('headline', $profil->headline ?? '') }}" placeholder="Mahasiswa Teknik Informatika">
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $profil->email ?? '') }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control"
                   value="{{ old('telepon', $profil->telepon ?? '') }}">
        </div>
    </div>
    <div><button class="btn btn-primary">Simpan</button></div>
</form>

<script>
function previewFoto(input) {
    const img = document.getElementById('preview');
    if (input.files && input.files[0]) {
        img.src = URL.createObjectURL(input.files[0]);
        img.classList.remove('d-none');
    }
}
</script>
@endsection
