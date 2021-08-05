<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class BlogController extends Controller
{
    public $successStatus = 200;

    private function delImg($url){
      if (file_exists(public_path($url))) {
        unlink(public_path($url));
      }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = Blog::all()->toArray();
      if($data){
        return response()->json([
          'data' => $data
        ], $this->successStatus);
      }
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
      if ($request->hasFile('image')) {
        $image = $request->image;
        $data['image'] = $image->getClientOriginalName();
      }
      if (!empty($data)) {
        if ($blog = Blog::create($data)) {

          // create folder for blog
          $dir = "../public/upload/blog";
          if(!file_exists($dir)){
            mkdir($dir);
          }
          Image::make($image)->save(public_path('upload/blog/'.$data['image']));

          return response()->json([
            'blog' => $blog
          ], );
        }
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
    public function update(Request $request, $id)
    {
      $blog = Blog::findOrFail($id);
      $data = $request->all();
      
      if ($request->hasFile('image')) {
        $oldImg = $blog->image;
        $srcImg = 'upload/blog/'.$oldImg;
        $image = $request->image;
        $data['image'] = $image->getClientOriginalName();
      }

      if (!empty($data)) {
        if($status = $blog->update($data)){
          $this->delImg($srcImg);
          image::make($image)->save(\public_path('upload/blog/'.$data['image']));
          return response()->json([
            'response' => 'success',
            'blog' => $status
          ]);
        }
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
      $blog = Blog::findOrFail($id);
      $src = 'upload/blog/'.$blog->image;
      if ($blog->delete()) {
        $this->delImg($src);
        return response()->json([
          'response' => 'success'
        ]);
      }
    }
}
