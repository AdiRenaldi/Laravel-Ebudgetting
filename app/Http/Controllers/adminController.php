<?php

namespace App\Http\Controllers;

use App\Models\Renmi;
use App\Models\Spn;
use App\Models\Staf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function dashboard()
    {
        $renmin = Renmi::orderBy('created_at', 'desc')->get();
        $spn = Spn::orderBy('created_at', 'desc')->get();
        $staf = Staf::orderBy('created_at', 'desc')->get();
        return view('admin/dashboard', ['renmin'=>$renmin, 'spn'=>$spn, 'staf'=>$staf]);
    }

    public function renmidata()
    {
        $renmi = Renmi::with('role')->get();
        return view('admin/renmi-data', ['renmi'=>$renmi]);
    }

    public function renmiAdd()
    {
        return view('admin/renmi-tambah');
    }

    public function renmiProsesAdd(Request $request)
    {
        $validated = $request->validate(
            [
                'username' => 'required|unique:renmi|max:255',
                'password' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                'email' => 'required|unique:renmi|max:255',
            ],
                [
                    'username.required' => 'username wajib diisi',
                    'username.unique' => 'username sudah ada',
                    'username.max' => 'maksimal 255 carakter',

                    'password.required' => 'password wajib diisi',
                    'password.max' => 'maksimal 255 carakter',

                    'nama.required' => 'nama wajib diisi',
                    'nama.max' => 'maksimal 255 carakter',

                    'pangkat.required' => 'pangkat wajib diisi',
                    'pangkat.max' => 'maksimal 255 carakter',

                    'nrp.required' => 'nrp wajib diisi',
                    'nrp.numeric' => 'nrp harus berupa angka',

                    'telpon.required' => 'telpon wajib diisi',
                    'telpon.numeric' => 'telpon harus berupa angka',

                    'email.required' => 'email wajib diisi',
                    'email.unique' => 'email sudah ada',
                    'email.max' => 'maksimal 255 carakter',
                ]
        );    
        
        //masukkan file ke database
        $request['password'] = Hash::make($request['password']);
        $renmi = Renmi::create($request->all());
        return redirect('/renmi-data')->with('status', 'Data Sukses Ditambahkan');
    }

    public function renmiEdit($slug)
    {
        $renmin = Renmi::where('slug', $slug)->first();
        return view('admin/renmi-edit', ['renmin' => $renmin]);
    }

    public function renminUpdate(Request $request, $slug)
    {
        $validated = 
            [
                // 'username' => 'required|unique:renmi|max:255',
                // 'password' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                // 'email' => 'required|unique:renmi|max:255',
            ];

        $renmin = Renmi::where('slug', $slug)->first();
        if ($request['username'] != $renmin->username) {
            $validated['username'] ='required|unique:renmi|max:255';
        }
        if ($request['email'] != $renmin->email) {
            $validated['email'] ='required|unique:renmi|max:255';
        }
        if ($request->password) {
            $password = $request['password'] = Hash::make($request['password']);
        } else{
            $password = $renmin->password;
        }

        $request->validate($validated);
        //masukkan file ke database
        $renmin->slug = null;
        $request['password'] = $password;
        $renmin->update($request->all());
        return redirect('/renmi-data')->with('status', 'Data Sukses di Ubah');
    }

    public function renminDelete($slug)
    {
        $renmin = Renmi::where('slug', $slug)->first();
        $renmin->delete();
        return redirect('/renmi-data')->with('status', 'Data Sukses di Hapus');
    }


    public function spndata()
    {
        $spn = Spn::with('role')->get();
        return view('admin/spn-data', ['spn' =>$spn]);
    }

    public function spnAdd()
    {
        return view('admin/spn-tambah');
    }

    public function spnProsesAdd(Request $request)
    {
        $validated = $request->validate(
            [
                'username' => 'required|unique:kepala_spn|max:255',
                'password' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                'email' => 'required|unique:kepala_spn|max:255',
            ],
                [
                    'username.required' => 'username wajib diisi',
                    'username.unique' => 'username sudah ada',
                    'username.max' => 'maksimal 255 carakter',

                    'password.required' => 'password wajib diisi',
                    'password.max' => 'maksimal 255 carakter',

                    'nama.required' => 'nama wajib diisi',
                    'nama.max' => 'maksimal 255 carakter',

                    'pangkat.required' => 'pangkat wajib diisi',
                    'pangkat.max' => 'maksimal 255 carakter',

                    'nrp.required' => 'nrp wajib diisi',
                    'nrp.numeric' => 'nrp harus berupa angka',

                    'telpon.required' => 'telpon wajib diisi',
                    'telpon.numeric' => 'telpon harus berupa angka',

                    'email.required' => 'email wajib diisi',
                    'email.unique' => 'email sudah ada',
                    'email.max' => 'maksimal 255 carakter',
                ]
        );    
        
        //masukkan file ke database
        $request['password'] = Hash::make($request['password']);
        $spn = Spn::create($request->all());
        return redirect('/spn-data')->with('status', 'Data Sukses Ditambahkan');
    }

    public function spnEdit($slug)
    {
        $spn = Spn::where('slug', $slug)->first();
        return view('admin/spn-edit', ['spn' => $spn]);
    }

    public function spnUpdate(Request $request, $slug)
    {
        $validated = 
            [
                // 'username' => 'required|unique:kepala_spn|max:255',
                // 'password' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                // 'email' => 'required|unique:kepala_spn|max:255',
            ];

        $spn = Spn::where('slug', $slug)->first();
        if ($request['username'] != $spn->username) {
            $validated['username'] ='required|unique:kepala_spn|max:255';
        }
        if ($request['email'] != $spn->email) {
            $validated['email'] ='required|unique:kepala_spn|max:255';
        }
        if ($request->password) {
            $password = $request['password'] = Hash::make($request['password']);
        } else{
            $password = $spn->password;
        }

        $request->validate($validated);
        //masukkan file ke database
        $spn->slug = null;
        $request['password'] = $password;
        $spn->update($reqest->all());
    }

    public function spnDelete($slug)
    {
        $renmin = Spn::where('slug', $slug)->first();
        $renmin->delete();
        return redirect('/spn-data')->with('status', 'Data Sukses di Hapus');
    }


    public function stafdata()
    {
        $staf = Staf::with('role')->get();
        return view('admin/staf-data', ['staf' =>$staf]);
    }

    public function stafAdd()
    {
        return view('admin/staf-tambah');
    }

    public function stafProsesAdd(Request $request)
    {
        $validated = $request->validate(
            [
                'username' => 'required|unique:staf|max:255',
                'password' => 'required|max:255',
                'bidang' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                'email' => 'required|unique:staf|max:255',
            ],
                [
                    'username.required' => 'username wajib diisi',
                    'username.unique' => 'username sudah ada',
                    'username.max' => 'maksimal 255 carakter',

                    'password.required' => 'password wajib diisi',
                    'password.max' => 'maksimal 255 carakter',

                    'bidang.required' => 'bidang wajib diisi',
                    'bidang.max' => 'maksimal 255 carakter',

                    'nama.required' => 'nama wajib diisi',
                    'nama.max' => 'maksimal 255 carakter',

                    'pangkat.required' => 'pangkat wajib diisi',
                    'pangkat.max' => 'maksimal 255 carakter',

                    'nrp.required' => 'nrp wajib diisi',
                    'nrp.numeric' => 'nrp harus berupa angka',

                    'telpon.required' => 'telpon wajib diisi',
                    'telpon.numeric' => 'telpon harus berupa angka',

                    'email.required' => 'email wajib diisi',
                    'email.unique' => 'email sudah ada',
                    'email.max' => 'maksimal 255 carakter',
                ]
        );    
        
        //masukkan file ke database
        $request['password'] = Hash::make($request['password']);
        $spn = Staf::create($request->all());
        return redirect('/staf-data')->with('status', 'Data Sukses Ditambahkan');
    }

    public function stafEdit($slug)
    {
        $staf = Staf::where('slug', $slug)->first();
        return view('admin/staf-edit', ['staf' => $staf]);
    }

    public function stafUpdate(Request $request, $slug)
    {
        $validated = 
            [
                // 'username' => 'required|unique:staf|max:255',
                // 'password' => 'required|max:255',
                'nama' => 'required|max:255',
                'pangkat' => 'required|max:255',
                'nrp' => 'required|numeric',
                'telpon' => 'required|numeric',
                // 'email' => 'required|unique:staf|max:255',
            ];

        $staf = Staf::where('slug', $slug)->first();
        if ($request['username'] != $staf->username) {
            $validated['username'] ='required|unique:staf|max:255';
        }
        if ($request['email'] != $staf->email) {
            $validated['email'] ='required|unique:staf|max:255';
        }
        if ($request->password) {
            $password = $request['password'] = Hash::make($request['password']);
        } else{
            $password = $staf->password;
        }

        $request->validate($validated);
        //masukkan file ke database
        $staf->slug = null;
        $request['password'] = $password;
        $staf->update($request->all());
        return redirect('/staf-data')->with('status', 'Data Sukses di Ubah');
    }

    public function stafDelete($slug)
    {
        $renmin = Staf::where('slug', $slug)->first();
        $renmin->delete();
        return redirect('/staf-data')->with('status', 'Data Sukses di Hapus');
    }
}
