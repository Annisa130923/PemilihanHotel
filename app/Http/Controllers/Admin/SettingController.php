<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\App;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting');
    }
    public function store(Request $request)
    {
        $request->validate([
            'app_name' => 'required'
        ]);
        $app = App::first();

        $app->app_name = $request->app_name;
        
        if($app->save()) {
            return redirect()->route('admin.dashboard');
        }
    }
}
