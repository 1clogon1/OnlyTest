<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use Illuminate\Http\Request;
class AutoController extends Controller
{

    public function index()
    {
        $auto = Auto::orderBy('id', 'ASC')->get();
        if ($auto->isNotEmpty()) {
            return response(['auto' => $auto], 200);
        } else {
            return response(['auto' => 'null'], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z]+$/u|min:1|max:100',
            'category' => 'required|numeric|min:1|max:5',
        ]);
        if ( Auto::create($request->all())) {
            return response(['message' => 'Автомобиль добавлен'], 200);
        } else {
            return response(['message' => 'Ошибка'], 404);
        }

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
    public function show(Car_Model $car_Model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car_Model $car_Model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car_Model $car_Model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car_Model $car_Model)
    {
        //
    }
}
