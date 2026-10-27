@extends('layout')
@section('title', 'CV - ' . ($profil->nama ?? 'Curriculum Vitae'))

@section('content')
<style>
    .cv-hero {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #fff;
        border-radius: 1rem;
    }
    .cv-foto {
        width: 160px; height: 160px; object-fit: cover;
        border: 5px solid rgba(255,255,255,.85);
    }
    .cv-inisial {
        width: 160px; height: 160px; font-size: 4rem;
        border: 5px solid rgba(255,255,255,.85);
        background: rgba(255,255,255,.2);
    }
    .section-title {
        font-weight: 700;
        border-left: 5px solid #3b82f6;
        padding-left: .75rem;
        margin-bottom: 1.25rem;
    }
    .timeline { position: relative; padding-left: 1.75rem; border-left: 3px solid #dbeafe; }
    .timeline-item { position: relative; margin-bottom: 1.5rem; }
    .timeline-item::before {
        content: ""; position: absolute; left: -2.2rem; top: .35rem;
        width: 14px; height: 14px; border-radius: 50%;
        background: #3b82f6; border: 3px solid #fff; box-shadow: 0 0 0 2px #3b82f6;
    }
    .stat-card { border: 0; border-radius: .75rem; }
    @media print {
        .d-print-none { display: none !important; }
        body { background: #fff !important; }
        .card, .cv-hero { box-shadow: none !important; }
        .cv-hero { background: #1e3a8a !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    }
</style>

{{-- ===== HEADER ===== --}}
<div class="cv-hero p-4 p-md-5 mb-4 shadow">
    <div class="row align-items-center g-4">
        <div class="col-md-auto text-center">
            @if($profil?->foto)
                <img src="{{ asset('storage/'.$profil->foto) }}" alt="Foto {{ $profil->nama }}"
                     class="cv-foto rounded-circle shadow">
            @else
                <div class="cv-inisial rounded-circle text-white d-inline-flex align-items-center justify-content-center shadow">
                    {{ strtoupper(substr($profil->nama ?? '?', 0, 1)) }}
                </div>
            @endif
        </div>
        <div class="col-md text-center text-md-start">
            <h1 class="fw-bold mb-1">{{ $profil->nama ?? 'Nama belum diisi' }}</h1>
            <p class="fs-5 mb-3 opacity-75">{{ $profil->headline ?? 'Headline belum diisi' }}</p>
            <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                @if($profil?->email)
                    <a href="mailto:{{ $profil->email }}" class="btn btn-light btn-sm">✉ {{ $profil->email }}</a>
                @endif
                @if($profil?->telepon)
                    <a href="tel:{{ $profil->telepon }}" class="btn btn-outline-light btn-sm">☎ {{ $profil->telepon }}</a>
                @endif
                @if($profil?->lokasi ?? false)
                    <span class="btn btn-outline-light btn-sm disabled">📍 {{ $profil->lokasi }}</span>
                @endif
                <button onclick="window.print()" class="btn btn-warning btn-sm d-print-none">🖨 Cetak CV</button>
            </div>
        </div>
    </div>
</div>

{{-- ===== RINGKASAN ANGKA ===== --}}
<div class="row g-3 mb-4 text-center">
    <div class="col-4">
        <div class="card stat-card shadow-sm"><div class="card-body">
            <div class="fs-2 fw-bold text-primary">{{ $pengalaman->count() }}</div>
            <div class="text-muted small">Pengalaman &amp; Pendidikan</div>
        </div></div>
    </div>
    <div class="col-4">
        <div class="card stat-card shadow-sm"><div class="card-body">
            <div class="fs-2 fw-bold text-primary">{{ $skills->flatten()->count() }}</div>
            <div class="text-muted small">Skill</div>
        </div></div>
    </div>
    <div class="col-4">
        <div class="card stat-card shadow-sm"><div class="card-body">
            <div class="fs-2 fw-bold text-primary">{{ $skills->count() }}</div>
            <div class="text-muted small">Kategori Keahlian</div>
        </div></div>
    </div>
</div>

{{-- ===== TENTANG SAYA ===== --}}
@if($profil?->tentang ?? false)
<div class="card shadow-sm mb-4">
    <div class="card-body p-4">
        <h4 class="section-title">Tentang Saya</h4>
        <p class="mb-0">{!! nl2br(e($profil->tentang)) !!}</p>
    </div>
</div>
@endif

<div class="row g-4">
    {{-- ===== PENGALAMAN (TIMELINE) ===== --}}
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-body p-4">
                <h4 class="section-title">Pengalaman &amp; Pendidikan</h4>
                <div class="timeline">
                    @forelse($pengalaman as $p)
                        <div class="timeline-item">
                            <span class="badge text-bg-primary mb-1">
                                {{ $p->tahun_mulai }} - {{ $p->tahun_selesai ?: 'Sekarang' }}
                            </span>
                            <h5 class="mb-0">{{ $p->judul }}</h5>
                            <div class="text-muted">{{ $p->instansi }}</div>
                            @if($p->deskripsi)
                                <p class="mt-2 mb-0">{{ $p->deskripsi }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-muted mb-0">Belum ada data pengalaman.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ===== SKILL ===== --}}
    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-body p-4">
                <h4 class="section-title">Skill</h4>
                @forelse($skills as $kategori => $items)
                    <h6 class="text-primary text-uppercase small fw-bold mt-3">{{ $kategori }}</h6>
                    @foreach($items as $s)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between small">
                                <span>{{ $s->nama_skill }}</span>
                                <span class="text-muted">{{ $s->level }}%</span>
                            </div>
                            <div class="progress" style="height:8px">
                                <div class="progress-bar" role="progressbar" style="width: {{ $s->level }}%"
                                     aria-valuenow="{{ $s->level }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                @empty
                    <p class="text-muted mb-0">Belum ada data skill.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- ===== KONTAK ===== --}}
<div class="card shadow-sm mt-4 text-center">
    <div class="card-body p-4">
        <h4 class="section-title text-start">Hubungi Saya</h4>
        <p class="text-muted">Tertarik bekerja sama atau ingin berdiskusi? Silakan hubungi saya.</p>
        @if($profil?->email)
            <a href="mailto:{{ $profil->email }}" class="btn btn-primary">Kirim Email</a>
        @endif
        @if($profil?->telepon)
            <a href="tel:{{ $profil->telepon }}" class="btn btn-outline-primary">Telepon</a>
        @endif
    </div>
</div>

<p class="text-center text-muted small mt-4 mb-0">
    &copy; {{ date('Y') }} {{ $profil->nama ?? '' }}. Dibuat dengan Laravel.
</p>
@endsection
