<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengalaman;

class PengalamanController extends Controller
{
    private function rules(): array
    {
        return [
            'judul'         => 'required|string|max:255',
            'instansi'      => 'required|string|max:255',
            'tahun_mulai'   => 'required|digits:4',
            'tahun_selesai' => 'nullable|string|max:10',
            'deskripsi'     => 'nullable|string',
        ];
    }
    public function index()
    {
        $data = Pengalaman::orderByDesc('tahun_mulai')->get();
        return view('pengalaman.index', compact('data'));
    }

    public function create()
    {
        return view('pengalaman.form');
    }

    public function store(Request $request)
    {
        Pengalaman::create($request->validate($this->rules()));
        return redirect()->route('admin.pengalaman.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Pengalaman $pengalaman)
    {
        return view('pengalaman.form', compact('pengalaman'));
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $pengalaman->update($request->validate($this->rules()));
        return redirect()->route('admin.pengalaman.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();
        return redirect()->route('admin.pengalaman.index')->with('success', 'Data berhasil dihapus.');
    }
}
