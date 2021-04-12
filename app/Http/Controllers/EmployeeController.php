<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Employee;
use Yajra\Datatables\Datatables;

class EmployeeController extends Controller
{
    public function index(Request $request) 
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if($request->ajax()) {
            // ambil semua data
            $employees = Employee::all();
            return Datatables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                return $btn;
            })
            ->rawColumns(['action'])->make(true);
        }

        return view('pages.employee');
    }

    public function create() {
        return view('pages.employee-create');
    }
}
