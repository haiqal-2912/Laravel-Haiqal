<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::all();
        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ], [
        'name.required'      => 'Nama wajib diisi.',
        'name.max'           => 'Nama maksimal 100 karakter.',
        'email.required'     => 'Email wajib diisi.',
        'email.email'        => 'Format email tidak valid.',
        'email.unique'       => 'Email sudah terdaftar.',
        'password.required'  => 'Password wajib diisi.',
        'password.min'       => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    // password otomatis di-hash oleh cast 'hashed' di model User
    User::create($validated);

    return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
        'password' => 'nullable|min:8|confirmed',   // boleh kosong saat edit
    ], [
        'name.required'      => 'Nama wajib diisi.',
        'name.max'           => 'Nama maksimal 100 karakter.',
        'email.required'     => 'Email wajib diisi.',
        'email.email'        => 'Format email tidak valid.',
        'email.unique'       => 'Email sudah terdaftar.',
        'password.min'       => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    $user->name  = $validated['name'];
    $user->email = $validated['email'];

    if (!empty($validated['password'])) {
        $user->password = $validated['password'];
    }
    $user->save();
    return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data Berhasil Dihapus!');
    }
}
