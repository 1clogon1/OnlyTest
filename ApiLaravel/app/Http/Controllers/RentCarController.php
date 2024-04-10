<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Driver;
use App\Models\RentCar;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RentCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user()->makeHidden(['id']);
        $request->validate([
            'rent_from' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'rent_before' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
        ]);

        $worker = Worker::where('id', $user->id)->first();

        if ($worker != null) {//Есть ли авто под данную категорию и авто должно быть с водителем
            $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->first();
            if ($auto != null) {
                $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->get();

                $array=[];
                for ($i = 0; $i != Count($auto); $i++) {
                    $rent_car_from = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_from)->where('rent_before', '>=', $request->rent_from)->first();
                    $rent_car_before = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_before)->where('rent_before', '>=', $request->rent_before)->first();

                    $rent_car = RentCar::where('auto_id', $auto[$i]->id)->get();
                    $number = 0;
                    for ($j = 0; $j != Count($rent_car); $j++) {
                        $auto_rent_form = ($request->rent_from <= $rent_car[$j]->rent_from) && ($rent_car[$j]->rent_from <= $request->rent_before);
                        $auto_rent_before = ($request->rent_from <= $rent_car[$j]->rent_before) && ($rent_car[$j]->rent_before <= $request->rent_before);
                        if (($auto_rent_form) || ($auto_rent_before)) $number++;
                    }

                    if (($rent_car_from == null && $rent_car_before == null) && $number == 0) {
                        $driver = Driver::where('id', $auto[$i]->driver_id)->first();
                        $search_auto = [
                            'id' => $auto[$i]->id,
                            'name_auto' => $auto[$i]->name,
                            'category' => $auto[$i]->category,
                            'name_driver' => $driver->name,
                        ];
                        array_push($array, $search_auto);
                    }
                }

                return response(['rent_car' => $array], 200);
            }
            else {
                return response(['message' => 'Нету авто под данного работника'], 404);
            }
        } else {
            return response(['message' => 'ошибка с пользователем'], 404);
        }

    }

    public function index_category(Request $request)
    {
        $user = Auth::user()->makeHidden(['id']);
        $request->validate([
            'rent_from' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'rent_before' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
        ]);

        $worker = Worker::where('id', $user->id)->first();

        if ($worker != null) {//Есть ли авто под данную категорию и авто должно быть с водителем
            $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->first();
            if ($auto != null) {
                $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->orderBy('category','ASC')->get();

                $array=[];
                for ($i = 0; $i != Count($auto); $i++) {
                    $rent_car_from = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_from)->where('rent_before', '>=', $request->rent_from)->first();
                    $rent_car_before = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_before)->where('rent_before', '>=', $request->rent_before)->first();

                    $rent_car = RentCar::where('auto_id', $auto[$i]->id)->get();
                    $number = 0;
                    for ($j = 0; $j != Count($rent_car); $j++) {
                        $auto_rent_form = ($request->rent_from <= $rent_car[$j]->rent_from) && ($rent_car[$j]->rent_from <= $request->rent_before);
                        $auto_rent_before = ($request->rent_from <= $rent_car[$j]->rent_before) && ($rent_car[$j]->rent_before <= $request->rent_before);
                        if (($auto_rent_form) || ($auto_rent_before)) $number++;
                    }

                    if (($rent_car_from == null && $rent_car_before == null) && $number == 0) {
                        $driver = Driver::where('id', $auto[$i]->driver_id)->first();
                        $search_auto = [
                            'id' => $auto[$i]->id,
                            'name_auto' => $auto[$i]->name,
                            'category' => $auto[$i]->category,
                            'name_driver' => $driver->name,
                        ];
                        array_push($array, $search_auto);
                    }
                }

                return response(['rent_car' => $array], 200);
            }
            else {
                return response(['message' => 'Нету авто под данного работника'], 404);
            }
        } else {
            return response(['message' => 'ошибка с пользователем'], 404);
        }

    }


    public function index_model(Request $request)
    {
        $user = Auth::user()->makeHidden(['id']);
        $request->validate([
            'rent_from' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'rent_before' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
        ]);

        $worker = Worker::where('id', $user->id)->first();

        if ($worker != null) {//Есть ли авто под данную категорию и авто должно быть с водителем
            $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->first();
            if ($auto != null) {
                $auto = Auto::where('category', '<=', $worker->category)->where('driver_id', '!=', null)->orderBy('name','ASC')->get();

                $array=[];
                for ($i = 0; $i != Count($auto); $i++) {
                    $rent_car_from = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_from)->where('rent_before', '>=', $request->rent_from)->first();
                    $rent_car_before = RentCar::where('auto_id', $auto[$i]->id)->where('rent_from', '<=', $request->rent_before)->where('rent_before', '>=', $request->rent_before)->first();

                    $rent_car = RentCar::where('auto_id', $auto[$i]->id)->get();
                    $number = 0;
                    for ($j = 0; $j != Count($rent_car); $j++) {
                        $auto_rent_form = ($request->rent_from <= $rent_car[$j]->rent_from) && ($rent_car[$j]->rent_from <= $request->rent_before);
                        $auto_rent_before = ($request->rent_from <= $rent_car[$j]->rent_before) && ($rent_car[$j]->rent_before <= $request->rent_before);
                        if (($auto_rent_form) || ($auto_rent_before)) $number++;
                    }

                    if (($rent_car_from == null && $rent_car_before == null) && $number == 0) {
                        $driver = Driver::where('id', $auto[$i]->driver_id)->first();
                        $search_auto = [
                            'id' => $auto[$i]->id,
                            'name_auto' => $auto[$i]->name,
                            'category' => $auto[$i]->category,
                            'name_driver' => $driver->name,
                        ];
                        array_push($array, $search_auto);
                    }
                }

                return response(['rent_car' => $array], 200);
            }
            else {
                return response(['message' => 'Нету авто под данного работника'], 404);
            }
        } else {
            return response(['message' => 'ошибка с пользователем'], 404);
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public
    function create(Request $request)
    {
        $user = Auth::user()->makeHidden(['id']);

        $request->validate([
            'auto_id' => 'required|numeric|min:1|max:9999999999',
            'rent_from' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
            'rent_before' => 'required|regex:/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/',
        ]);
        $worker = Worker::where('id', $user->id)->first();

        if ($worker != null) {//Есть ли такой пользователь
            $auto = Auto::where('id', $request->auto_id)->first();
            if ($auto != null) {//Есть ли такое авто
                if ($auto->driver_id != null) {//Есть ли у данного авто водитель
                    $t1 = Carbon::parse($request->rent_before);
                    $t2 = Carbon::parse($request->rent_from);
                    $diff = $t1->diff($t2);
                    if ($diff->h >= 1) {//Нельзя арендовать автомобиль меньше чем на 1 час
                        $auto_catgory = Auto::where('id', $request->auto_id)->where('category', '<=', $worker->category)->first();
                        if ($auto_catgory != null) {
                            $rent_car_from = RentCar::where('auto_id', $request->auto_id)->where('rent_from', '<=', $request->rent_from)->where('rent_before', '>=', $request->rent_from)->first();
                            $rent_car_before = RentCar::where('auto_id', $request->auto_id)->where('rent_from', '<=', $request->rent_before)->where('rent_before', '>=', $request->rent_before)->first();

                            $rent_car = RentCar::where('auto_id', $request->auto_id)->get();
                            $number = 0;
                            for ($i = 0; $i != Count($rent_car); $i++) {
                                $auto_rent_form = ($request->rent_from <= $rent_car[$i]->rent_from) && ($rent_car[$i]->rent_from <= $request->rent_before);
                                $auto_rent_before = ($request->rent_from <= $rent_car[$i]->rent_before) && ($rent_car[$i]->rent_before <= $request->rent_before);
                                if (($auto_rent_form) || ($auto_rent_before)) $number++;

                            }

                            if (($rent_car_from == null && $rent_car_before == null) && $number == 0) {
                                RentCar::create([
                                    'auto_id' => $request->auto_id,
                                    'worker_id' => $worker->id,
                                    'rent_from' => $request->rent_from,
                                    'rent_before'=>$request->rent_before
                                ]);
                                return response(['message' => 'Автомобиль забронирован'], 200);

                            } else {
                                return response(['message' => 'Автомобиль занят'], 200);
                            }

                        } else {
                            return response(['message' => 'Категория данного авто не подходит'], 404);
                        }
                    } else {
                        return response(['message' => 'Нельзя арендовать автомобиль меньше чем на один час'], 404);
                    }
                } else {
                    return response(['message' => 'У данного автомобиля нету водителя'], 404);
                }
            } else {
                return response(['message' => 'Такого автомобиль нету'], 404);
            }
        } else {
            return response(['message' => 'ошибка с пользователем'], 404);
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public
    function show(RentCar $rentCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(RentCar $rentCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, RentCar $rentCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(RentCar $rentCar)
    {
        //
    }
}
