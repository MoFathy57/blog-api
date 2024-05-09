<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{

    // web functions
    public function index(){
        if(request()->ajax()){
            return datatables()->of(Blog::select('*'))
            ->editColumn('image', function(Blog $blog) {
                return '<img src="'. $blog->image.'" width="60px" />';
            })
            ->editColumn('status', function(Blog $blog) {
                return $blog->status ? '<button class="btn btn-success">Active</button>': '<button class="btn btn-success">Not Active</button>';
            })
            ->addColumn('actions', 'table-actions')
            ->rawColumns(['image','status','actions'])
            ->addIndexColumn()
            ->make();
        };
        return view('blogs');
    }

    public function store(StoreBlogRequest $request)
    {
        $blogId = $request->blogid;

        if($request->file('image')){
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
        }elseif($blogId){
            $filename = Blog::find($blogId)->image;
        }else{
            $filename = '';
        }

        Blog::updateOrCreate(['id'=>$blogId],[
            'title' => $request->title,
            'body' => $request->body,
            'image' => $filename,
            'publish_date' => $request->publish_date
        ]);

        return response()->json([
            'message' => 'Blog added successfully.',
        ], 200);
    }


    public function edit(Blog $blog)
    {
        return Response()->json($blog);
    }


    public function destroy(Blog $blog)
    {
        File::delete(asset('images'.'/'.$blog->image));
        $blog->delete();
        return response()->json([
            'message' => 'Blog deleted successfully.',
        ]);
    }

    //api fumctions
    public function posts(){

        return response()->json([
            'success' => true,
            'posts' => Blog::latest()->get()
        ]);
    }

    public function post($id){
        try {
            $blog = Blog::find($id);
            return response()->json([
                'success' => true,
                'post' => $blog
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'no posts found'
            ]);
        }
    }
}
