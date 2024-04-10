<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $worker = Worker::orderBy('id', 'ASC')->get();
        if ($worker->isNotEmpty()) {
            return response(['worker' => $worker], 200);
        } else {
            return response(['worker' => 'null'], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/[А-Яф-яЁё]/u|min:1|max:100|unique:worker',
            'category' => 'required|numeric|min:1|max:5',
        ]);
        if (Worker::create($request->all())) {
            return response(['message' => 'Работник добавлен'], 200);
        } else {
            return response(['message' => 'Ошибка'], 404);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|regex:/^[a-zA-Z0-9\-]+$/|string|max:20|min:4|unique:worker',
            'password' => 'required|regex:/^[a-zA-Z0-9\-]+$/|string|max:100|min:10',
        ]);
        Worker::create([
            'login' => $request->login,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(100),
        ]);
        return response(['message' => 'Работник зарегистрирован'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worker $worker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worker $worker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worker $worker)
    {
        //
    }
}
