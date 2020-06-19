<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Services\BlogService;
use Illuminate\Http\Request;
use App\Blog;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

class BlogController extends Controller
{
    public $blog_service;
    public function __construct()
    {
        $this->blog_service = new BlogService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Blog::orderBy('id', 'DESC')->paginate(15);
        return view('backend.blog.blog', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view
        return view('backend.blog.add-blog-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title'=>'required',
            'description'=>'required',
            'featured_img'=>'required',
            'reference_files' => 'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        //make image
        $submitted_image = $request->file('featured_img');
        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $blog_path = storage_path('app/public/blog');
            } else {
                $blog_path = env('STORAGE_PATH').'/blog';
            }

            //now check directory
            if (!file_exists($blog_path)) {
                mkdir($blog_path, 0775, true);
            }

            //now move upload image ok
            $moved = $submitted_image->move($blog_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Featured Image Uploading Problem");
            }
        }

        $blog_id = Blog::insertGetId([
            'title'=>$request->title,
            'description'=>$request->description,
            'featured_img'=>$imgName,
            'created_at'=>Carbon::now(),
        ]);

        /* IF Blog Saved Successfully then Add Reference Files */
        if (!empty($blog_id) && $request->hasFile('reference_files')) {

            foreach ($request->file('reference_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/blog/' . $blog_id);
                    } else {
                        $path = env('STORAGE_PATH').'/blog/' . $blog_id;
                    }

                    if (!file_exists($path)) {
                        if (!mkdir($path, 0775, true) && !is_dir($path)) {
                            throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
                        }
                    }

                    // Now Move the Files to Desired Path
                    $moved = $file->move($path, $file_original_name);
                    if (!$moved) {
                        return redirect()->back()
                            ->withInput()
                            ->with('error', 'Explanation Files Upload Problem');
                    }
                }

                $blog = $this->blog_service->findById($blog_id);

                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $blog->assets()->save($asset);

                if (!$inserted->id) {
                    return redirect()->back()
                        ->with('error', 'SORRY - Something Wrong...');
                }
            }
        }

        return redirect()->back()
            ->with('success', 'SUCCESS - Post Saved');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Blog::where('id', $id)->first();
        if ($data) {
            return view('backend.blog.blog-edit', compact('data'));
        }else{
            return abort(404);
        }

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
        $data = Blog::where('id', $id)->first();

        if ($data) {
            $validate = Validator::make($request->all(),[
                'title'=>'required',
                'description'=>'required',
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'SORRY - Title & Description fields required');
            }

            if ($request->hasFile('featured_img')) {

                //make image
                $submitted_image = $request->file('featured_img');
                $imgName = "";

                $currentTimeDate = Carbon::now()->toDateString();
                $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

                //now check directory
                if (env('APP_ENV') == 'local') {
                    $blog_path = storage_path('app/public/blog');
                } else {
                    $blog_path = env('STORAGE_PATH').'/blog';
                }

                //now move upload image ok
                $moved = $submitted_image->move($blog_path, $img_uniqueName);
                if ($moved) {
                    $imgName = $img_uniqueName;
                }else{
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Featured Image Uploading Problem");
                }

                //first delete img
                $img = public_path('storage/blog/'.$data->featured_img);
                if (file_exists($img)) {
                    unlink(public_path('storage/blog/'.$data->featured_img));
                }

                $updated = Blog::where('id', $id)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'featured_img'=>$imgName,
                    'updated_at'=>Carbon::now(),
                ]);
            } else{
                $updated = Blog::where('id', $id)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'updated_at'=>Carbon::now(),
                ]);
            }

            /* IF Blog Saved Successfully then Add Reference Files */
            if (!empty($updated) && $request->hasFile('reference_files')) {

                $blog = $this->blog_service->findById($id);

                /* Delete files from Directory */
                $files = $blog->assets()->pluck('path')->toArray();

                foreach ($files as $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                /* Delete Asset Files */
                $deleted = $blog->assets()->delete();


                foreach ($request->file('reference_files') as $file) {
                    if ($file) {
                        $currentTimeDate = Carbon::now()->toDateString();
                        $file_extension = $file->getClientOriginalExtension();
                        $file_original_name = $file->getClientOriginalName();
                        $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                        //now check directory
                        if (env('APP_ENV') == 'local') {
                            $path = storage_path('app/public/blog/' . $id);
                        } else {
                            $path = env('STORAGE_PATH').'/blog/' . $id;
                        }

                        if (!file_exists($path)) {
                            if (!mkdir($path, 0775, true) && !is_dir($path)) {
                                throw new \RuntimeException(sprintf('Directory "%s" was not created', $path));
                            }
                        }

                        // Now Move the Files to Desired Path
                        $moved = $file->move($path, $file_original_name);
                        if (!$moved) {
                            return redirect()->back()
                                ->withInput()
                                ->with('error', 'Explanation Files Upload Problem');
                        }
                    }

                    $asset = new Asset();
                    $asset->name = $file_original_name;
                    $asset->path = $path . '/' . $file_original_name;
                    $asset->type = $file_extension;

                    $inserted = $blog->assets()->save($asset);

                    if (!$inserted->id) {
                        return redirect()->back()
                            ->with('error', 'SORRY - Something Wrong...');
                    }
                }
            }

            return redirect()->back()
                ->with('success', 'SUCCESS - Post Updated!');
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
        $data = Blog::where('id', $id)->first();

        if ($data) {
            $img = public_path('storage/blog/'.$data->featured_img);

            if (file_exists($img)) {
                unlink(public_path('storage/blog/'.$data->featured_img));
            }

            $deleted = $data->delete();
            if ($deleted == true) {
                return redirect()->back()
                    ->with('success', 'SUCCESS - Post Deleted');
            }else{
                return redirect()->back()
                    ->with('error', 'SORRY - Something Wrong');
            }
        }else{
            return abort(404);
        }

    }




    //for frontned
    public function details($id){

        if(!Auth::check()){
            return redirect()->route('login');
        }elseif(Auth::user()->role == 1  || Auth::user()->role == 4){
            //no access non verified users / as admin
            return back();
        }elseif(Auth::user()->role == 7 || Auth::user()->role == 8){
            //only for advanced and professional plan
            $data = Blog::where('id', $id)->first();
            $files = $data->assets()->get();
            if ($data) {
                return view('frontend.blog.blog-details', compact('data', 'files'));
            }else{
                return abort(404);
            }

        }else{
            //
            return redirect()->back()
                ->with('no_access_permission__', 'You can not access, please upgrade your plan');
        }

    }

    //all blog posts
    public function blog_posts(){

        if(!Auth::check()){
            return redirect()->route('login');
        }elseif(Auth::user()->role == 1  || Auth::user()->role == 4){
            //no access non verified users / as admin
            return back();
        }elseif(Auth::user()->role == 7 || Auth::user()->role == 8){
            //only for advanced and professional plan
            $blogs = Blog::orderBy('id', 'DESC')->paginate(30);
            return view('frontend.blog.blog-posts', compact('blogs'));

        }else{
            //
            return redirect()->back()
                ->with('no_access_permission__', 'You can not access, please upgrade your plan');
        }

    }
}
