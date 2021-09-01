<?php

namespace App\Http\Controllers;

use App\Servants;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ServantsController extends Controller
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
        return view('management.serveurs.index')->with(
            [
                "servants" => Servants::paginate(6)
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
        return view('management.serveurs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            "name" => "required|min:3",
        ]);
        //store data
        $name = $request->name;
        Servants::create([
            "name" => $name,
            "slug" => Str::slug($name),
            "address" => $request->address,
        ]);
        //redirect user
        return redirect()->route("servants.index")->with([
            "success" => "serveur ajoutée avec succés"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servants  $servants
     * @return \Illuminate\Http\Response
     */
    public function show(Servants $servants)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servants  $servants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("management.serveurs.edit")->with([
            "servant" => Servants::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servants  $servants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        // Validaton
        $this->validate($request, [
            "name" => "Required|min:4",
        ]);
        // Update Data
        $name = $request->name;
        $servant = Servants::findOrFail($id);
        $servant->update([
            "name" => $name,
            "slug" => Str::slug($name),
            "address" => $request->adress
        ]);
        // Redirect
        return redirect()->route("servants.index")->with([
            "success" => "serveur modifiée"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servants  $servants
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        // Delete Category
        $servant = Servants::findOrFail($id);
        $servant->delete();
        // Redirect
        return redirect()->route("servants.index")->with([
            "success" => "serveur supprimée"
        ]);
    }
}