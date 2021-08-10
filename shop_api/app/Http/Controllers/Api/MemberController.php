<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class MemberController extends Controller
{
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
}
