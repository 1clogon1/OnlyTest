<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $driver = Driver::orderBy('id', 'ASC')->get();
        if ($driver->isNotEmpty()) {
            return response(['driver' => $driver], 200);
        } else {
            return response(['driver' => 'null'], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/[А-Яф-яЁё]/u|min:1|max:100|unique:driver',
            'auto_id' => 'numeric|min:1|max:99999999999',
        ]);
        if($request->auto_id == null){
            if (Driver::create($request->all())) {
                return response(['message' => 'Водитель добавлен'], 200);
            } else {
                return response(['message' => 'Ошибка'], 404);
            }
        }else{
            $auto = Auto::where('id',$request->auto_id)->first();
            if($auto!=null){
                $driver = Driver::where('auto_id',$request->auto_id)->first();
                if($driver==null){
                    if (Driver::create($request->all())) {
                        return response(['message' => 'Водитель добавлен и прикреплен к нему автомобиль'], 200);
                    } else {
                        return response(['message' => 'Ошибка'], 404);
                    }
                }
                else{
                    return response(['message' => 'Автомобиль занят'], 404);
                }
            }
            else{
                return response(['message' => 'Такого авто нету'], 404);
            }
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
