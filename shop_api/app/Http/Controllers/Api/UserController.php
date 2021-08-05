<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image as Image;

class UserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = User::all()->toArray();
    return response()->json([
      'data' => $data
    ]);
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
  public function show($id)
  {
    //
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
    $data = $request->all();
    $user = User::findOrFail($id);

    // check avatar
    if($request->hasFile('avatar')){
      $file = $request->avatar;
      $avatar = time().'_'.$file->getClientOriginalName();
      $data['avatar'] = $avatar;
    }

    if(!empty($data['password']))
    {
      $data['password'] = Hash::make($data['password']);
    }

    if ($user = $user->update($data)) {
      if (!empty($file)) {
        $dir = '../public/upload/avatar/'.$id;
        if(!file_exists($dir)){
          mkdir($dir);
        }
        // $file->move('../public/upload/avatar/'.$id, $avatar);
        Image::make($file)->save(public_path('upload/avatar/'.$id.'/'.$avatar));
      }
      return response()->json([
        'response' => 'seccess',
        'user' => $user
      ]);
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
      //
  }
}
