<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Employee;
use App\Sallary;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->ajax()) {
            // ambil semua data
            $employees = Employee::all();
            return Datatables::of($employees)
                ->addIndexColumn()
                ->addColumn('action', function () {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View Detail</a>';

                    return $btn;
                })
                ->addColumn('jenis_kelamin', function($data) {
                    if($data->jenis_kelamin == 'M'){
                        return 'Laki - Laki';
                    }else{
                        return 'Perempuan';
                    }
                })
                ->addColumn('data', function () {
                    $btn = '<a href="javascript:void(0)" class="delete badge badge-danger btn-sm">hapus</a>
                    <a href="javascript:void(0)" class="info badge badge-info btn-sm">edit</a>';

                    return $btn;
                })
                ->rawColumns(['action', 'data'])->make(true);
                // ->rawColumns(['data'])->make(true);
        }

        return view('pages.employee');
    }

    public function create()
    {
        $salaries = Sallary::all();
        return view('pages.employee-create', compact('salaries'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jabatan_id' => 'required',
            'j_k' => 'required',
            'datenya' => 'required',
            'status' => 'required',
            'photo' => 'required'
        ]);

        if ($request->file('photo')) {
            $file = $request->file('photo')->store('photos', 'public');
            // $new_user->avatar = $file;
        }

        $nikjabs = $request->jabatan_id;

        $nik1 = DB::table('employee')->latest('id')->first();
        $nikidny = $nik1->id + 1;

        $nikth = date("Ym", strtotime($request->datenya));

        $nikfix = $nikjabs . $nikth . $nikidny;

        $employee = Employee::create([
            'nik' => $nikfix,
            'nama_pegawai' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->j_k,
            'tanggal_masuk' => Carbon::createFromFormat('Y-m-d', $request->datenya),
            'status_karyawan' => $request->status,
            'photo' => $file
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
