<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
// Validasi input (opsional tapi sangat disarankan)
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pertanyaan' => 'required',
        ]);

        // Mengalihkan halaman (redirect) sambil mengirim variabel lewat session flash
        return redirect('/home-question-respon')->with([
            'info'       => 'Data Berhasil Dimasukkan !',
            'nama'       => $request->nama,
            'email'      => $request->email,
            'pertanyaan' => $request->pertanyaan,
        ]);
}

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
