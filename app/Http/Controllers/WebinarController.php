<?php

namespace App\Http\Controllers;

use App\categoty;
use App\country;
use App\Event;
use App\PlabCourse;
use App\User;
use App\Webinar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebinarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $webinars = Webinar::paginate(30);
        return view('backend.webinar.index', compact('webinars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();
        return view('backend.webinar.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'category'=>'required',
            'presenter'=>'required',
            'start'=>'required',
            'end'=>'required',
            'video'=>'nullable',
            'video_link'=>'nullable',
            'featured_img'=>'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        //make image
        $submitted_image = $request->file('featured_img');
        $submitted_video = $request->file('video');
        $imgName = "";
        $videoName = "";

        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $course_path = storage_path('app/public/webinar');
            } else {
                $course_path = env('STORAGE_PATH').'/webinar';
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

        if (isset($submitted_video)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $video_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_video->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $webinar_path = storage_path('app/public/webinar');
            } else {
                $webinar_path = env('STORAGE_PATH').'/webinar';
            }

            //now check directory
            if (!file_exists($webinar_path)) {
                if (!mkdir($webinar_path, 0775, true) && !is_dir($webinar_path)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $webinar_path));
                }
            }

            //now move upload image ok
            $moved = $submitted_video->move($webinar_path, $video_uniqueName);
            if ($moved) {
                $videoName = $video_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Webinar Video Uploading Problem");
            }
        }

        /* Create Webinar */
        $webinar = new Webinar();
        $webinar->title = $request->title;
        $webinar->description = $request->description;
        $webinar->content = $request->content;
        $webinar->category_id = $request->category;
        $webinar->start = date('Y-m-d H:i:s', strtotime($request->start));
        $webinar->end = date('Y-m-d H:i:s', strtotime($request->end));
        $webinar->video_link = $request->video_link;
        $webinar->video = $videoName;
        $webinar->image = $imgName;
        $webinar->save();

        return redirect()->route('webinars.index')->with('success', 'New Webinar has been Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $webinar = Webinar::find($id);
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();
        return view('backend.webinar.show', compact('categories', 'users', 'webinar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $webinar = Webinar::find($id);
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();

        return view('backend.webinar.edit', compact('webinar', 'categories', 'users'));
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
        $validate = Validator::make($request->all(), [
            'title'=>'required',
            'description'=>'required',
            'content'=>'required',
            'category'=>'required',
            'presenter'=>'required',
            'start'=>'required',
            'end'=>'required',
            'video'=>'nullable',
            'video_link'=>'nullable',
            'featured_img'=>'nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        $webinar = Webinar::find($id);

        //make image
        $submitted_image = $request->file('featured_img');
        $submitted_video = $request->file('video');
        $imgName = "";
        $videoName = "";

        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $webinar_path = storage_path('app/public/webinar');
            } else {
                $webinar_path = env('STORAGE_PATH').'/webinar';
            }

            //now check directory
            if (!file_exists($webinar_path)) {
                if (!mkdir($webinar_path, 0775, true) && !is_dir($webinar_path)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $webinar_path));
                }
            }

            //now move upload image ok
            $moved = $submitted_image->move($webinar_path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Featured Image Uploading Problem");
            }

            //first delete img
            $img = public_path('storage/webinar/'.$webinar->image);
            if (file_exists($img)) {
                unlink(public_path('storage/webinar/'.$webinar->image));
            }
        }

        if (isset($submitted_video)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $video_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_video->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $webinar_path = storage_path('app/public/webinar');
            } else {
                $webinar_path = env('STORAGE_PATH').'/webinar';
            }

            //now check directory
            if (!file_exists($webinar_path)) {
                if (!mkdir($webinar_path, 0775, true) && !is_dir($webinar_path)) {
                    throw new \RuntimeException(sprintf('Directory "%s" was not created', $webinar_path));
                }
            }

            //now move upload image ok
            $moved = $submitted_video->move($webinar_path, $video_uniqueName);
            if ($moved) {
                $videoName = $video_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Webinar Video Uploading Problem");
            }

            //first delete Video
            $img = public_path('storage/webinar/'.$webinar->video);
            if (file_exists($img)) {
                unlink(public_path('storage/webinar/'.$webinar->video));
            }
        }

        /* Create Plab Course */
        $webinar->title = $request->title;
        $webinar->description = $request->description;
        $webinar->content = $request->content;
        $webinar->category_id = $request->category;
        $webinar->start = date('Y-m-d H:i:s', strtotime($request->start));
        $webinar->end = date('Y-m-d H:i:s', strtotime($request->end));
        $webinar->video_link = $request->video_link;
        $webinar->video = $videoName ? $videoName : $webinar->video;
        $webinar->image = $imgName ? $imgName : $webinar->image;
        $webinar->save();

        return redirect()->route('webinars.index')->with('success', 'Webinar has been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $webinar = Webinar::find($id);
        $webinar->delete();

        return redirect()->route('webinars.index')->with('success', 'Webinar has been Deleted Successfully!');
    }

    public function getWebinars()
    {
        $webinars = Webinar::where('end', '>=', date('Y-m-d H:i:s'))->get();
        return view('frontend/k-bank/webinars/webinars', compact('webinars'));
    }

    public function getWebinarDetail($id)
    {
        $webinar = Webinar::find($id);
        $recentWebinars = Webinar::where('id','!=',$id)->where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(4)->get();
        return view('frontend/k-bank/webinars/webinars-details', compact('webinar', 'recentWebinars'));
    }
}
