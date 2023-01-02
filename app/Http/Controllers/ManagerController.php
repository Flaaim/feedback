<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ManagerController extends Controller
{
    public function index()
    {
        $applications = Application::all();
        return view('manager.index', ['applications' => $applications]);
    }
}
