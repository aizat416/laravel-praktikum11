<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; 

class MahasiswaController extends Controller
{

    public function index()
    {
        $rows = Mahasiswa::all(); 
        return view('mahasiswa.index', compact('rows'));    
    }

    public function create()
    {
        return view('mahasiswa.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'mhsw_nim' => 'bail|required|unique:tb_mhsw',
            'mhsw_nama' => 'required'
        ],
        [
            'mhsw_nim.required' => 'NIM wajib diisi',
            'mhsw_nim.unique' => 'NIM sudah ada',
            'mhsw_nama.required' => 'Nama wajib diisi'
        ]);

        Mahasiswa::create([
            'mhsw_nim' => $request->mhsw_nim,
            'mhsw_nama' => $request->mhsw_nama,
            'mhsw_jurusan' => $request->mhsw_jurusan,
            'mhsw_alamat' => $request->mhsw_alamat
        ]);

        return redirect('mahasiswa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $row = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('row'));

    }


    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'mhsw_nim' => 'bail|required',
                'mhsw_nama' => 'required'
            ],
            [
                'mhsw_nim.required' => 'NIM wajib diisi',
                'mhsw_nama.required' => 'Nama wajib diisi'
            ]
        );

        $row = Mahasiswa::findOrFail($id);
        $row->update([
            'mhsw_nim' => $request->mhsw_nim,
            'mhsw_nama' => $request->mhsw_nama,
            'mhsw_jurusan' => $request->mhsw_jurusan,
            'mhsw_alamat' => $request->mhsw_alamat
        ]);

        return redirect('mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Mahasiswa::findOrFail($id);
        $row->delete();

        return redirect('mahasiswa');
    }
}
