<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class BrandController extends Controller
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
    $data = Brand::all()->toArray();
    return View('admin.brand.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return View('admin.brand.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BrandRequest $request)
  {
    $brand = $request->all();
    if(Brand::create($brand)){
      return redirect()->route('brand.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Fail');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $brand = Brand::findOrFail($id);
    return View('admin.brand.edit',compact('brand'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(BrandRequest $request, $id)
  {
    $brand = Brand::findOrFail($id);
    $data = $request->all();
    if($brand->update($data)){
      return redirect()->route('brand.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Update fail');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $brand = Brand::findOrFail($id);
    if($brand->delete()){
      return redirect()->route('brand.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Delete fail');
    }
  }
}
