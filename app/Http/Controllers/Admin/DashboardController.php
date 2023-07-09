<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $hotel = Hotel::all();
        // dd($hotel);
        return view('admin.dashboard');
    }
}
