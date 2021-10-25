<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class CountryController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
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
    $data = Country::all()->toArray();
    return View('admin.country.list', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return View('admin.country.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CountryRequest $request)
  {
    $data = $request->all();
    if(Country::create($data)){
      $request->session()->flash('success', 'Success');
    } else {
      $request->session()->flash('error', 'Fail');
    }
    return redirect('admin/country');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $data = Country::findOrFail($id);
    return View('admin.country.update', compact('data'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(CountryRequest $request, $id)
  {
    $country = Country::find($id);
    $data = $request->all();
    if($country->update([
      'name'=>$data['name'],
      'active'=>$data['active']
    ])){
      $request->session()->flash('success', 'Success');
    } else {
      $request->session()->flash('error', 'Fail');
    };
    return redirect()->route('country.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $country = Country::findOrFail($id);
    if($country->delete()){
      return redirect()->route('country.index')->with('success','Success');
    } else {
      return redirect()->back()->with('error', 'Fail');
    }
  }

  // disable country
  public function disableCountry($id){
    $country = Country::findOrFail($id);
    if($country->update(['active'=>0])){
      return redirect()->route('country.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Fails');
    }
  }

  // enable country
  public function enableCountry($id){
    $country = Country::findOrFail($id);
    if($country->update(['active'=>1])){
      return redirect()->route('country.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Fails');
    }
  }
}
