<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Country::all()->toArray();
      if($data){
        return response()->json([
          'data'=> $data
        ]);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CountryRequest $request)
    {
      $getCountryName = $request->name;
      if($country = Country::create([
        'name' => $getCountryName
      ])){
        return response()->json([
          'response' => 'success',
          'data' => $country,
        ], $this->successStatus);
      }
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
    public function update(CountryRequest $request, $id)
    {
      $getCountry = Country::findOrFail($id);
      $data = $request->all();
      if($country = $getCountry->update($data))
      {
        return response()->json([
          'response' => 'seccess',
          'data' => $country
        ], $this->successStatus);
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
      $country = Country::findOrFail($id);
      if($status = $country->delete())
      {
        return response()->json([
          'response' => 'succsess',
          'status' => $status
        ], $this->successStatus);
      } else {
        response()->json([
          'response' => 'Fails',
          'status' => '$status'
        ]);
      }
    }
}
