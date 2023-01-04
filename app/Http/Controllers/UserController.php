<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationRequest;
use App\Services\ApplicationService;
use App\Models\Application;
use Illuminate\Http\Request;

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
    public function store(ApplicationRequest $request)
    {
        $this->service->save($request, new Application);
        return redirect()->route('user')->with('success', 'New application was create');
    }
}
