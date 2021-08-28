<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class CategoryController extends Controller
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
        return view('management.categories.index')->with(
            [
                "categories" => Category::paginate(8)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management.categories.create');
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
        $this->validate($request, [
            "title" => "Required|min:4"
        ]);
        // Store Data
        $title = $request->title;
        Category::create([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);
        // Redirect
        return redirect()->route("categories.index")->with([
            "success" => "Catégorie ajoutée"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("management.categories.create")->with([
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validaton
        $this->validate($request, [
            "title" => "Required|min:4"
        ]);
        // Store Data
        $title = $request->title;
        $category->update([
            "title" => $title,
            "slug" => Str::slug($title)
        ]);
        // Redirect
        return redirect()->route("categories.index")->with([
            "success" => "Catégorie modifiée"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Delete Category
        $category->delete();
        // Redirect
        return redirect()->route("categories.index")->with([
            "success" => "Catégorie supprimée"
        ]);
    }
}