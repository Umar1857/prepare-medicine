<?php

namespace App\Http\Controllers;

use App\categoty;
use App\Ibank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Ibank::where('type','video')->paginate(30);
        return view('backend.video-bank.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categoty::all();
        return view('backend.video-bank.create', compact('categories'));
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
            'category'=>'required',
            'description'=>'required',
            'video'=>'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('video');

        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $path = public_path('storage/video-bank');
            } else {
                $path = env('STORAGE_PATH').'/video-bank';
            }

            //now check directory
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }

            //now move upload image ok
            $moved = $submitted_image->move($path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Picture Uploading Problem");
            }
        }

        $image_id = Ibank::insertGetId([
            'title'=>$request->title,
            'type'=>'video',
            'description'=>$request->description,
            'category_id'=>$request->category,
            'image'=>$imgName,
            'created_at' => Carbon::now(),
        ]);

        if ($image_id) {
            return redirect()->route('video-bank.index')
                ->with('success', 'SUCCESS - Video Has Been Saved Successfully!');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Ibank::find($id);
        $categories = categoty::all();

        return view('backend.video-bank.edit', compact('video', 'categories'));
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
        $validate = Validator::make($request->all(),[
            'title'=>'required',
            'category'=>'required',
            'description'=>'required',
            'video'=>'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('video');
        $imgName = "";

        /* Find */
        $image = Ibank::find($id);

        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $path = public_path('storage/video-bank');
            } else {
                $path = env('STORAGE_PATH').'/video-bank';
            }

            //now check directory
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }

            /* Delete File before Uploading New */
            if (file_exists($path . '/' . $image->image)) {
                unlink($path . '/' . $image->image);
            }

            //now move upload image ok
            $moved = $submitted_image->move($path, $img_uniqueName);
            if ($moved) {
                $imgName = $img_uniqueName;
            }else{
                return redirect()->back()
                    ->withInput()
                    ->with('error', "Picture Uploading Problem");
            }
        }

        $image->title = $request->title;
        $image->type = 'video';
        $image->description = $request->description;
        $image->category_id = $request->category;
        $image->image = !empty($imgName) ? $imgName : $image->image;
        $image->save();

        return redirect()->route('video-bank.index')
            ->with('success', 'SUCCESS - Video Details Has Been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Ibank::find($id);
        if (file_exists(public_path('storage/video-bank/'.$image->image))) {
            unlink(public_path('storage/video-bank/'.$image->image));
        }
        $image->delete();

        return redirect()->route('video-bank.index')
            ->with('success', 'SUCCESS - Video Has Been Deleted Successfully!');
    }

    public function videoBank() {
        $data = categoty::orderBy('id', 'ASC')
            ->paginate(30);

        return view('frontend.i-bank.video-bank.video-bank',['data'=>$data]);
    }

    public function videoBankGallery($id) {
        $videos = Ibank::where(['type' => 'video', 'category_id' => $id])->get();
        return view('frontend/i-bank/video-bank/video-bank-gallery', compact('videos'));
    }

    public function videoBankGalleryDetail($id) {
        $video = Ibank::find($id);
        return view('frontend/i-bank/video-bank/video-bank-gallery-detail', compact('video'));
    }
}
