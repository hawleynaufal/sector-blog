<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Blog;
use Validator;
use Response;
use Image;
use Storage;
use App\User;
use Carbon\Carbon;

class BlogController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){

       //$blogs= Blog::all();
       //return view('blog.index',['blogs'=>$blogs]);
       $search = \Request::get('search');
       $time =Carbon::now();
       $blogs = Blog::where('title','like','%'.$search.'%')->orderBy('id')->paginate(3);
       return view('blog.index',['blogs'=>$blogs ,'time' => $time ]);

     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new data
        return view('blog.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validation
        $this->validate($request,[
          'title'=>'required',
          'slug'=>'required|alpha_dash',
          'description'=>'required',
          'image' => 'sometimes|image'

        ]);
        //create new data
        $blog = new blog;
        $blog ->title =$request->title;
        $blog ->slug =$request->slug;
        $blog ->description =$request->description;

        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('image/' . $filename);
          Image::make($image)->save($location);

          $blog->image = $filename;
        }

        $blog->save();
        return redirect('blog')->with('message','Post Has been Updated');
    }

    /**
     * Display the specified resource.
     *
     * @param  int   $slug
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $blog= Blog::find($id);
      if(!$blog){
        abort(404);
      }
      return view('blog.details')->with('detailpage',$blog);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        if(!$blog){
          abort(404);
        }
        //return to the edit views
        return view('blog.edit')->with('detailpage',$blog);
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

      $blog = Blog::find($id);
      if ($request->input('slug')== $blog->slug) {
        $this->validate($request,[
          'title'=>'required',
          'description'=>'required',
        ]);
      }else{
        $this->validate($request,[
          'title'=>'required',
          'slug'=>"required|alpha_dash|unique:blog,slug,$id",
          'description'=>'required',
          'image' => 'image',
        ]);
      }
        //validation

        //create new data
        $blog = Blog::find($id);
        $blog ->title =$request->title;
        $blog ->slug =$request->slug;
        $blog ->description =$request->description;

        if ($request->hasfile('image')) {
          //add new database
          $image = $request->file('image') ;
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('image/' . $filename);
          Image::make($image)->save($location);
          $oldFilename = $blog->image;
          //udpate the database
          $blog->image = $filename;
          //Delete the old photo
          Storage::delete($oldFilename);
        }

        $blog ->save();
        return redirect('blog')->with('message','Post has been Edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        //delete data
          $blog = Blog::find($id);
          Storage::delete($blog->image);
          $blog ->delete();
          return redirect('blog')->with('message','Post has been Deleted!');
    }
}
