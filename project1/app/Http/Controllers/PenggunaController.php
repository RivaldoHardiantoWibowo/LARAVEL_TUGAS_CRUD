<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengguna = User::all();
        return view('pengguna/index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $defaultPassword = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data user');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pengguna = User::find($id);
        //atau $medicine = Medicine::WHERE('id', $id)->first()

        return view('pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email  ',
            'role' => 'required',
        ]);

        $defaultPassword = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);

        User::where('id', $id)->update([
            'name' => $request->name,   
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword),
        ]);

        return redirect()->route('pengguna.akun')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return redirect()->route('pengguna.akun')->with('deleted', 'Berhasil menghapus data!');
    }
}

