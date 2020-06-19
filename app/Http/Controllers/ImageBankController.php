<?php

namespace App\Http\Controllers;

use App\categoty;
use App\Ibank;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImageBankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Ibank::where('type','image')->paginate(30);
        return view('backend.image-bank.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = categoty::all();
        return view('backend.image-bank.create', compact('categories'));
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
            'image'=>'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('image');

        $imgName = "";
        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $path = public_path('storage/image-bank');
            } else {
                $path = env('STORAGE_PATH').'/image-bank';
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
            'type'=>'image',
            'description'=>$request->description,
            'category_id'=>$request->category,
            'image'=>$imgName,
            'created_at' => Carbon::now(),
        ]);

        if ($image_id) {
            return redirect()->route('image-bank.index')
                ->with('success', 'SUCCESS - Image Has Been Saved Successfully!');
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
        $image = Ibank::find($id);
        $categories = categoty::all();

        return view('backend.image-bank.edit', compact('image', 'categories'));
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
            'image'=>'nullable'
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validate);
        }

        //make image
        $submitted_image = $request->file('image');
        $imgName = "";

        /* Find */
        $image = Ibank::find($id);

        if (isset($submitted_image)) {
            $currentTimeDate = Carbon::now()->toDateString();
            $img_uniqueName = $currentTimeDate.'-'.uniqid().'.'.$submitted_image->getClientOriginalExtension();

            //now check directory
            if (env('APP_ENV') == 'local') {
                $path = public_path('storage/image-bank');
            } else {
                $path = env('STORAGE_PATH').'/image-bank';
            }

            //now check directory
            if (!file_exists($path)) {
                mkdir($path, 0775, true);
            }

            /* Delete File before Uploading New */
            if (file_exists($path.'/'.$image->image)) {
                unlink($path.'/'.$image->image);
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
        $image->type = 'image';
        $image->description = $request->description;
        $image->category_id = $request->category;
        $image->image = !empty($imgName) ? $imgName : $image->image;
        $image->save();

        return redirect()->route('image-bank.index')
            ->with('success', 'SUCCESS - Image Details Has Been Updated Successfully!');
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

        if (file_exists(public_path('storage/image-bank/'.$image->image))) {
            unlink(public_path('storage/image-bank/'.$image->image));
        }
        $image->delete();

        return redirect()->route('image-bank.index')
            ->with('success', 'SUCCESS - Image Has Been Deleted Successfully!');
    }

    public function imageBank() {
        $data = categoty::orderBy('id', 'ASC')
            ->paginate(30);

        return view('frontend.i-bank.image-bank.image-bank',['data'=>$data]);
    }

    public function imageBankGallery($id) {
        $images = Ibank::where(['type' => 'image', 'category_id' => $id])->get();
        return view('frontend/i-bank/image-bank/image-bank-gallery', compact('images'));
    }

    public function imageBankGalleryDetail($id) {
        $image = Ibank::find($id);
        return view('frontend/i-bank/image-bank/image-bank-gallery-detail', compact('image'));
    }
}
