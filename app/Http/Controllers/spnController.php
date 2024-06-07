<?php

namespace App\Http\Controllers;

use App\Models\Dipa;
use App\Models\KebutuhanAnggaran;
// use App\Models\Notifikasi;
use App\Models\RealisasiAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class spnController extends Controller
{
    // public function dashboard()
    // {
    //     return view('spn/spn-dashboard');
    // }

    public function pengajuanDipa()
    {
        $dipa = Dipa::with('catrgoriesKegiatan')
                ->where('status', 'ajukan')
                ->where('respon', null)
                ->orWhere('respon', 'no')
                ->get();
        foreach ($dipa as $item) {
            if ($item->spn == 'ajukan') {
                Storage::delete($item->spn);
                $item->spn = null;
                $item->save();
            }
        }
        return view('spn/halaman-pengajuan-dipa', ['dipa'=>$dipa]);
    }

    public function tolakDipa($slug)
    {
        $dipa = Dipa::with('catrgoriesKegiatan')->where('slug', $slug)->first();
        return view('spn/dipa-revisi', ['dipa'=>$dipa]);
    }

    public function dipaRevisi(Request $request, $slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->respon = 'no';
        $dipa->catatan = $request->catatan;
        $dipa->revisi = null;
        $dipa->spn = 'no';
        $dipa->update();
        return redirect("/dipa-spn")->with('warning', 'Dipa Sukses diTolak');
    }

    public function setujuDipa($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->respon = 'disetujui';
        $dipa->status = 'disetujui';
        $dipa->revisi = null;
        $dipa->catatan = 'setuju';
        $dipa->spn = Auth::user()->nama;
        $dipa->update();
        return redirect("/dipa-spn")->with('status', 'Dipa Sukses diSetujui');
    }

    public function halamanAnggaran()
    {
        $anggaran = KebutuhanAnggaran::with('staf')
                    ->where('status', 'ajukan')
                    ->where('respon', null)
                    ->orWhere('respon', 'ditolak')
                    ->get();
        $notif = KebutuhanAnggaran::with('staf')->where('spn', 'notifikasi')->where('respon', null)->orWhere('respon', 'ditolak')
                    ->get();        
        foreach ($notif as $item) {
            if ($item->spn) {
                Storage::delete($item->spn);
                $item->spn = null;
                $item->save();
            }
        } 
        return view('spn/pengajuan-anggaran', ['anggaran'=>$anggaran]);
    }

    public function stafRevisi(Request $request, $slug)
    {
        $anggaran = KebutuhanAnggaran::where('slug', $slug)->first();
        $anggaran->respon = 'ditolak';
        $anggaran->catatan = $request->catatan;
        $anggaran->spn = $request->spn;
        $anggaran->notifikasi = 'tolak';
        $anggaran->update();
        return redirect("/anggaran-disetuju-spn")->with('warning', 'Anggaran diTolak');
    }

    public function tolakAnggaran($slug)
    {
        $data = KebutuhanAnggaran::where('slug', $slug)->first();
        return view('spn/staf-revisi', ['data' => $data]);
    }

    public function setujuKebutuhanAnggaran($slug)
    {
        $kebutuhanAnggaran = KebutuhanAnggaran::where('slug', $slug)->first();
        $kebutuhanAnggaran->status = 'disetujui';
        $kebutuhanAnggaran->respon = 'disetujui';
        $kebutuhanAnggaran->revisi = null;
        $kebutuhanAnggaran->catatan = "ada";
        $kebutuhanAnggaran->spn = Auth::user()->nama;
        $kebutuhanAnggaran->notifikasi = 'disetujui';
        $kebutuhanAnggaran->update();

        $realisasi = new RealisasiAnggaran;
        $realisasi->dipa_id = $kebutuhanAnggaran->dipa_id;
        $realisasi->staf_id = $kebutuhanAnggaran->staf_id;
        $realisasi->staf = $kebutuhanAnggaran->staf->nama;
        $realisasi->bidang = $kebutuhanAnggaran->staf->bidang;
        $realisasi->program_kegiatan = $kebutuhanAnggaran->program_kode;
        $realisasi->jenis_dipa = $kebutuhanAnggaran->jenis_dipa;
        $realisasi->dipa_kegiatan = $kebutuhanAnggaran->dipa_kode;
        $realisasi->kode_kegiatan = $kebutuhanAnggaran->kode;
        $realisasi->uraian_kegiatan = $kebutuhanAnggaran->uraiaan;
        $realisasi->volume = $kebutuhanAnggaran->volume;
        $realisasi->list = $kebutuhanAnggaran->list;
        $realisasi->harga_satuan = $kebutuhanAnggaran->harga_satuan;
        $realisasi->pagu = $kebutuhanAnggaran->pagu;
        $realisasi->spn = $kebutuhanAnggaran->spn;
        $realisasi->tanggal = $kebutuhanAnggaran->tanggal;
        $realisasi->bulan = $kebutuhanAnggaran->bulan;
        $realisasi->tahun = $kebutuhanAnggaran->tahun;


        $realisasi->realisasi = 0;
        $realisasi->total = 0;
        $realisasi->sisa_anggaran = $kebutuhanAnggaran->pagu - $realisasi->realisasi;
        $realisasi->save();
        return redirect("/meyetujui-anggaran")->with('status', 'Anggaran Sukses diSetujui');
    }

    public function AnggaranDisetujui()
    {
        $anggaran = KebutuhanAnggaran::where('respon', 'disetujui')
                    ->where('status', 'disetujui')->get();
        return view('spn/anggaran-disetujui', ['anggaran'=>$anggaran]);
    }
}
