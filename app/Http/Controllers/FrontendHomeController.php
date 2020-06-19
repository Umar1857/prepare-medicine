<?php

namespace App\Http\Controllers;

use App\Event;
use App\PlabCourse;
use App\Webinar;
use Illuminate\Http\Request;
use App\Blog;
use App\Course;

class FrontendHomeController extends Controller
{
    function Index () {
    	$blogs = Blog::orderBy('id', 'DESC')->get();
    	$course_list = Course::orderBy('id', 'ASC')->get();
    	$courses = PlabCourse::where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(3)->get();
        $events = Event::where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(3)->get();
        $webinars = Webinar::where('end', '>=', date('Y-m-d H:i:s'))->orderBy('start', 'asc')->take(3)->get();

        return view('frontend.index', compact('blogs', 'course_list', 'courses', 'events', 'webinars'));
    }
}
