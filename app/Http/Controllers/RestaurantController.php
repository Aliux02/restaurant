<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all()->sortBy('title');
        $restaurants = Restaurant::all()->sortBy('title');
        return view('restaurant.index',['restaurants'=>$restaurants],['menus'=> $menus]);
    }

    public function sort()
    {
        $menus = Menu::all()->sortBy('title');
        $restaurants = Restaurant::where('menu_id','=',$_GET['menu_id'])->get();
        return view('restaurant.index',['menus'=> $menus],['restaurants'=>$restaurants]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = Menu::all()->sortBy('title');
        return view('restaurant.create',['menus'=> $menus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => ['required','unique:restaurants','min:3','max:64'],
            'customers' => ['required','min:1','max:4'],
            'employees' => ['required','min:1','max:4'],
        ],
        [
            'title.required' => 'Restorano pavadinimas privalomas',
            'title.unique' => 'Restorano pavadinimas turi buti unikalus',
            'title.min' => 'Restorano pavadinimas per trumpas',
            'title.max' => 'Restorano pavadinimas per ilgas',

            'customers.required' => 'Klientu skaicius privalomas',
            'customers.min' => 'Klientu skaicius per trumpas',
            'customers.max' => 'Klientu skaicius per ilgas',

            'employees.required' => 'Darbuotoju skaicius privalomas',
            'employees.min' => 'Darbuotoju skaicius per trumpas',
            'employees.max' => 'Darbuotoju skaicius ilgas',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $restaurant = new Restaurant();
        $restaurant->title = ucfirst($request->title);
        $restaurant->customers = $request->customers;
        $restaurant->employees = $request->employees;
        $restaurant->menu_id = $request->menu_id; 
        $restaurant->save();
        return redirect()->route('restaurant.index')->with('success_message','Restoranas '.$restaurant->title.'sekmingai pridetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $menus = Menu::all();
        return view('restaurant.edit',['restaurant'=>$restaurant],['menus'=> $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validator = Validator::make($request->all(),
        [
            'title' => ['required','min:3','max:64'],
            'customers' => ['required','min:1','max:4'],
            'employees' => ['required','min:1','max:4'],
        ],
        [
            'title.required' => 'Restorano pavadinimas privalomas',
            'title.unique' => 'Restorano pavadinimas turi buti unikalus',
            'title.min' => 'Restorano pavadinimas per trumpas',
            'title.max' => 'Restorano pavadinimas per ilgas',

            'customers.required' => 'Klientu skaicius privalomas',
            'customers.min' => 'Klientu skaicius per trumpas',
            'customers.max' => 'Klientu skaicius per ilgas',

            'employees.required' => 'Darbuotoju skaicius privalomas',
            'employees.min' => 'Darbuotoju skaicius per trumpas',
            'employees.max' => 'Darbuotoju skaicius ilgas',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $restaurant->id = $restaurant->id;
        $restaurant->title = $request->title;
        $restaurant->customers = $request->customers;
        $restaurant->employees = $request->employees;
        $restaurant->menu_id = $request->menu_id; 
        $restaurant->update();
        return redirect()->route('restaurant.index')->with('success_message','Restoranas '.$restaurant->title.'sekmingai pakoreguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurant.index')->with('success_message','Restoranas '.$restaurant->title.'sekmingai istrintas');
    }
}
