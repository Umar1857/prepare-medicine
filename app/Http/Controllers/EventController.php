<?php

namespace App\Http\Controllers;

use App\categoty;
use App\country;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(30);
        return view('backend.plab1-events.index', compact('events'));
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
        return view('backend.plab1-events.create', compact('countries', 'categories'));
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
            'start'=>'required',
            'end'=>'required',
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
                $course_path = storage_path('app/public/events');
            } else {
                $course_path = env('STORAGE_PATH').'/events';
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

        /* Create Event */
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->content = $request->content;
        $event->category_id = $request->category;
        $event->start = date('Y-m-d H:i:s', strtotime($request->start));
        $event->end = date('Y-m-d H:i:s', strtotime($request->end));
        $event->address = $request->address;
        $event->city = $request->city;
        $event->state = $request->state;
        $event->country = $request->country;
        $event->image = $imgName;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event has been Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $countries = country::all();
        $categories = categoty::all();

        return view('backend.plab1-events.show', compact('event', 'countries', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $countries = country::all();
        $categories = categoty::all();

        return view('backend.plab1-events.edit', compact('event', 'countries', 'categories'));
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
            'start'=>'required',
            'end'=>'required',
            'address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'SORRY - Please fill out all fields');
        }

        $event = Event::find($id);

        //make image
        $submitted_image = $request->file('featured_img');
        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $course_path = storage_path('app/public/events');
            } else {
                $course_path = env('STORAGE_PATH').'/events';
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
            $img = public_path('storage/events/'.$event->image);

            if (file_exists($img)) {
                unlink('storage/events/'.$event->image);
            }
        }

        /* Create Event */
        $event->title = $request->title;
        $event->description = $request->description;
        $event->content = $request->content;
        $event->category_id = $request->category;
        $event->start = date('Y-m-d H:i:s', strtotime($request->start));
        $event->end = date('Y-m-d H:i:s', strtotime($request->end));
        $event->address = $request->address;
        $event->city = $request->city;
        $event->state = $request->state;
        $event->country = $request->country;
        $event->image = $imgName ? $imgName : $event->image;
        $event->save();

        return redirect()->route('events.index')->with('success', 'Event has been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        $img = public_path('storage/events/'.$event->image);

        if (file_exists($img)) {
            unlink(public_path('storage/events/'.$event->image));
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event has been Deleted Successfully!');
    }

    public function getEvents()
    {
        $events = Event::where('end', '>=', date('Y-m-d H:i:s'))->get();
        return view('frontend/k-bank/events/events', compact('events'));
    }

    public function getEventDetail($id)
    {
        $event = Event::find($id);
        $recentEvents = Event::where('id','!=',$id)->where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(4)->get();
        return view('frontend/k-bank/events/events-details', compact('event', 'recentEvents'));
    }
}
