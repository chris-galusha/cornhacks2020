<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;

class ServiceController extends Controller
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
        $services = Service::paginate();
        return view('service.services', compact('services'));
    }

    public function create()
    {
      return(view('service.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate(getServiceValidationRules());

        $name = $request->input('name');

        $service = new service();
        $service->name = $name;
        $service->save();

        $message = 'New service Created';
        session()->flash('message', $message);

        return redirect('/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return view('service.show', compact('service'));
    }

    public function edit(Service $service)
    {
      return view('service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate(getServiceValidationRules());

        $service->update($request->except('_token'));

        $message = 'service Updated: '.$service->name;
        session()->flash('message', $message);

        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        $message = 'service Deleted: '.$service->name;
        session()->flash('message', $message);

        return redirect('/services');
    }
}
