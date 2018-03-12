<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('general.settings');
    }

    public function getSettings()
    {
        $this->lijst = collect();
        $settings = Setting::where('user_id', auth()->id())->get();
        $settings->each(function($x) {
            $this->lijst->put($x->name, $x->value);
        });

        return $this->lijst;
    }

    public function edit()
    {
        return Setting::where('user_id', auth()->id())->get();
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->update(['value' => request('value')]);

        return $request;
    }
}
