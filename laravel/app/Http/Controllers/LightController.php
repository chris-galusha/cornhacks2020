<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Light;
use App\Animation;

class LightController extends Controller
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
        $lights = Light::paginate();
        return view('light.lights', compact('lights'));
    }

    public function create()
    {
      return(view('light.create'));
    }

    public function animate(Light $light)
    {
      $animations = Animation::all();
      return view('light.animate', compact('light', 'animations'));
    }

    public function animateUpdate(Request $request) {
      app('App\Http\Controllers\AnimationController')->play($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate(getLightValidationRules());

        $name = $request->input('name');
        $location = $request->input('location');
        $ip_address = $request->input('ip_address');
        $api_token = $request->input('api_token');

        $light = new Light();
        $light->name = $name;
        $light->location = $location;
        $light->ip_address = $ip_address;
        $light_api_token = $api_token;
        $light->save();

        $message = 'New Light Created';
        session()->flash('message', $message);

        return redirect('/lights');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Light $light)
    {
        return view('light.show', compact('light'));
    }

    public function edit(Light $light)
    {
      return view('light.edit', compact('light'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Light $light)
    {
        $request->validate(getLightValidationRules());

        $light->update($request->except('_token'));

        $message = 'Light Updated: '.$light->name;
        session()->flash('message', $message);

        return redirect('/lights');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Light $light)
    {
        $light->delete();

        $message = 'Light Deleted: '.$light->name;
        session()->flash('message', $message);

        return redirect('/lights');
    }
}
