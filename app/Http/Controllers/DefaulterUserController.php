<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\User;

class DefaulterUserController extends Controller
{
    public function getAlldefaulters(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $record = User::where('is_defaulter', 1)->orderBy('defaulter_date', 'DESC')->get();

            return DataTables::of($record)->make(true);
        }
        return view('defaulters.all');
    }
}