<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function edit()
    {
        $profil = Profil::first();
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama'     => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'email'    => 'nullable|email|max:255',
            'telepon'  => 'nullable|string|max:30',
            'foto'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // maks 2 MB
        ]);

        $profil = Profil::first() ?? new Profil;

        if ($request->hasFile('foto')) {
            // hapus foto lama supaya storage tidak menumpuk
            if ($profil->foto) {
                Storage::disk('public')->delete($profil->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-profil', 'public');
        }

        $profil->fill($data)->save();

        return redirect()->route('admin.profil.edit')->with('success', 'Profil berhasil disimpan.');
    }
}
