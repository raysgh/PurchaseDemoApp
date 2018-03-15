<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use App\User;

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
        return User::find(auth()->id())->userSettings();
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
