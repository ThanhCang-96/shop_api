<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Facade\FlareClient\Stacktrace\File;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
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

  // public function delete_files($target) {
  //   if (is_dir($target)) {
  //       $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

  //       foreach( $files as $file )
  //       {
  //           delete_files( $file );
  //       }

  //       rmdir( $target );
  //   } elseif (is_file($target)) {
  //       unlink( $target );
  //   }
  // }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = User::all()->toArray();
    return View('admin.user.list', compact('data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show()
  {
    $id = Auth::id();
    $user = User::findOrFail($id);
    $countries = Country::all()->toArray();
    return View('admin.user.profile', compact(['user', 'countries']));
  }

  /**
   * Show the form for editing the specified resource.
   * Show detail information of user
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = User::findOrFail($id);
    $countries = Country::all()->toArray();
    return View('admin.user.user_detail', compact(['user', 'countries']));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UserRequest $request, $id)
  {
    $user = User::findOrFail($id);
    $data = $request->all();

    // check password
    if(!empty($request->password)){
      $data['password'] = Hash::make($data['password']);
    } else {
      $data['password'] = $user['password'];
    }

    if($request->hasFile('avatar')){
      $file = $request->avatar;
      $avatar = time().'_'.$file->getClientOriginalName();
      $data['avatar'] = $avatar;
      $dir = '../public/upload/avatar/'.$id;
      $oldImg = $dir.'/'.$user['avatar'];
      if($user = $user->update($data)){
        if(!empty($file)){
          // $dir = '../public/upload/avatar/'.$id;
          if(file_exists($dir)){
            unlink($oldImg);
          }
          if(!file_exists($dir)){
            mkdir($dir);
          }
        }
        Image::make($file)->save(public_path('upload/avatar/'.$id.'/'.$avatar));
      }
    } else {
      $user = $user->update($data);
    }
    if($user){
      return redirect()->back()->with('success', 'Success');
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
    $user = User::findOrFail($id);
    if($user->delete()){
      return redirect()->back()->with('success', 'Delete success');
    } else {
      return redirect()->back()->with('error', 'Delete fails');
    }
  }
}
