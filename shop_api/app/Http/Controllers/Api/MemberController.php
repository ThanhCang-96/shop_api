<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
  private $successStatus = 200;

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
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
      //
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

  protected function doLogin($attempt, $remember){
    if(Auth::attempt($attempt, $remember)){
      return true;
    } else {
      return false;
    }
  }

  public function register(Request $request){
    $data = $request->all();
    $password = $request->password;
    $file = $request->avatar;

    if ($password) {
      $data['password'] = Hash::make($password);
    }

    if ($file) {
      $avatar = time().'_'.$file->getClientOriginalName();
      $data['avatar'] = $avatar;
    }

    if ($member = User::create($data)) {
      $dir = '../public/upload/avatar/'.$member['id'];
      if (!file_exists($dir)) {
        mkdir($dir);
      }
      Image::make($file)->save(public_path($dir.'/'.$data['avatar']));

      return response()->json([
        'member' => $member,
        'response' => 'success'
      ], JsonResponse::HTTP_OK);
    }else{
      \response()->json([
        'errors' => 'errors'
      ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
  }

  public function login(Request $request){
    $login = [
      'email' => $request->email,
      'password' => $request->password,
      'level' => 0
    ];

    $remember = false;
    if ($request->remember) {
      $remember = true;
    }

    if ($this->doLogin($login,$remember)) {
      $member = Auth::user();
      // $success['token'] = $member->createToken('myApp')->accessToken;

      $token = Auth::attempt($login);
      return response()->json([
        'response' => 'success',
        'Auth' => $member,
        'token' => ['token' => $token]
      ],$this->successStatus);
    }else{
      return response()->json([
        'response' => 'error',
        'errors' => ['error'=>'Invalid email or password']
      ]);
    }
  }
}
