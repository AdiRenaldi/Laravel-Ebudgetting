<?php

namespace App\Http\Controllers;

use App\Exports\LaporanKeuanganExport;
use App\Models\Dipa;
use App\Models\DipaAnggaran;
use App\Models\DipaKegiatan;
use App\Models\KebutuhanAnggaran;
use App\Models\RealisasiAnggaran;
use App\Models\LaporanKeuangan;
use App\Models\ProgramKegiatan;
use App\Models\RevisiDipa;
use App\Models\RevisiStaf;
use App\Models\Staf;
use App\Models\staf_anggaran;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class renmiController extends Controller
{
    public function dashboard(Request $request)
    {
        $stafAnggaran = staf_anggaran::where('staf_id',  Auth::user()->id)->where('notifikasi', 'ada')->get();
        $revisiDana = staf_anggaran::where('staf_id',  Auth::user()->id)->where('notifikasi', 'Dana baru')->get();
        $dipa = Dipa::all();
        if($request->anggaran){
            $dataKeuangan = LaporanKeuangan::where('dipa_id', $request->anggaran)->orderBy('created_at', 'desc')->get();
            $total = $dataKeuangan->sum("realisasi");
            $data = DB::table('laporan_keuangan')->where('dipa_id', $request->anggaran)
                    ->select('bulan', DB::raw('SUM(realisasi) as total'))
                    ->groupBy('bulan')
                    ->orderByRaw('FIELD(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember")')
                    ->get();
            $staf = DB::table('laporan_keuangan')->where('dipa_id', $request->anggaran)
                    ->select('staf', DB::raw('SUM(realisasi) as total'))
                    ->groupBy('staf')
                    ->get();
        }else{
            $dataKeuangan = LaporanKeuangan::orderBy('created_at', 'desc')->get();
            $total = $dataKeuangan->sum("realisasi");
            $data = DB::table('laporan_keuangan')
                    ->select('bulan', DB::raw('SUM(realisasi) as total'))
                    ->groupBy('bulan')
                    ->orderByRaw('FIELD(bulan, "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember")')
                    ->get();
            $staf = DB::table('laporan_keuangan')
                    ->select('staf', DB::raw('SUM(realisasi) as total'))
                    ->groupBy('staf')
                    ->get();
        }
        return view('renmi/renmi-dashboard', 
        ['dataKeuangan'=>$dataKeuangan, 
         'data'=>$data, 
         'total'=>$total, 
         'staf'=>$staf, 
         'dipa'=>$dipa,
         'stafAnggaran'=>$stafAnggaran,
         'revisiDana'=>$revisiDana
        ]);
    }

    public function Dipa()
    {
        $notif = Dipa::where('spn', 'ajukan')->get();
        $dipaNotif = Dipa::where('spn', 'no')->get();


        $dipa = Dipa::with('catrgoriesKegiatan', 'categoriesProgram')->where('respon', 'disetujui')->where('status', 'disetujui')
                ->orderBy('created_at', 'desc')
                ->get();
        $dipaBaru = Dipa::where('status', 'disetujui')->where('respon', 'disetujui')->latest()->first();        
        foreach ($dipa as $item) {
            if ($item->catatan == 'setuju' && Auth::user()->role_id == 2) {
                Storage::delete($item->catatan);
                $item->catatan = null;
                $item->save();
            }
        } 
        return view('renmi/dipa-disetujui', ['dipa'=>$dipa, 'dipaBaru'=>$dipaBaru, 'dipaNotif'=>$dipaNotif, 'notif'=>$notif]);
    }

    public function dipaAdd()
    {
        $kegiatan = DipaKegiatan::all();
        $program = ProgramKegiatan::all();
        return view('renmi/dipa-add', ['kegiatan'=>$kegiatan, 'program'=>$program]);
    }

    public function dipaAddproses(Request $request)
    {
        $validated = $request->validate(
            [
                'jenis_dipa' => 'required|max:255',
                'anggaran' => 'required|max:255',
                'kegiatan' => 'required|max:255',
                'programKegiatan' => 'required|max:255',
            ],
                [
                    'jenis_dipa.required' => 'jenis_dipa wajib diisi',
                    'jenis_dipa.max' => 'maksimal 255 carakter',

                    'anggaran.required' => 'anggaran wajib diisi',
                    'anggaran.max' => 'maksimal 255 carakter',

                    'kegiatan.required' => 'kegiatan wajib diisi',
                    'kegiatan.max' => 'maksimal 255 carakter',

                    'programKegiatan.required' => 'program kegiatan wajib diisi',
                    'programKegiatan.max' => 'maksimal 255 carakter',
                ]
        ); 

        $dipa = Dipa::create($request->all());
        $dipa->catrgoriesKegiatan()->sync($request->kegiatan);
        $dipa->categoriesProgram()->sync($request->programKegiatan);

        $queryDipa = Dipa::latest()->first();
        $queryDipa->anggaran_baru = $request->anggaran;
        $queryDipa->sisa_anggaran = $request->anggaran;
        $queryDipa->update();

        $anggaran = new DipaAnggaran;
        $anggaran->dipa_id = $queryDipa->id;
        $anggaran->jenis_dipa = $queryDipa->jenis_dipa;
        $anggaran->anggaran = $queryDipa->anggaran;
        $anggaran->sisa_anggaran = $queryDipa->sisa_anggaran;
        $anggaran->tanggal = $queryDipa->tanggal;
        $anggaran->bulan = $queryDipa->bulan;
        $anggaran->tahun = $queryDipa->tahun;
        $anggaran->save();
        return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses Ditambahkan');
    }

    public function dipaEdit($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        $kegiatan = DipaKegiatan::all();
        $program = ProgramKegiatan::all();
        return view('renmi/dipa-edit', ['dipa'=>$dipa, 'kegiatan'=>$kegiatan, 'program'=>$program]);
    }

    public function dipaUpdate(Request $request, $slug)
    {
        $validated = $request->validate(
            [
                'jenis_dipa' => 'required|max:255',
                'anggaran' => 'required|max:255',
            ],
                [
                    'jenis_dipa.required' => 'jenis_dipa wajib diisi',
                    'jenis_dipa.max' => 'maksimal 255 carakter',

                    'anggaran.required' => 'anggaran wajib diisi',
                    'anggaran.max' => 'maksimal 255 carakter',
                ]
        ); 

        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->slug = null;
        $dipa->update($request->all());
        $dipa->anggaran_baru = $request->anggaran;
        $dipa->sisa_anggaran = $request->anggaran;
        $dipa->update();

        if($request->kegiatan || $request->program_kegiatan){
            $dipa->catrgoriesKegiatan()->sync($request->kegiatan);
            $dipa->categoriesProgram()->sync($request->program_kegiatan);
        }

        if($request->jenis_dipa && $request->anggaran){
            $anggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
            $anggaran->jenis_dipa = $request->jenis_dipa;
            $anggaran->anggaran = $request->anggaran;
            $anggaran->sisa_anggaran = $request->anggaran;
            $anggaran->slug = null;
            $anggaran->update();
        }
        if($dipa->respon == 'no'){
            $dipa->revisi = 'revisi';
            $dipa->spn = 'ajukan';
            $dipa->update();
            return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses DiAjukan');
        }
        return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses DiEdit');
    }

    public function dipaDelete($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        $anggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
        $anggaran->forceDelete();
        $dipa->catrgoriesKegiatan()->detach();
        $dipa->categoriesProgram()->detach();
        $dipa->forceDelete();

        if($dipa->status = 'ajukan'){
            return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses DiHapus');
        }
        return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses DiHapus');
    }

    // dipa penambahan atau pengurangan dana (Revisi)
    public function tambahDanaDipa($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        return view('renmi/dipa-revisi-dana', ['dipa'=>$dipa]);
    }
    public function kurangDanaDipa($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        return view('renmi/dipa-revisi-dana', ['dipa'=>$dipa]);
    }


    public function prosesTambahDipa(Request $request, $slug)
    {
        $validated = $request->validate(
            [
                'revisi' => 'required|max:255',
                'tanggal' => 'required|max:255',
                'bulan' => 'required|max:255',
                'tahun' => 'required|max:255',
            ],
                [
                    'revisi.required' => 'revisi wajib diisi',
                    'revisi.max' => 'maksimal 255 carakter',
                    'tanggal.required' => 'tanggal wajib diisi',
                    'tanggal.max' => 'maksimal 255 carakter',
                    'bulan.required' => 'bulan wajib diisi',
                    'bulan.max' => 'maksimal 255 carakter',
                    'tahun.required' => 'tahun wajib diisi',
                    'tahun.max' => 'maksimal 255 carakter',
                ]
        ); 

        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->penambahan_dana = $request->revisi;
        $dipa->sisa_anggaran += $request->revisi;
        $dipa->anggaran_baru += $request->revisi;

        $dipa->update();

        $anggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
            

        $dipaRevisi = new RevisiDipa;
        $dipaRevisi->dipa_id = $dipa->id;
        $dipaRevisi->penambahan_dana = $request->revisi;
        $dipaRevisi->tanggal = $request->tanggal;
        $dipaRevisi->bulan = $request->bulan;
        $dipaRevisi->tahun = $request->tahun;
        $dipaRevisi->save();

        $totalDana = RevisiDipa::where('dipa_id', $dipa->id)->latest()->first();
        $totalDana->dana_awal = $anggaran->anggaran;
        $totalDana->dana_sekarang = $anggaran->anggaran + $request->revisi;
        $totalDana->update();
        
        $data = RevisiDipa::where('dipa_id', $dipa->id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        if($data){
            $totalDana->dana_awal = $data->dana_sekarang;
            $totalDana->dana_sekarang = $totalDana->dana_awal + $request->revisi;
            $totalDana->update();
        }

        $anggaran->penambahan_dana = $dipa->penambahan_dana;
        $anggaran->sisa_anggaran = $dipa->sisa_anggaran;
        $anggaran->update();

        return redirect('/dipa')->with('status', 'Dipa Sukses DiRevisi');
    }

    public function prosesKurangDipa(Request $request, $slug)
    {
        $validated = $request->validate(
            [
                'revisi' => 'required|max:255',
                'tanggal' => 'required|max:255',
                'bulan' => 'required|max:255',
                'tahun' => 'required|max:255',
            ],
                [
                    'revisi.required' => 'revisi wajib diisi',
                    'revisi.max' => 'maksimal 255 carakter',
                    'tanggal.required' => 'tanggal wajib diisi',
                    'tanggal.max' => 'maksimal 255 carakter',
                    'bulan.required' => 'bulan wajib diisi',
                    'bulan.max' => 'maksimal 255 carakter',
                    'tahun.required' => 'tahun wajib diisi',
                    'tahun.max' => 'maksimal 255 carakter',
                ]
        ); 

        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->pengurangan_dana = $request->revisi;
        $dipa->sisa_anggaran -= $request->revisi;
        $dipa->anggaran_baru -= $request->revisi;
        $dipa->update();

        $anggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
            
            $dipaRevisi = new RevisiDipa;
            $dipaRevisi->dipa_id = $dipa->id;
            $dipaRevisi->pengurangan_dana = $request->revisi;
            $dipaRevisi->tanggal = $request->tanggal;
            $dipaRevisi->bulan = $request->bulan;
            $dipaRevisi->tahun = $request->tahun;
            $dipaRevisi->save();

        $totalDana = RevisiDipa::where('dipa_id', $dipa->id)->latest()->first();
        $totalDana->dana_awal = $anggaran->anggaran;
        $totalDana->dana_sekarang = $anggaran->anggaran - $request->revisi;
        $totalDana->update();
        
        $data = RevisiDipa::where('dipa_id', $dipa->id)->orderBy('id', 'desc')->skip(1)->take(1)->first();
        if($data){
            $totalDana->dana_awal = $data->dana_sekarang;
            $totalDana->dana_sekarang = $totalDana->dana_awal - $request->revisi;
            $totalDana->update();
        }

        $anggaran->pengurangan_dana = $dipa->pengurangan_dana;
        $anggaran->sisa_anggaran = $dipa->sisa_anggaran;
        $anggaran->update();

        return redirect('/dipa')->with('status', 'Dipa Sukses DiRevisi');
    }

    public function anggaran()
    {
        $anggaran = DipaAnggaran::orderBy('created_at', 'desc')->get();
        return view('renmi/halaman-anggaran', ['anggaran'=>$anggaran]);
    }

    public function kegiatan()
    {
        $kegiatan = DipaKegiatan::orderBy('created_at', 'desc')->get();
        return view('renmi/halaman-kegiatan', ['kegiatan'=>$kegiatan]);
    }

    public function kegiatanAdd()
    {
        return view('renmi/tambah-kegiatan');
    }

    public function prosesAddkegiatan(Request $request)
    {
        $validated = $request->validate(
            [
                'kode' => 'required|unique:dipa_kegiatan|max:255',
                'kegiatan' => 'required|max:255',
            ],
                [
                    'kode.required' => 'kode wajib diisi',
                    'kode.unique' => 'kode sudah ada',
                    'kode.max' => 'maksimal 255 carakter',

                    'kegiatan.required' => 'kegiatan wajib diisi',
                    'kegiatan.max' => 'maksimal 255 carakter',
                ]
        );   
        $kegiatan = DipaKegiatan::create($request->all());
        return redirect('/kegiatan')->with('status', 'Kegiatan Sukses Ditambahkan');
    }

    public function kegiatanEdit($slug)
    {
        $kegiatan = DipaKegiatan::where('slug', $slug)->first();
        return view('renmi/edit-kegiatan', ['kegiatan'=>$kegiatan]);
    }

    public function kegiatanUpdate(Request $request, $slug)
    {
        $validated= [];
        $kegiatan = DipaKegiatan::where('slug',$slug)->first();
        if ($request['kode'] != $kegiatan->kode) {
            $validated['kode'] ='required|unique:dipa_kegiatan|max:255';
        }
        if ($request['kegiatan'] != $kegiatan->kegiatan) {
            $validated['kegiatan'] ='required|max:255';
        }
        $request->validate($validated);
        
        $kegiatan->slug = null;
        $kegiatan->update($request->all());
        return redirect('/kegiatan')->with('status', 'Kegiatan Sukses DiEdit');
    }

    public function kegiatanDeleted($slug)
    {
        $kegiatan = DipaKegiatan::where('slug',$slug)->first()->delete();
        return redirect('/kegiatan')->with('status', 'Kegiatan Sukses DiHapus');

    }

    public function programKegiatan()
    {
        $program = ProgramKegiatan::orderBy('created_at', 'desc')->get();
        return view('renmi/halaman-program-kegiatan', ['program'=>$program]);
    }

    public function programAdd()
    {
        return view('renmi/tambah-program');
    }

    public function prosesAddProgram(Request $request)
    {
        $validated = $request->validate(
            [
                'kode' => 'required|unique:program_kegiatan|max:255',
                'program_kegiatan' => 'required|max:255',
            ],
                [
                    'kode.required' => 'kode wajib diisi',
                    'kode.unique' => 'kode sudah ada',
                    'kode.max' => 'maksimal 255 carakter',

                    'program_kegiatan.required' => 'program wajib diisi',
                    'program_kegiatan.max' => 'maksimal 255 carakter',
                ]
        );   
        $program = ProgramKegiatan::create($request->all());
        return redirect('/program-kegiatan')->with('status', 'Program Kegiatan Sukses Ditambahkan');
    }

    public function programEdit($slug)
    {
        $program = ProgramKegiatan::where('slug', $slug)->first();
        return view('renmi/edit-program', ['program'=>$program]);
    }

    public function programUpdate(Request $request, $slug)
    {
        $validated= [];
        $program = ProgramKegiatan::where('slug',$slug)->first();
        if ($request['kode'] != $program->kode) {
            $validated['kode'] ='required|unique:dipa_program|max:255';
        }
        if ($request['program_kegiatan'] != $program->program) {
            $validated['program_kegiatan'] ='required|max:255';
        }
        $request->validate($validated);
        
        $program->slug = null;
        $program->update($request->all());
        return redirect('/program-kegiatan')->with('status', 'Program Kegiatan Sukses DiEdit');
    }

    public function programDelete($slug)
    {
        $program = ProgramKegiatan::where('slug',$slug)->first()->delete();
        return redirect('/program-kegiatan')->with('status', 'Program Kegiatan Sukses DiHapus');
    }

    public function dipaAjukan($slug)
    {
        $dipa = Dipa::where('slug', $slug)->first();
        $dipa->status = 'ajukan';
        $dipa->spn = 'ajukan';
        $dipa->update();
        return redirect('/dipa-diajukan')->with('status', 'Dipa Sukses DiAjukan');
    }

    public function dipaDiAjukan()
    {
        $dipa = Dipa::where('status', 'ajukan')
                    ->orWhere('status', 'tidak_ajukan')
                    ->orWhere('respon', 'no')
                    ->orderBy('created_at', 'desc')
                    ->get();
        foreach ($dipa as $item) {
            if ($item->spn == 'no') {
                Storage::delete($item->spn);
                $item->spn = null;
                $item->save();
            }
        }
        return view('renmi/dipa-diajukan', ['dipa'=>$dipa]);
    }

    public function danaStaf()
    {
        $dipa = Dipa::where('status', 'disetujui')->latest()->first();
        $danaStaf = staf_anggaran::orderBy('created_at', 'desc')->get();
        return view('renmi/halaman-dana-staf', ['danaStaf'=>$danaStaf, 'dipa'=>$dipa]);
    }

    public function penyaluranDana()
    {
        $dipa = Dipa::where('status', 'disetujui')
                ->where('respon', 'disetujui')
                ->latest()->first();
        $staf = Staf::all();
        if(!empty($dipa)){
            $danaStaf = staf_anggaran::where('dipa_id', $dipa->id)->get();
            $dataDana = count($danaStaf);
            $dataStaf = count($staf);
            if($dataDana == $dataStaf){
                return redirect('/dana-staf')->with('warning', 'Data Staf Sudah Terisi Semua..!!!');
            }else{
                return view('renmi/staf-dana-add', ['staf'=>$staf, 'dipa'=>$dipa]);
            }
        }else{
            return redirect('/dana-staf')->with('warning', 'Dipa Belum Ada..!!!');
        }
    }

    public function stafDanaAdd(Request $request)
    {
        $validated = $request->validate(
            [
                'total_anggaran' => 'required|max:255',
                'tanggal'=> 'required',
                'bulan'=> 'required',
                'tahun'=> 'required',
            ],
                [
                    'total_anggaran.required' => 'total_anggaran wajib diisi',
                    'total_anggaran.max' => 'maksimal 255 carakter',
                    'tanggal.required' =>'tanggal wajib diisi',
                    'bulan.required' =>'bulan wajib diisi',
                    'tahun.required' =>'tahun wajib diisi',
                ]
        );

        $stafAnggaran = staf_anggaran::where('jenis_dipa', $request->jenis_dipa)->where('staf_id', $request->staf)->first();
        if(empty($stafAnggaran)){
            $dipa = Dipa::where('status', 'disetujui')
                    ->where('respon', 'disetujui')
                    ->latest()->first();
            $staf = new staf_anggaran;
            $staf->dipa_id = $request->dipa_id;
            $staf->jenis_dipa = $request->jenis_dipa;
            $staf->staf_id = $request->staf;
            $staf->total_anggaran = $request->total_anggaran;
            $staf->total_pemakaian = 0;
            $staf->sisa_anggaran = $request->total_anggaran;
            $staf->notifikasi = "ada";
            $staf->tanggal = $request->tanggal;
            $staf->bulan = $request->bulan;
            $staf->tahun = $request->tahun;
            $staf->save();
    
            $dipa->total_digunakan = $dipa->total_digunakan + $request->total_anggaran;
            $dipa->sisa_anggaran = $dipa->anggaran - $dipa->total_digunakan;
            $dipa->update(); 
            $stafAnggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
            $stafAnggaran->total_digunakan = $dipa->total_digunakan;
            $stafAnggaran->sisa_anggaran = $dipa->sisa_anggaran;
            $stafAnggaran->update();
           
            return redirect('/dana-staf')->with('status', 'Dana Berhasil Dibagikan');
        }else{
            return redirect('/dana-staf')->with('warning', 'Data Sudah Ada..!!');
        }
    }

    public function editDanaStaf($id)
    {
        $staf = staf_anggaran::where('id', $id)->first();
        return view('renmi/edit-staf-dana', ['staf'=>$staf]);
    }

    public function updateStafDana(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'total_anggaran' => 'required|max:255',
            ],
                [
                    'total_anggaran.required' => 'total_anggaran wajib diisi',
                    'total_anggaran.max' => 'maksimal 255 carakter',
                ]
        );
        $stafAnggaran = staf_anggaran::where('id', $id)->first();
        $dipa = Dipa::where('id', $stafAnggaran->dipa_id)->first();
        if($request->total_anggaran){
            $dipa->total_digunakan = $dipa->total_digunakan - $stafAnggaran->total_anggaran;
            $dipa->update();
            $stafAnggaran->total_anggaran = $request->total_anggaran;
            $stafAnggaran->update();
            $dipa->total_digunakan = $dipa->total_digunakan + $stafAnggaran->total_anggaran;
            $dipa->update();
            $dipa->sisa_anggaran = $dipa->anggaran - $dipa->total_digunakan;
            $dipa->update();

            $stafAnggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
            $stafAnggaran->total_digunakan = $dipa->total_digunakan;
            $stafAnggaran->sisa_anggaran = $dipa->sisa_anggaran;
            $stafAnggaran->update();
        }
        return redirect('/dana-staf')->with('status', 'Dana Berhasil diEdit');
    }

    public function deleteDanaStaf($id)
    {
        $stafAnggaran = staf_anggaran::where('id', $id)->first();
        $dipa = Dipa::where('id', $stafAnggaran->dipa_id)->first();
        $dipa->total_digunakan = $dipa->total_digunakan - $stafAnggaran->total_anggaran;
        $dipa->update();
        $dipa->sisa_anggaran = $dipa->anggaran - $dipa->total_digunakan;
        $dipa->update();

        $dipaAnggaran = DipaAnggaran::where('dipa_id', $dipa->id)->first();
        $dipaAnggaran->total_digunakan = $dipa->total_digunakan;
        $dipaAnggaran->sisa_anggaran = $dipa->sisa_anggaran;
        $dipaAnggaran->update();

        $stafAnggaran->delete();
        return redirect('/dana-staf')->with('status', 'Dana Berhasil diHapus');
    }

    // penambahan dan pengurangan dana staf
    public function tambahDanaStaf($id)
    {
        $anggaran = staf_anggaran::with('staf')->where('id', $id)->first();
        $dipa = Dipa::where('id', $anggaran->dipa_id)->first();
        return view('renmi/staf-revisi-dana', ['anggaran'=>$anggaran, 'dipa'=>$dipa]);
    }
    public function kurangDanaStaf($id)
    {
        $anggaran = staf_anggaran::with('staf')->where('id', $id)->first();
        $dipa = Dipa::where('id', $anggaran->dipa_id)->first();
        return view('renmi/staf-revisi-dana', ['anggaran'=>$anggaran, 'dipa'=>$dipa]);
    }

    public function prosesTambahStaf(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'staf_revisi' => 'required|max:255',
            ],
                [
                    'staf_revisi.required' => 'Dana wajib diisi',
                    'staf_revisi.max' => 'maksimal 255 carakter',
                ]
        ); 
        
        $dipaRenmin = Dipa::where('status', 'disetujui')
                    ->where('respon', 'disetujui')
                    ->latest()->first();
        $dipa = staf_anggaran::where('dipa_id', $dipaRenmin->id)->where('id', $id)->first();

        $dipa->penambahan_dana = $request->staf_revisi;
        $dipa->sisa_anggaran += $request->staf_revisi;
        $dipa->notifikasi = 'Dana baru';
        $dipa->update();

        $dipaRenmin->total_digunakan += $request->staf_revisi;
        $dipaRenmin->sisa_anggaran -= $request->staf_revisi;
        $dipaRenmin->update();

        $stafRevisi = new RevisiStaf();
        $stafRevisi->dipa_id = $dipaRenmin->id;
        $stafRevisi->staf_id = $dipa->staf_id;
        $stafRevisi->penambahan_dana = $request->staf_revisi;
        $stafRevisi->tanggal = $request->tanggal;
        $stafRevisi->bulan = $request->bulan;
        $stafRevisi->tahun = $request->tahun;
        $stafRevisi->save();

        $totalDana = RevisiStaf::where('staf_id', $dipa->staf_id)->latest()->first();
        $totalDana->dana_awal = $dipa->total_anggaran;
        $totalDana->dana_sekarang = $dipa->total_anggaran + $request->staf_revisi;
        $totalDana->update();

        $data = RevisiStaf::where('staf_id', $dipa->staf_id)->orderBy('id', 'desc')
                ->skip(1)   
                ->take(1)->first();
        if($data){
            $totalDana->dana_awal = $data->dana_sekarang;
            $totalDana->dana_sekarang = $totalDana->dana_awal + $request->staf_revisi;
            $totalDana->update();
        }


        return redirect('/anggaranStaf')->with('status', 'Dana Sukses Ditambahkan');
    }

    public function prosesKurangStaf(Request $request, $id)
    {
        $validated = $request->validate(
            [
                'staf_revisi' => 'required|max:255',
            ],
                [
                    'staf_revisi.required' => 'Dana wajib diisi',
                    'staf_revisi.max' => 'maksimal 255 carakter',
                ]
        ); 

        $dipaRenmin = Dipa::where('status', 'disetujui')
                    ->where('respon', 'disetujui')
                    ->latest()->first();
        $dipa = staf_anggaran::where('dipa_id', $dipaRenmin->id)->where('id', $id)->first();
        $dipa->pengurangan_dana = $request->staf_revisi;
        $dipa->sisa_anggaran -= $request->staf_revisi;
        $dipa->notifikasi = 'Dana baru';
        $dipa->update();
        $dipaRenmin->total_digunakan -= $request->staf_revisi;
        $dipaRenmin->sisa_anggaran += $request->staf_revisi;
        $dipaRenmin->update();

        $stafRevisi = new RevisiStaf();
        $stafRevisi->dipa_id = $dipaRenmin->id;
        $stafRevisi->staf_id = $dipa->staf_id;
        $stafRevisi->pengurangan_dana = $request->staf_revisi;
        $stafRevisi->tanggal = $request->tanggal;
        $stafRevisi->bulan = $request->bulan;
        $stafRevisi->tahun = $request->tahun;
        $stafRevisi->save();

        $totalDana = RevisiStaf::where('staf_id', $dipa->staf_id)->latest()->first();
        $totalDana->dana_awal = $dipa->total_anggaran;
        $totalDana->dana_sekarang = $dipa->total_anggaran - $request->staf_revisi;
        $totalDana->update();

        $data = RevisiStaf::where('staf_id', $dipa->staf_id)->orderBy('id', 'desc')
                ->skip(1)   
                ->take(1)->first();
        if($data){
            $totalDana->dana_awal = $data->dana_sekarang;
            $totalDana->dana_sekarang = $totalDana->dana_awal - $request->staf_revisi;
            $totalDana->update();
        }

        return redirect('/anggaranStaf')->with('status', 'Dana Sukses Dikurangkan');
    }













    public function halamanRealisasi(Request $request)
    {
        $staf = Staf::all();
        $kebutuhanAnggaran = KebutuhanAnggaran::where('catatan', 'ada')->get();
        foreach ($kebutuhanAnggaran as $item) {
            if ($item->catatan) {
                Storage::delete($item->catatan);
                $item->catatan = null;
                $item->save();
            }
        }

        if($request->unit && $request->bulan && $request->tahun){
            $realisasi = RealisasiAnggaran::where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }elseif($request->unit && $request->bulan){
            $realisasi = RealisasiAnggaran::where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }elseif($request->unit && $request->tahun){
            $realisasi = RealisasiAnggaran::where('staf', $request->unit)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }elseif($request->bulan && $request->tahun){
            $realisasi = RealisasiAnggaran::where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get();        
        }elseif($request->bulan){
            $realisasi = RealisasiAnggaran::where('bulan', $request->bulan)->orderBy('created_at', 'desc')->get();          
        }elseif($request->unit){
            $realisasi = RealisasiAnggaran::where('staf', $request->unit)->orderBy('created_at', 'desc')->get();
        }elseif($request->tahun){
            $realisasi = RealisasiAnggaran::where('tahun', $request->tahun)->orderBy('created_at', 'desc')->get();
        }else{
            $realisasi = RealisasiAnggaran::orderBy('created_at', 'desc')->get();
        }

        return view('renmi/halaman-realisasi', ['realisasi'=>$realisasi,'staf'=>$staf]);
    }

    

















    public function realisasiAnggaran($slug)
    {
        $laporanAnggaran = RealisasiAnggaran::where('slug', $slug)->first();
        return view('renmi/realisasi-anggaran', ['laporanAnggaran' => $laporanAnggaran]);
    }

    public function updateAnggaran(Request $request, $slug)
    {





        $laporan = RealisasiAnggaran::where('slug', $slug)->first();
        $laporan->realisasi = $request->realisasi;
        $laporan->notifikasi = 'realisasi';
        $laporan->tanggal = $request->tanggal;
        $laporan->bulan = $request->bulan;
        $laporan->tahun = $request->tahun;
        $laporan->update();





        $dipa = Dipa::where('status', 'disetujui')
                ->where('respon', 'disetujui')
                ->latest()->first();

        $stafAnggaran = staf_anggaran::where('staf_id', $laporan->staf_id)->where('dipa_id', $dipa->id)->first();
        $stafAnggaran->total_pemakaian =$stafAnggaran->total_pemakaian + $request->realisasi;
        $stafAnggaran->sisa_anggaran = $stafAnggaran->total_anggaran - $stafAnggaran->total_pemakaian;
        $stafAnggaran->update();

        $laporKeuangan = new LaporanKeuangan;
        $laporKeuangan->staf_id = $laporan->staf_id;
        $laporKeuangan->dipa_id = $laporan->dipa_id;
        $laporKeuangan->staf = $laporan->staf;
        $laporKeuangan->jenis_dipa = $laporan->jenis_dipa;
        $laporKeuangan->program_kegiatan = $laporan->program_kegiatan;
        $laporKeuangan->dipa_kegiatan = $laporan->dipa_kegiatan;
        $laporKeuangan->kegiatan_kode = $laporan->kode_kegiatan;
        $laporKeuangan->uraian_kegiatan = $laporan->uraian_kegiatan;
        $laporKeuangan->volume = $laporan->volume;
        $laporKeuangan->list = $laporan->list;
        $laporKeuangan->harga_satuan = $laporan->harga_satuan;
        $laporKeuangan->pagu = $laporan->pagu;
        $laporKeuangan->realisasi = $laporan->realisasi;
        $laporKeuangan->sisa_anggaran = $laporKeuangan->pagu - $laporKeuangan->realisasi;
        $laporKeuangan->tanggal = $laporan->tanggal;
        $laporKeuangan->bulan = $laporan->bulan;
        $laporKeuangan->tahun = $laporan->tahun;
        $laporKeuangan->save();


        return redirect('/halaman-realisasi')->with('status', 'Anggaran Berhasil di Realisasikan');
    }





    public function realisasiDelete($slug){
        $realisasiAnggar = RealisasiAnggaran::where('slug', $slug)->first();

        $stafAnggaran = staf_anggaran::where('staf_id', $realisasiAnggar->staf_id)->first();
        $stafAnggaran->total_anggaran +=$realisasiAnggar->realisasi;
        $stafAnggaran->total_pemakaian -=$realisasiAnggar->realisasi;
        $stafAnggaran->sisa_anggaran +=$realisasiAnggar->realisasi;
        $stafAnggaran->update();

        $realisasiAnggar->delete();

        $kebutuhanAnggaran = KebutuhanAnggaran::where('staf_id', $realisasiAnggar->staf_id)->first();
        $kebutuhanAnggaran->delete();

        return redirect('/halaman-realisasi')->with('status', 'Anggaran Berhasil diHapus');

    }














    public function Laporan(Request $request)
    {
        $staf = Staf::all();

        if($request->unit && $request->bulan && $request->tahun){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get();  
            $jumlah = LaporanKeuangan::where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->sum('realisasi');
                        if($request){
                            $req = $request;
                        }else{
                            $req = null;
                        }
        }elseif($request->unit && $request->bulan){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->orderBy('created_at', 'desc')
                        ->get(); 
            $jumlah = LaporanKeuangan::where('staf', $request->unit)
                        ->where('bulan', $request->bulan)
                        ->sum('realisasi'); 
                        if($request){
                            $req = $request;
                        }else{
                            $req = null;
                        }
        }elseif($request->unit && $request->tahun){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('staf', $request->unit)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get(); 
            $jumlah = LaporanKeuangan::where('staf', $request->unit)
                        ->where('tahun', $request->tahun)
                        ->sum('realisasi'); 
                        if($request){
                            $req = $request;
                        }else{
                            $req = null;
                        } 
        }elseif($request->bulan && $request->tahun){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->orderBy('created_at', 'desc')
                        ->get();  
            $jumlah = LaporanKeuangan::where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->sum('realisasi');    
                        if($request){
                            $req = $request;
                        }else{
                            $req = null;
                        }         
        }elseif($request->bulan){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('bulan', $request->bulan)->orderBy('created_at', 'desc')->get();
            $jumlah = LaporanKeuangan::where('bulan', $request->bulan)->sum('realisasi');  
            if($request){
                $req = $request;
            }else{
                $req = null;
            }          
        }elseif($request->unit){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('staf', $request->unit)->orderBy('created_at', 'desc')->get();
            $jumlah = LaporanKeuangan::where('staf', $request->unit)->sum('realisasi');
            if($request){
                $req = $request;
            }else{
                $req = null;
            }
        }elseif($request->tahun){
            $laporan = LaporanKeuangan::with('staf', 'dipa')
                        ->where('tahun', $request->tahun)->orderBy('created_at', 'desc')->get();
            $jumlah = LaporanKeuangan::where('tahun', $request->tahun)->sum('realisasi');
            if($request){
                $req = $request;
            }else{
                $req = null;
            }
        }else{
            $laporan = LaporanKeuangan::with('staf', 'dipa')->orderBy('created_at', 'desc')->get();
            $jumlah = LaporanKeuangan::sum('realisasi');
            if($request){
                $req = $request;
            }else{
                $req = null;
            }
        }
        return view('renmi/laporan', ['laporan'=>$laporan, 'jumlah'=>$jumlah,'staf'=>$staf, 'req'=>$req]);
    }

    public function hapusLaporan($slug)
    {
        $laporan = LaporanKeuangan::where('staf', $slug)->first()->delete();
        return redirect('/laporan')->with('status', 'Laporan Anggaran Sukses DiHapus');
    }

    public function laporanRevisi(Request $request)
    {
        $dipaAnggaranAwal = [];
        $dipaAnggaranBaru = [];

        $jumlah = LaporanKeuangan::where('bulan', $request->bulan)
                        ->where('tahun', $request->tahun)
                        ->sum('realisasi'); 

        $dipa = Dipa::all();
        if($request->revisi){
            $revisi = RevisiDipa::with('dipa')->where('dipa_id', $request->revisi)
                        ->orderBy('created_at', 'desc')->get();
            $tambahDipa = RevisiDipa::with('dipa')->where('dipa_id', $request->revisi)
                        ->sum('penambahan_dana');
            $kurangDipa = RevisiDipa::with('dipa')->where('dipa_id', $request->revisi)
                        ->sum('pengurangan_dana');
            foreach($dipaAnggaranAwal as $item){
                $dipaAnggaranBaru[] = $item->anggaran + $item->penambahan_dana - $item->pengurangan_dana;
            }
            $revisiStaf = RevisiStaf::with('staf', 'dipa')->where('dipa_id', $request->revisi)
                            ->orderBy('created_at', 'desc')->get();
            $tambahStaf = RevisiStaf::with('staf', 'dipa')->where('dipa_id', $request->revisi)
                            ->sum('penambahan_dana');                
            $kurangStaf = RevisiStaf::with('staf', 'dipa')->where('dipa_id', $request->revisi)
                            ->sum('pengurangan_dana');                
        }else{
            $revisi = RevisiDipa::with('dipa')->orderBy('created_at', 'desc')->get();
            $tambahDipa = RevisiDipa::with('dipa') ->sum('penambahan_dana');
            $kurangDipa = RevisiDipa::with('dipa') ->sum('pengurangan_dana');
            $revisiStaf = RevisiStaf::with('staf', 'dipa')->orderBy('created_at', 'desc')->get();
            $tambahStaf = RevisiStaf::with('staf') ->sum('penambahan_dana');
            $kurangStaf = RevisiStaf::with('staf') ->sum('pengurangan_dana');
        }
            
        return view('renmi/revisi-dana', [
            'revisi'=>$revisi, 
            'revisiStaf'=>$revisiStaf, 
            'dipa'=>$dipa, 
            'tambahDipa'=>$tambahDipa, 
            'kurangDipa'=>$kurangDipa, 
            'dipaAnggaranAwal'=>$dipaAnggaranAwal,
            'dipaAnggaranBaru'=>$dipaAnggaranBaru,
            'tambahStaf'=>$tambahStaf, 
            'kurangStaf'=>$kurangStaf,

        ]);
    }

    public function cetakLaporan()
    {
        $laporan = LaporanKeuangan::orderBy('created_at', 'desc')->get();
        $jumlah = LaporanKeuangan::sum('realisasi');
        return view('renmi/cetak-laporan', ['laporan'=>$laporan, 'jumlah'=>$jumlah]);
    }

    public function exportExcel()
    {
        $fileName = 'LaporanKeuangan.xlsx';
        return Excel::download(new LaporanKeuanganExport, $fileName);

        return back();
    }
}
