<?php

namespace App\Http\Controllers;

use App\Http\Requests\KomplainRequest;
use App\Models\Komplain;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\DB;

class KomplainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request->search)
        {
            $komplains = Komplain::where('unit', 'LIKE', "%$request->search%")
            ->paginate(3);

            return view('komplain.index', [
                'data' =>$komplains
            ]);
        }

        $komplains = Komplain::paginate(3);
        return view('komplain.index', [
            'data' =>$komplains
        ]);
        
    }

    public function create()
    {
        return view('komplain.create');
    }

    public function store(KomplainRequest $request)
    {
        $request->validate([
        'tgl_masuk' => ['required'],
        'unit' => ['required'],
        'jenis' => ['required'],
        'isi' => ['required'],
        'tgl_ditangani' => ['required'],
        'respon' => ['required'],
        'penyelesaian' => ['required'],
        'level' => ['required'],
        'tgl_selesai' => ['required'],
        'capaian' => ['required'],
        'petugas' => ['required']
        ]);
        Komplain::create([
        'tgl_masuk' => $request->tgl_masuk,
        'unit' => $request->unit,
        'jenis' => $request->jenis,
        'isi' => $request->isi,
        'tgl_ditangani' => $request->tgl_ditangani,
        'respon' => $request->respon,
        'penyelesaian' => $request->penyelesaian,
        'level' => $request->level,
        'tgl_selesai' => $request->tgl_selesai,
        'capaian' => $request->capaian,
        'petugas' => $request->petugas
    ]);
    
    return redirect('/komplains');
    
    }

    public function show($id)
    {
        $komplain = Komplain::find($id);
        return $komplain;
    }

    public function edit($id)
    {
        $komplain = Komplain::find($id);

        return view('komplain.edit', compact('komplain'));
    }
    
    public function update(KomplainRequest $request, $id)
    {

        $komplain = Komplain::find($id);
    
        $komplain->update([
            'tgl_masuk' => $request->tgl_masuk,
            'unit' => $request->unit,
            'jenis' => $request->jenis,
            'isi' => $request->isi,
            'tgl_ditangani' => $request->tgl_ditangani,
            'respon' => $request->respon,
            'penyelesaian' => $request->penyelesaian,
            'level' => $request->level,
            'tgl_selesai' => $request->tgl_selesai,
            'capaian' => $request->capaian,
            'petugas' => $request->petugas
        ]);
        return redirect('/komplains'); 
    }

    public function destroy($id)
    {
        $komplain = Komplain::find($id);

        $komplain->delete();
        
        return redirect('/komplains'); 

    }
}
