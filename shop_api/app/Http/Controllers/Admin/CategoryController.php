<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
    $data = Category::all()->toArray();
    return View('admin.category.index', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return View('admin.category.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->all();
    if(Category::create($data)){
      return redirect()->route('category.index')->with('success', 'Success');
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
    $category = Category::findOrFail($id);
    return View('admin.category.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $category = Category::findOrFail($id);
    $data = $request->all();
    if($category->update($data)){
      return redirect()->route('category.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Fail');
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
    $category = Category::findOrFail($id);
    if($category->delete()){
      return redirect()->route('category.index')->with('success', 'Success');
    } else {
      return redirect()->back()->with('error', 'Fail');
    }
  }
}
