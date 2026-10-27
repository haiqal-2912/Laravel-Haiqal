<?php
namespace App\Http\Controllers;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_skill' => 'required|string|max:255',
            'level'      => 'required|integer|min:0|max:100',
            'kategori'   => 'required|string|max:100',
        ];
    }

    public function index()
    {
        $data = Skill::orderBy('kategori')->get();
        return view('skill.index', compact('data'));
    }

    public function create()
    {
        return view('skill.form');
    }

    public function store(Request $request)
    {
        Skill::create($request->validate($this->rules()));
        return redirect()->route('admin.skill.index')->with('success', 'Skill berhasil ditambahkan.');
    }

    public function edit(Skill $skill)
    {
        return view('skill.form', compact('skill'));
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($request->validate($this->rules()));
        return redirect()->route('admin.skill.index')->with('success', 'Skill berhasil diubah.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('admin.skill.index')->with('success', 'Skill berhasil dihapus.');
    }
}
