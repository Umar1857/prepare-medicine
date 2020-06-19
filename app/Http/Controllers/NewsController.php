<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Services\NewsService;
use Gufy\PdfToHtml\Config;
use Gufy\PdfToHtml\Pdf;
use Illuminate\Http\Request;
use App\News;
//use Spatie\PdfToText\Pdf;
use Illuminate\Support\Facades\Log;
use Validator;
use Carbon\Carbon;
use Auth;

class NewsController extends Controller
{
    public $news_service;

    public function __construct()
    {
        $this->news_service = new NewsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = News::orderBy('id', 'DESC')->paginate(15);
        return view('backend.blog.news', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view
        return view('backend.blog.add-news-post');
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
                $news_path = storage_path('app/public/news');
            } else {
                $news_path = env('STORAGE_PATH').'/news';
            }

            //now check directory
            if (!file_exists($news_path)) {
                mkdir($news_path, 0775, true);
            }

            //now move upload image ok
            $moved = $submitted_image->move($news_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Featured Image Uploading Problem");
            }
        }

        $news_id = News::insertGetId([
            'title'=>$request->title,
            'description'=>$request->description,
            'featured_img'=>$imgName,
            'created_at'=>Carbon::now(),
        ]);


        /* IF Blog Saved Successfully then Add Reference Files */
        if (!empty($news_id) && $request->hasFile('reference_files')) {

            foreach ($request->file('reference_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/news/' . $news_id);
                    } else {
                        $path = env('STORAGE_PATH').'/news/' . $news_id;
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

                $blog = $this->news_service->findById($news_id);

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
        $data = News::where('id', $id)->first();
        if ($data) {
            return view('backend.blog.news-edit', compact('data'));
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
        $data = News::where('id', $id)->first();

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
                    $news_path = storage_path('app/public/news/');
                } else {
                    $news_path = env('STORAGE_PATH').'/news/';
                }

                //now move upload image ok
                $moved = $submitted_image->move($news_path, $img_uniqueName);
                if ($moved) {
                    $imgName = $img_uniqueName;
                }else{
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Featured Image Uploading Problem");
                }

                //first delete img
                $img = public_path('storage/news/'.$data->featured_img);
                if ($img) {
                    unlink(public_path('storage/news/'.$data->featured_img));
                }

                $updated = News::where('id', $id)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'featured_img'=>$imgName,
                    'updated_at'=>Carbon::now(),
                ]);
            } else {
                $updated = News::where('id', $id)->update([
                    'title'=>$request->title,
                    'description'=>$request->description,
                    'updated_at'=>Carbon::now(),
                ]);
            }


            /* IF Blog Saved Successfully then Add Reference Files */
            if (!empty($updated) && $request->hasFile('reference_files')) {

                $news = $this->news_service->findById($id);

                /* Delete files from Directory */
                $files = $news->assets()->pluck('path')->toArray();

                foreach ($files as $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                /* Delete Asset Files */
                $deleted = $news->assets()->delete();

                foreach ($request->file('reference_files') as $file) {
                    if ($file) {
                        $currentTimeDate = Carbon::now()->toDateString();
                        $file_extension = $file->getClientOriginalExtension();
                        $file_original_name = $file->getClientOriginalName();
                        $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                        Log::alert(env('APP_ENV'));
                        //now check directory
                        if (env('APP_ENV') == 'local') {
                            $path = storage_path('app/public/news/' . $id);
                        } else {
                            $path = env('STORAGE_PATH').'/news/' . $id;
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

                    $inserted = $news->assets()->save($asset);

                    if (!$inserted->id) {
                        return redirect()->back()
                            ->with('error', 'SORRY - Something Wrong...');
                    }
                }
            }

            return redirect()->back()
                ->with('success', 'SUCCESS - News Updated');
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
        $data = News::where('id', $id)->first();

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
        $data = News::where('id', $id)->first();
        if ($data) {
            return view('frontend.blog.news-details', compact('data'));
        }else{
            return abort(404);
        }
    }

    public function imageUpload() {

        /*******************************************************
         * Only these origins will be allowed to upload images *
         ******************************************************/
        $accepted_origins = array("http://localhost", "http://preparemedicine.test", "https://preparemedicine.com", "https://plabone.preparemedicine.com");

        /*********************************************
         * Change this line to set the upload folder *
         *********************************************/
        $imageFolder = storage_path('app/public/news/');
        Log::alert($imageFolder);

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
                    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
                } else {
                    header("HTTP/1.1 403 Origin Denied");
                    return;
                }
            }

            /*
              If your script needs to receive cookies, set images_upload_credentials : true in
              the configuration and enable the following two headers.
            */
            // header('Access-Control-Allow-Credentials: true');
            // header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.1 400 Invalid file name.");
                return;
            }

            // Verify extension
            if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
                header("HTTP/1.1 400 Invalid extension.");
                return;
            }

            // Accept upload if there was no origin, or if it is an accepted origin
            $filetowrite = $imageFolder . $temp['name'];
            move_uploaded_file($temp['tmp_name'], $filetowrite);

            Log::alert('complete path: '.$filetowrite);

            // Respond to the successful upload with JSON.
            // Use a location key to specify the path to the saved image resource.
            // { location : '/your/uploaded/image/file'}
            echo json_encode(array('location' => $filetowrite));
        } else {
            // Notify editor that the upload failed
            header("HTTP/1.1 500 Server Error");
        }
    }

    //all blog posts
    // public function blog_posts(){
    //         $blogs = News::orderBy('id', 'DESC')->paginate(30);
    //         return view('frontend.blog.blog-posts', compact('blogs'));

    // }
}
