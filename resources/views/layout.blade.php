<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CV Saya')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand navbar-dark bg-dark mb-4 d-print-none">
    <div class="container">

        <a class="navbar-brand" href="{{ route('cv') }}">CV Saya</a>
        <div class="navbar-nav">
            <a class="nav-link" href="{{ route('admin.profil.edit') }}">Kelola Profil</a>
            <a class="nav-link" href="{{ route('admin.pengalaman.index') }}">Kelola Pengalaman</a>
            <a class="nav-link" href="{{ route('admin.skill.index') }}">Kelola Skill</a>
        </div>
    </div>
</nav>
<div class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
