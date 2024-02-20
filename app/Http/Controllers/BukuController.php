<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function input()
    {
       return view('buku.input');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required',
                'penulis' => 'required',
                'penerbit' => 'required',
                'tahunTerbit' => 'required|max:4',
            ],
            [
                'judul.required' => 'judul wajib diisi',
                'penulis.required' => 'penulis wajib diisi',
                'penerbit.required' => 'penerbit wajib diisi',
                'tahunTerbit.required' => 'tahun terbit wajib diisi',
            ],
        );

        $buku = [
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahunTerbit' => $request->tahunTerbit,
        ];

        Buku::create($buku);
        return redirect()->route('buku.index')->with('success', 'Data Berhasil diSimpan');
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
        $buku = Buku::findorfail($id);
        return view('buku.edit', compact('buku'));
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
        $buku = Buku::findorfail($id);
        $buku->update($request->all());

        return redirect()->route('buku.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findorfail($id);

        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus');
    }

    public function export_pdf()
    {
        $buku = Buku::select('*');
        
        $buku = $buku->get();

        // Meneruskan parameter ke tampilan ekspor
        $pdf = PDF::loadview('buku.exportPdf', ['buku'=>$buku]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // SET FILE NAME
        $filename = date('YmdHis') . '_buku';
        // untuk mendownload file pdf
        return $pdf->download($filename.'.pdf');
    }
}
