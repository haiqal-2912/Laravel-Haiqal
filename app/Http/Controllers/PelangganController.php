<?php
namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
class PelangganController extends Controller
{

    public function index(Request $request)
    {
        $filterableColumns = ['gender'];

       $searchableColumns = ['first_name','last_name','email'];

        $pageData['dataPelanggan'] = Pelanggan::filter($request,$filterableColumns)
                                    ->search($request,$searchableColumns)
                                    ->paginate(10)->withQueryString();
        return view('admin.pelanggan.index', $pageData);
    }


    public function create()
    {
        return view('admin.pelanggan.create');
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');

    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $pelanggan_id          = $id;
        $pelanggan             = Pelanggan::findOrFail($pelanggan_id);
        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;
        $pelanggan->save();
        return redirect()->route('pelanggan.index')->with('success', 'Perubahan Data Berhasil!');
    }


    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
