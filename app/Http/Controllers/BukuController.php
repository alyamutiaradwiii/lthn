<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Buku;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use App\Exports\DataBukuExportView;
use App\Imports\ImportDataBukuClass;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export_excel()
    {
        $buku = Buku::select('*');
        
        $buku = $buku->get();

        //untuk mengexport class
        $export = new DataBukuExportView($buku);

        // SET FILE NAME
        $filename = date('YmdHis') . '_buku';

        // untuk mendownload file excel
        return Excel::download($export, $filename . '.xlsx');
    }

    public function import_excel(Request $request)
    {
        //DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataBukuClass;
                Excel::import($import, $file);
                
                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return back()
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }
            
		}
		catch(Exception $e){
			// ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }
}
