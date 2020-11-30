<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all()->sortBy('price');
        return view('menu.index', ['menus'=> $menus]);
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.create');
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
            'title' => ['required','unique:menus','min:3','max:64'],
            'price' => ['required','min:1','max:5'],
            'weight' => ['required','min:1','max:5'],
            'meat' => ['required','numeric','min:1','max:5'], // su numeric ima ivercius
            'about' => ['required','min:3','max:64'],
        ],
        [
            'title.required' => 'Menu pavadinimas privalomas',
            'title.unique' => 'Menu pavadinimas turi buti unikalus',
            'title.min' => 'Menu pavadinimas per trumpas',
            'title.max' => 'Menu pavadinimas per ilgas',

            'price.required' => 'Kaina privaloma',
            'price.min' => 'Kaina per trumpa',
            'price.max' => 'Kaina per ilga',

            'weight.required' => 'Svoris privalomas',
            'weight.min' => 'Svoris per trumpas',
            'weight.max' => 'Svoris ilgas',

            'meat.required' => 'Svoris privalomas',
            'meat.min' => 'Svoris per trumpas',
            'meat.max' => 'Svoris ilgas',

            'about.required' => 'Privaloma parasyti kazka',
            'about.min' => 'Per mazai simboliu',
            'about.max' => 'Per daug simboliu',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $menu = new Menu();
        $menu->title = ucfirst($request->title);
        $menu->price = $request->price;
        $menu->weight = $request->weight;
        $menu->meat = $request->meat;
        $menu->about = $request->about;
        if ($request->meat > $request->weight) {
           //padaryti raudona
           return redirect()->route('menu.create')->with('info_message','mesos svoris virsyja bendra svori');
        }
        $menu->save();
        return redirect()->route('menu.index')->with('success_message','Patiekalas '.$menu->title.'sekmingai pridetas');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit',['menu'=>$menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {   
        $validator = Validator::make($request->all(),
        [
            'title' => ['required','min:3','max:64'],
            'price' => ['required','numeric','min:1','max:5'],
            'weight' => ['required','min:1','max:5'],
            'meat' => ['required','min:1','max:5'],
            'about' => ['required','min:3','max:64'],
        ],
        [
            'title.required' => 'Menu pavadinimas privalomas',
            'title.unique' => 'Menu pavadinimas turi buti unikalus',
            'title.min' => 'Menu pavadinimas per trumpas',
            'title.max' => 'Menu pavadinimas per ilgas',

            'price.required' => 'Kaina privaloma',
            'price.min' => 'Kaina per trumpa',
            'price.max' => 'Kaina per ilga',
            'price.numeric' => 'Kaina turi but skaicius',

            'weight.required' => 'Svoris privalomas',
            'weight.min' => 'Svoris per trumpas',
            'weight.max' => 'Svoris ilgas',

            'meat.required' => 'Svoris privalomas',
            'meat.min' => 'Svoris per trumpas',
            'meat.max' => 'Svoris ilgas',

            'about.required' => 'Privaloma parasyti kazka',
            'about.min' => 'Per mazai simboliu',
            'about.max' => 'Per daug simboliu',
        ]);
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        //$menu = Menu::find($menu); sito nereikia...
        $menu->id = $menu->id;
        $menu->title = $request->title;
        $menu->price = $request->price;
        $menu->weight = $request->weight;
        $menu->meat = $request->meat;
        $menu->about = $request->about;
        $menu->update();
        return redirect()->route('menu.index')->with('success_message','Patiekalas '.$menu->title.'sekmingai pakoreguotas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success_message','Patiekalas '.$menu->title.'sekmingai istrintas');
    }
}
