<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\Kategori;
use File;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::all();
        return view('berita.index', compact('berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::get();
        return view('berita.create', compact('kategori'));
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
            'nama'        => 'required',
            'deskripsi'   => 'required',
            'gambar'      => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'kategori_id' => 'required'
        ]);

        $gambarName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('img/berita'), $gambarName);

        $berita = new Berita;

        $berita->nama        = $request->nama;
        $berita->deskripsi   = $request->deskripsi;
        $berita->gambar      = $gambarName;
        $berita->kategori_id = $request->kategori_id;

        $berita->save();

        return redirect('/berita');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::get();
        $berita   = Berita::findOrFail($id);
        return view('berita.edit', compact('berita', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'        => 'required',
            'deskripsi'   => 'required',
            'gambar'      => 'image|mimes:jpg,png,jpeg|max:2048',
            'kategori_id' => 'required'
        ]);

        if ($request->has('gambar')) 
        {
            $berita = Berita::find($id);

            $path = "img/berita/";
            File::delete($path.$berita->gambar);

            $gambarName = time().'.'.$request->gambar->extension();
            $request->gambar->move(public_path('img/berita'), $gambarName);
            
            $berita->nama        = $request->nama;
            $berita->deskripsi   = $request->deskripsi;
            $berita->gambar      = $gambarName;
            $berita->kategori_id = $request->kategori_id;

            $berita->save();

            return redirect('/berita');
        }
        else 
        {
            $berita = Berita::find($id);

            $berita->nama        = $request->nama;
            $berita->deskripsi   = $request->deskripsi;
            $berita->kategori_id = $request->kategori_id;

            $berita->save();

            return redirect('/berita');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $berita = Berita::find($id);

        $path = "img/berita/";
        File::delete($path.$berita->gambar);

        $berita->delete();

        return redirect('/berita');
    }
}
