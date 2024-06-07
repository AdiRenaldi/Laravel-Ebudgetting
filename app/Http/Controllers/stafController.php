<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use App\Models\KebutuhanAnggaran;
use App\Models\RealisasiAnggaran;
use App\Models\staf_anggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class stafController extends Controller
{
    public function addKebutuhanAnggaran()
    {
        $dipaKegiatan = Dipa::with('catrgoriesKegiatan')
                    ->where('status', 'disetujui')
                    ->where('respon', 'disetujui')
                    ->latest()
                    ->first();

        $stafAnggaran = staf_anggaran::where('dipa_id', $dipaKegiatan->id)->where('staf_id', Auth::user()->id)->first();
        if($stafAnggaran){
            return view('staf/add-kebutuhan-anggaran', ['dipaKegiatan'=>$dipaKegiatan]);
        } else {
            return redirect('/staf-kebutuhan-anggaran')->with('status', 'Anggaran Belum DiInput');
        }
    }

    public function prosesAddKebutuhanAnggaran(Request $request)
    {
        $validated = $request->validate(
            [
                'dipa_kode' => 'required|max:255',
                'kode' => 'required|unique:kebutuhan_anggaran|max:255',
                'uraiaan' => 'required|max:255',
                'volume' => 'required|max:255',
                'harga_satuan' => 'required|max:255',
                'list' => 'required',
            ],
                [
                    'dipa_kode.required' => 'dipa_kode wajib diisi',
                    'dipa_kode.max' => 'maksimal 255 carakter',

                    'kode.required' => 'kode wajib diisi',
                    'kode.unique' => 'kode sudah ada',
                    'kode.max' => 'maksimal 255 carakter',

                    'uraiaan.required' => 'uraiaan wajib diisi',
                    'uraiaan.max' => 'maksimal 255 carakter',

                    'volume.required' => 'volume wajib diisi',
                    'volume.max' => 'maksimal 255 carakter',

                    'harga_satuan.required' => 'harga_satuan wajib diisi',
                    'harga_satuan.max' => 'maksimal 255 carakter',

                    'list.required' => 'list wajib diisi',
                ]
        );

        $anggaran = KebutuhanAnggaran::create($request->all());
        return redirect('/anggaran-diajukan')->with('status', 'Data Sukses Ditambahkan');
    }

    public function editKebutuhanAnggaran($slug)
    {
        $anggaran = KebutuhanAnggaran::where('staf_id', Auth::user()->id)
                    ->where('slug', $slug)
                    ->first();
        $dipaKegiatan = Dipa::with('catrgoriesKegiatan', 'categoriesProgram')
                        ->where('id', $anggaran->dipa_id)
                        ->first();
        return view('staf/edit-kebutuhan-anggaran', ['anggaran'=>$anggaran, 'dipaKegiatan'=>$dipaKegiatan]);
    }

    public function updateKebutuhanAnggaran(Request $request, $slug)
    {
        $validated =
            [
                'uraiaan' => 'required|max:255',
                'volume' => 'required|max:255',
                'harga_satuan' => 'required|numeric',
                'list' => 'required',
                'pagu' => 'required',
            ]; 
        $anggaran = KebutuhanAnggaran::where('staf_id', Auth::user()->id)
                    ->where('slug', $slug)
                    ->first();
        if ($request['kode'] != $anggaran->kode) {
            $validated['kode'] ='required|unique:kebutuhan_anggaran|max:255';
        }
        $request->validate($validated);
        $anggaran->slug = null;
        $anggaran->update($request->all());

        if($anggaran->respon == 'ditolak'){
            $anggaran->revisi = 'revisi';
            $anggaran->spn = 'notifikasi';
            $anggaran->update();
            return redirect('/anggaran-diajukan')->with('status', 'Dipa Sukses DiAjukan');
        }

        return redirect('/anggaran-diajukan')->with('status', 'Data Sukses DiEdit');
    }

    public function deletedKebutuhanAnggaran($slug)
    {
        $anggaran = KebutuhanAnggaran::where('staf_id', Auth::user()->id)
                    ->where('slug', $slug)
                    ->first();
        $anggaran->delete();            
        return redirect('/anggaran-diajukan')->with('status', 'Data Sukses DiHapus');
    }

    public function ajukanKebutuhanAnggaran($slug)
    {
        $anggaran = KebutuhanAnggaran::where('staf_id', Auth::user()->id)
                    ->where('slug', $slug)
                    ->first();
        $anggaran->status = 'ajukan';
        $anggaran->spn = 'notifikasi';
        $anggaran->update();
        return redirect('/anggaran-diajukan')->with('status', 'Data Sukses DiAjukan');
    }

    public function anggaranDiajukan()
    {
        $anggaran = KebutuhanAnggaran::where('staf_id', Auth::user()->id)
                    ->where('status', '!=' ,'disetujui')
                    // ->orWhere('status', 'tidak_ajukan')
                    // ->orWhere('respon', 'ditolak')
                    ->get();
        foreach ($anggaran as $item) {
            if ($item->notifikasi) {
                Storage::delete($item->notifikasi);
                $item->notifikasi = null;
                $item->save();
            }
        }  
        return view('staf/kebutuhanAnggaran-diajukan', ['anggaran'=>$anggaran]);
    }





    
    public function AnggaranDisetujui()
    {
        $notifAnggaran = KebutuhanAnggaran::where('spn', 'notifikasi')->get();
        if(Auth::user()->role_id == 4){
            $anggaran = KebutuhanAnggaran::where('respon', 'disetujui')
                ->where('status', 'disetujui')->orderBy('created_at', 'desc')->get();
        }else{
            $anggaran = KebutuhanAnggaran::where('respon', 'disetujui')
                        ->where('staf_id', Auth::user()->id)
                        ->where('status', 'disetujui')->orderBy('created_at', 'desc')->get();
            foreach ($anggaran as $item) {
                if ($item->notifikasi) {
                    Storage::delete($item->notifikasi);
                    $item->notifikasi = null;
                    $item->save();
                }
            }            
        }
        return view('staf/anggaran-disetujui', ['anggaran'=>$anggaran, 'notifAnggaran'=>$notifAnggaran]);
    }





    public function anggaranDirealisasikan()
    {
        $stafAnggaran = staf_anggaran::where('staf_id',  Auth::user()->id)->where('notifikasi', 'ada')->get();
        $revisiDana = staf_anggaran::where('staf_id',  Auth::user()->id)->where('notifikasi', 'Dana baru')->get();
        foreach ($stafAnggaran as $item) {
            if ($item->notifikasi == "ada") {
                Storage::delete($item->notifikasi);
                $item->notifikasi = null;
                $item->save();
            }
        }    
        foreach ($revisiDana as $item) {
            if ($item->notifikasi == "Dana baru") {
                Storage::delete($item->notifikasi);
                $item->notifikasi = null;
                $item->save();
            }
        }
        // dd(Auth::user()->nama);
        $laporan = RealisasiAnggaran::where('staf', Auth::user()->nama)
                    ->where('realisasi', '!=', 0)->orderBy('created_at', 'desc')->get();
        foreach ($laporan as $item) {
            if ($item->notifikasi) {
                Storage::delete($item->notifikasi);
                $item->notifikasi = null;
                $item->save();
            }
        }
        $ajukan = KebutuhanAnggaran::where('staf_id', Auth::user()->id)->where('notifikasi', 'tolak')->get();
        $setuju = KebutuhanAnggaran::where('staf_id', Auth::user()->id)->where('notifikasi', 'disetujui')->get();
        $realisasi = RealisasiAnggaran::where('staf_id', Auth::user()->id)->where('notifikasi', 'realisasi')->get();
        return view('staf/halaman-realisasi', [
            'laporan' => $laporan,
            'ajukan'=>$ajukan, 
            'setuju'=>$setuju,
            'realisasi'=>$realisasi
        ]);
    }
}
