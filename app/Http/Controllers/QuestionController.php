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
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'pertanyaan' => $request->pertanyaan,
        ];

        // Simpan data & pesan ke dalam Session
        session()->put('data_pertanyaan', $data);
        session()->flash('info', 'Data Berhasil Dimasukkan !');

        return redirect('/home');
    }
    public function respon()
    {
        // Ambil data dari session
        $data = session('data_pertanyaan');

        // Jika tidak ada data, kembalikan ke /home
        if (!$data) {
            return redirect('/home');
        }

        // Tampilkan view beserta datanya
        return view('home-question-respon', $data);
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
