<?php

namespace App\Http\Controllers;

use App\categoty;
use App\country;
use App\Event;
use App\PlabCourse;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlabCourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = PlabCourse::paginate(30);
        return view('backend.plab2-courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();
        return view('backend.plab2-courses.create', compact('countries', 'categories', 'users'));
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
            'content'=>'nullable',
            'category'=>'required',
            'presenter'=>'required',
            'start'=>'required',
            'end'=>'required',
            'time'=>'required',
            'duration'=>'required',
            'lectures'=>'required',
            'course_type'=>'required',
            'payment_option'=>'required',
            'price'=>'nullable',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'featured_img'=>'required',
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
                $course_path = storage_path('app/public/plab-courses');
            } else {
                $course_path = env('STORAGE_PATH').'/plab-courses';
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

        /* Create Plab Course */
        $course = new PlabCourse();
        $course->title = $request->title;
        $course->description = $request->description;
        $course->content = $request->content;
        $course->category_id = $request->category;
        $course->user_id = $request->presenter;
        $course->start = date('Y-m-d H:i:s', strtotime($request->start));
        $course->end = date('Y-m-d H:i:s', strtotime($request->end));
        $course->time = $request->time;
        $course->duration = $request->duration;
        $course->lectures = $request->lectures;
        $course->is_online = $request->course_type;
        $course->is_paid = $request->payment_option;
        $course->price = $request->price;
        $course->address = $request->address;
        $course->city = $request->city;
        $course->state = $request->state;
        $course->country = $request->country;
        $course->image = $imgName;
        $course->save();

        return redirect()->route('plab-courses.index')->with('success', 'Plab Course has been Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = PlabCourse::find($id);
        $countries = country::all();
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();

        return view('backend.plab2-courses.show', compact('course', 'countries', 'categories', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = PlabCourse::find($id);
        $countries = country::all();
        $categories = categoty::all();
        $users = User::where([
            ['role', '!=', '4'],
            ['role', '>=', '2']])->get();

        return view('backend.plab2-courses.edit', compact('course', 'countries', 'categories', 'users'));
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
            'content'=>'nullable',
            'category'=>'required',
            'presenter'=>'required',
            'start'=>'required',
            'end'=>'required',
            'time'=>'required',
            'duration'=>'required',
            'lectures'=>'required',
            'course_type'=>'required',
            'payment_option'=>'required',
            'price'=>'nullable',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'featured_img'=>'nullable',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        $course = PlabCourse::find($id);

        //make image
        $submitted_image = $request->file('featured_img');
        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $course_path = storage_path('app/public/plab-courses');
            } else {
                $course_path = env('STORAGE_PATH').'/plab-courses';
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

            //first delete img
            $img = public_path('storage/plab-courses/'.$course->image);
            if (file_exists($img)) {
                unlink(public_path('storage/plab-courses/'.$course->image));
            }
        }

        /* Create Plab Course */
        $course->title = $request->title;
        $course->description = $request->description;
        $course->content = $request->content;
        $course->category_id = $request->category;
        $course->user_id = $request->presenter;
        $course->start = date('Y-m-d H:i:s', strtotime($request->start));
        $course->end = date('Y-m-d H:i:s', strtotime($request->end));
        $course->time = $request->time;
        $course->duration = $request->duration;
        $course->lectures = $request->lectures;
        $course->is_online = $request->course_type;
        $course->is_paid = $request->payment_option;
        $course->price = $request->price;
        $course->address = $request->address;
        $course->city = $request->city;
        $course->state = $request->state;
        $course->country = $request->country;
        $course->image = $imgName ? $imgName : $course->image;
        $course->save();

        return redirect()->route('plab-courses.index')->with('success', 'Plab Course has been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = PlabCourse::find($id);

        if (file_exists(public_path('storage/plab-courses/'.$course->image))) {
            unlink(public_path('storage/plab-courses/'.$course->image));
        }
        $course->delete();

        return redirect()->route('plab-courses.index')->with('success', 'Plab Course has been Deleted Successfully!');
    }

    public function getPlabCourses()
    {
        $courses = PlabCourse::where('end', '>=', date('Y-m-d H:i:s'))->with('user')->get();
        $specialities = categoty::all();
        return view('frontend/k-bank/courses/courses', compact('courses', 'specialities'));
    }

    public function getCourseDetail($id)
    {
        $course = PlabCourse::find($id);
        $recentCourses = PlabCourse::where('id','!=',$id)->where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(4)->get();

        return view('frontend/k-bank/courses/courses-details', compact('course', 'recentCourses'));
    }
}
