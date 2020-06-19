<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Services\CourseService;
use Illuminate\Http\Request;
use App\Course;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class CourseController extends Controller
{
    public $course_service;

    public function __construct()
    {
        $this->course_service = new CourseService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Course::orderBy('id', 'DESC')->paginate(15);
        return view('backend.course.course', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view
        return view('backend.course.add-course-post');
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
                $course_path = storage_path('app/public/course');
            } else {
                $course_path = env('STORAGE_PATH').'/course';
            }

            //now check directory
            if (!file_exists($course_path)) {
                if (!mkdir($course_path, 0775, true) && !is_dir($course_path)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $course_path));
                }
            }

            //now move upload image ok
            $moved = $submitted_image->move($course_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Featured Image Uploading Problem");
            }
        }

        $course_id = Course::insertGetId([
            'title'=>$request->title,
            'duration'=>$request->duration,
            'description'=>$request->description,
            'featured_img'=>$imgName,
            'created_at'=>Carbon::now(),
        ]);


        /* IF Question Saved Successfully then Add Asset Files */
        if (!empty($course_id) && $request->hasFile('reference_files')) {

            foreach ($request->file('reference_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/course/' . $course_id);
                    } else {
                        $path = env('STORAGE_PATH').'/course/' . $course_id;
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

                $course = $this->course_service->findById($course_id);

                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $course->assets()->save($asset);

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
        $data = Course::where('id', $id)->first();
        if ($data) {
            return view('backend.course.course-edit', compact('data'));
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
        $data = Course::where('id', $id)->first();

        if ($data) {
            $validate = Validator::make($request->all(),[
                'title'=>'required',
                'description'=>'required',
            ]);

            if ($validate->fails()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'SORRY - Title, Duration & Description fields required');
            }

            if ($request->hasFile('featured_img')) {

                //make image
                $submitted_image = $request->file('featured_img');
                $imgName = "";

                $currentTimeDate = Carbon::now()->toDateString();
                $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

                //now check directory
                if (env('APP_ENV') == 'local') {
                    $course_path = storage_path('app/public/course');
                } else {
                    $course_path = env('STORAGE_PATH').'/course';
                }

                //now move upload image ok
                $moved = $submitted_image->move($course_path, $img_uniqueName);
                if ($moved) {
                    $imgName = $img_uniqueName;
                }else{
                    return redirect()->back()
                        ->withInput()
                        ->with('error', "Featured Image Uploading Problem");
                }

                //first delete img
                $img = public_path('storage/course/'.$data->featured_img);
                if (file_exists($img)) {
                    unlink(public_path('storage/course/'.$data->featured_img));
                }

                $updated = Course::where('id', $id)->update([
                    'title'=>$request->title,
                    'duration'=>$request->duration,
                    'description'=>$request->description,
                    'featured_img'=>$imgName,
                    'updated_at'=>Carbon::now(),
                ]);
            } else {
                $updated = Course::where('id', $id)->update([
                    'title'=>$request->title,
                    'duration'=>$request->duration,
                    'description'=>$request->description,
                    'updated_at'=>Carbon::now(),
                ]);
            }


            /* IF Blog Saved Successfully then Add Reference Files */
            if (!empty($updated) && $request->hasFile('reference_files')) {

                $course = $this->course_service->findById($id);

                /* Delete files from Directory */
                $files = $course->assets()->pluck('path')->toArray();

                foreach ($files as $file) {
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }

                /* Delete Asset Files */
                $deleted = $course->assets()->delete();


                foreach ($request->file('reference_files') as $file) {
                    if ($file) {
                        $currentTimeDate = Carbon::now()->toDateString();
                        $file_extension = $file->getClientOriginalExtension();
                        $file_original_name = $file->getClientOriginalName();
                        $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                        //now check directory
                        if (env('APP_ENV') == 'local') {
                            $path = storage_path('app/public/course/' . $id);
                        } else {
                            $path = env('STORAGE_PATH').'/course/' . $id;
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

                    $inserted = $course->assets()->save($asset);

                    if (!$inserted->id) {
                        return redirect()->back()
                            ->with('error', 'SORRY - Something Wrong...');
                    }
                }
            }

            return redirect()->back()
                ->with('success', 'SUCCESS - Post Saved');
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
        $data = Course::where('id', $id)->first();

        if ($data) {
            $img = public_path('storage/course/'.$data->featured_img);

            if (file_exists($img)) {
                unlink(public_path('storage/course/'.$data->featured_img));
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
    public function details($id) {
        $data = Course::where('id', $id)->first();
        $files = $data->assets()->get();
        if ($data) {
            return view('frontend.course.course-details', compact('data', 'files'));
        }else{
            return abort(404);
        }

    }

    //get courses all
    public function get_course_list(){
        $course_list = Course::orderBy('id', 'DESC')->paginate(30);
        return view('frontend.course.course-list', compact('course_list'));
    }
}
