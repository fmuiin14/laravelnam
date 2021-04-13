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
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
                ->rawColumns(['action'])->make(true);
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

        $photo = $request->photo;
        $new_photo = time() . $photo->getClientOriginalName();

        $nikjabs = $request->jabatan_id;
        
        $nik1 = DB::table('employee')->latest('id')->first();
        $nikidny = $nik1->id+1;

        $nikth = date("Ym", strtotime($request->datenya));
        
        $nikfix = $nikjabs . $nikth . $nikidny;

        $employee = Employee::create([
            'nik' => $nikfix,
            'nama_pegawai' => $request->nama,
            'jabatan_id' => $request->jabatan_id,
            'jenis_kelamin' => $request->j_k,
            'tanggal_masuk' => Carbon::createFromFormat('Y-m-d', $request->datenya),
            'status_karyawan' => $request->status,
            'photo' => 'public/uploads/photo/' . $new_photo
        ]);

        // $employee->jabatan()->attach($request->jabatan_id);

        $photo->move('public/uploads/posts/', $new_photo);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }
}
