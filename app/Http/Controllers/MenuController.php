<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("management.menu.index")->with(
            [
                "menus" => Menu::paginate(6)
            ]
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("management.menu.create")->with(
            [
                "categories" => Menu::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validaton
        $this -> validate($request, [
            "title" => "Required|min:4|unique:menus,title",
            "description" => "Required|min:4",
            "price" => "Required|numeric",
            "image" => "Required|image|mimes:png, jpg, jpeg, svg|max:3000",
            "category_id" => "Required|numeric",
        ]);
        // Store Data
        if($request -> hasFile("image")){
            $file = $request -> image;
            $imageName = time(). "_" . $file -> getClientOriginalName();
            $file -> move(public_path('images/menus'), $imageName);
            $title = $request->title;
            Menu::create([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $request ->description,
                "image" => $imageName,
                "category_id" => $request->category_id,
            ]);
            // Redirect
            return redirect()->route("menus.index")->with([
                "success" => "menu  ajoutée"
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view("management.menu.edit")->with(
            [
                "categories" => Category::all(),
                "menu" => $menu
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        // Validaton
        $this->validate($request, [
            "title" => "Required|min:4|unique:menus,title". $menu->id,
            "description" => "Required|min:4",
            "price" => "Required|numeric",
            "image" => "image|mimes:png, jpg, jpeg, svg|max:3000",
            "category_id" => "Required|numeric",
        ]);
        // Store Data
        if ($request->hasFile("image")) {
            unlink(public_path('images/menus/'. $menu->image));
            $file = $request->image;
            $imageName = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('images/menus'), $imageName);
            $title = $request->title;
            $menu->update([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $request->description,
                "price" => $request->price,
                "image" => $imageName,
                "category_id" => $request->category_id,
            ]);
            // Redirect
            return redirect()->route("menus.index")->with([
                "success" => "menu modifier"
            ]);
        }
        else{
            $title = $request->title;
            $menu->update([
                "title" => $title,
                "slug" => Str::slug($title),
                "description" => $request->description,
                "price" => $request->price,
                "category_id" => $request->category_id,
            ]);
            // Redirect
            return redirect()->route("menus.index")->with([
                "success" => "menu modifier"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //delete image
        unlink(public_path('images/menus/' . $menu->image));
        $menu->delete();
        // Redirect
        return redirect()->route("menus.index")->with([
            "success" => "menu supprime"
        ]);
    }
}