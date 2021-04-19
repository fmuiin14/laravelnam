<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Sallary;
use Yajra\Datatables\Datatables;

class SallaryController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if ($request->ajax()) {
            // ambil semua data
            $sallaries = Sallary::all();
            return Datatables::of($sallaries)
                ->addIndexColumn()
                ->addColumn('data', function ($data) {
                    $button = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $data->id . '" data-original-title="Edit" class="info badge badge-info btn-sm edit-product">Edit</a>';

                    $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="delete" id="' . $data->id . '" class="delete badge badge-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['data'])->make(true);
        }

        return view('sallary.sallary');
    }
}
