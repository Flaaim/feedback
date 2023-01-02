<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApplicationService;
use App\Models\Application;

class UserController extends Controller
{
    protected $service;

    public function __construct(ApplicationService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        return view('user.index');
    }

    public function store(Request $request)
    {
        $this->service->save($request, new Application);
        return redirect()->route('user')->with('success', 'New application was create');
    }
}
