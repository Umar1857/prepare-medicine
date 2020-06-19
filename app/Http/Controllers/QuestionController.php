<?php

namespace App\Http\Controllers;

use App\answer;
use App\Asset;
use App\Blog;
use App\categoty;
use App\Imports\QuestionImport;
use App\question;
use App\Services\QuestionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    private $question_service;
    public function __construct()
    {
        $this->question_service = new QuestionService();
    }

    function SingleIndex(){

        $category = categoty::select('id', 'cat_id', 'name')->where('status', true)->get();
        $data = question::select()->where('type','0')->where('status','0')->paginate(30);
        return view('backend.question',['data'=>$data,'categories'=>$category]);
    }

    function AddSingle(){

        $category = categoty::select()->get();
        return view('backend.add-question',['category'=>$category]);
    }

    function Single(Request $request){

//        dd($request->all());
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'question' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
            'ans' => 'required',
            'asset_files' => 'nullable'
        ]);

//|mimetypes:image/jpeg,image/jpg,image/png,application/pdf,video/mp4

        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        /*foreach ($request->ans as $key => $value) {
            if ($value == null || empty($value)) {
                return back()->withErrors('Fillup all answer fields !!');
            }
        }*/

        if($request->explanation == null || empty($request->explanation) ){

            /* Store Question */
            $que_id = question::insertGetId([
                'question' => $request->question,
                'cat_id' => $request->category,
                'ans' => $request->answer,
                'explanation' => $request->explanation,
                'hint' => $request->hint,
                'search_id' => $request->question_id ? $request->question_id : substr(categoty::findOrFail($request->category)->name,0,3).time(),
            ]);

            /* Store answers */
            foreach ($request->ans as $key => $value) {
                answer::insert([
                    'ans' => $value,
                    'answer' => $key,
                    'ques_id' => $que_id,
                ]);
            }
        } else {
            $que_id = question::insertGetId([
                'question' => $request->question,
                'cat_id' => $request->category,
                // 'subcat_id' => $request->category,
                'ans' => $request->answer,
                'hint' => $request->hint,
                'explanation' => $request->explanation,
                'search_id' => $request->question_id ? $request->question_id : substr(categoty::findOrFail($request->category)->name,0,3).time(),
            ]);

            foreach ($request->ans as $key => $value) {
                answer::insert([
                    'ans' => $value,
                    'answer' => $key,
                    'ques_id' => $que_id,
                ]);
            }
        }

        /* IF Question Saved Successfully then Add Asset Files */
        if (!empty($que_id) && $request->hasFile('asset_files')) {

            foreach ($request->file('asset_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/questions/' . $que_id);
                    } else {
                        $path = env('STORAGE_PATH').'/questions/' . $que_id;
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

                $question = $this->question_service->findById($que_id);

                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $question->assets()->save($asset);

                if (!$inserted->id) {
                    return redirect()->back()
                        ->with('error', 'SORRY - Something Wrong...');
                }
            }
        }
        return back()->withSuccess('Question successfully added !!');
    }

    function getEditSingle($id) {
        $category = categoty::select()->get();
        $data = question::where('id', $id)->first();

        return view('backend.edit-question',['item'=>$data,'category'=>$category]);
    }

    function EditSingle(Request $request){

        /* Validate Values */
        $request->validate([
            'category' => 'required',
            'question' => 'required',
            'answer' => 'required',
            'ans' => 'required',
            'id' => 'required',
            'search_id' => 'required',
            'asset_files' => 'nullable'
        ]);


        foreach ($request->ans as $key => $value) {
            if ($value == null || empty($value)) {
                return back()->withErrors('Fillup all answer fields !!');
            }
        }

        if($request->explanation == null || empty($request->explanation) ) {
            question::findOrFail($request->id)->update([
                'question' => $request->question,
                'cat_id' => $request->category,
                'ans' => $request->answer,
                'explanation' => $request->explanation,
                'hint' => $request->hint,
                'search_id' => $request->search_id,
            ]);

            foreach (question::findOrFail($request->id)->question_ans as $keys => $item) {
                $ans_id = $item->id;
                foreach ($request->ans as $key => $value) {
                    if ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys){
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }
                }
            }
        }else{
            question::findOrFail($request->id)->update([
                'question' => $request->question,
                'cat_id' => $request->category,
                'ans' => $request->answer,
                'hint' => $request->hint,
                'explanation' => $request->explanation,
                'search_id' => $request->search_id,
            ]);

            foreach (question::findOrFail($request->id)->question_ans as $keys => $item) {
                $ans_id = $item->id;
                foreach ($request->ans as $key => $value) {
                    if ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys){
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }
                }
            }
        }

        /* IF Question Saved Successfully then Add Asset Files */
        if ($request->hasFile('asset_files')) {

            $question = $this->question_service->findById($request->id);

            /* Delete files from Directory */
            $files = $question->assets()->pluck('path')->toArray();
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            /* Delete Asset Files */
            $deleted = $question->assets()->delete();

            foreach ($request->file('asset_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/questions/' . $request->id);
                    } else {
                        $path = env('STORAGE_PATH').'/questions/' . $request->id;
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

                /* Add Asset Files back in */
                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $question->assets()->save($asset);

                if (!$inserted->id) {
                    return redirect()->back()
                        ->with('error', 'SORRY - Something Wrong...');
                }
            }
        }
        return back()->withSuccess('Question successfully updated !!');
    }

    // Multiple question's function


    function MultiIndex(){

        $category = categoty::select()->get();
        $data = question::select()->where('type','1')->where('status','0')->paginate(30);
        return view('backend.multi-question',['data'=>$data,'categories'=>$category]);
    }

    function AddMulti(){

        $category = categoty::select()->get();
        return view('backend.add-multi-question',['category'=>$category]);
    }

    function Multi(Request $request){

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'question' => 'required',
            'question_id' => 'required',
            'answer' => 'required|min:1',
            'ans' => 'required|min:1',
            'asset_files' => 'nullable'
        ]);

//|mimetypes:image/jpeg,image/jpg,image/png,application/pdf,video/mp4

        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }

        if($request->explanation == null || empty($request->explanation) ){
            $que_id = question::insertGetId([
                'question' => $request->question,
                'cat_id' => $request->category,
                // 'subcat_id' => $request->category,
                'ans' => $answer,
                'explanation' => $request->explanation,
                'hint' => $request->hint,
                'search_id' => $request->question_id ? $request->question_id : substr(categoty::findOrFail($request->category)->name,0,3).time(),
                'type' => '1',
            ]);
            foreach ($request->ans as $key => $value) {
                answer::insert([
                    'ans' => $value,
                    'answer' => $key,
                    'ques_id' => $que_id,
                ]);
            }
        }else{
            $que_id = question::insertGetId([
                'question' => $request->question,
                'cat_id' => $request->category,
                // 'subcat_id' => $request->category,
                'ans' => $answer,
                'hint' => $request->hint,
                'explanation' => $request->explanation,
                'search_id' => $request->question_id ? $request->question_id : substr(categoty::findOrFail($request->category)->name,0,3).time(),
                'type' => '1',
            ]);
            foreach ($request->ans as $key => $value) {
                answer::insert([
                    'ans' => $value,
                    'answer' => $key,
                    'ques_id' => $que_id,
                ]);
            }
        }

        /* IF Question Saved Successfully then Add Asset Files */
        if (!empty($que_id) && $request->hasFile('asset_files')) {

            foreach ($request->file('asset_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/questions/' . $que_id);
                    } else {
                        $path = env('STORAGE_PATH').'/questions/' . $que_id;
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

                $question = $this->question_service->findById($que_id);

                /* Add Asset Files */
                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $question->assets()->save($asset);

                if (!$inserted->id) {
                    return redirect()->back()
                        ->with('error', 'SORRY - Something Wrong...');
                }
            }
        }
        return back()->withSuccess('Question successfully added !!');
    }

    function getEditMulti($id) {

        $category = categoty::select()->get();
        $item = question::where('id', $id)->first();
        return view('backend.edit-multi-question',['item'=>$item,'category'=>$category]);

    }

    function EditMulti(Request $request) {

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'question' => 'required',
            'answer' => 'required|min:1',
            'ans' => 'required|min:1',
            'id' => 'required',
            'search_id' => 'required',
            'asset_files' => 'nullable'
        ]);

        //|mimetypes:image/jpeg,image/jpg,image/png,application/pdf,video/mp4

        if($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        $answer = null;
        foreach ($request->answer as $key => $value) {
            $answer .= $value.'-';
        }

        if($request->explanation == null || empty($request->explanation) ){
            question::findOrFail($request->id)->update([
                'question' => $request->question,
                'cat_id' => $request->category,
                'ans' => $answer,
                'explanation' => $request->explanation,
                'hint' => $request->hint,
                'search_id' => $request->search_id,
            ]);

            foreach (question::findOrFail($request->id)->question_ans as $keys => $item) {
                $ans_id = $item->id;
                foreach ($request->ans as $key => $value) {
                    if ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys){
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }
                }
            }
        } else {
            question::findOrFail($request->id)->update([
                'question' => $request->question,
                'cat_id' => $request->category,
                'ans' => $answer,
                'hint' => $request->hint,
                'explanation' => $request->explanation,
                'search_id' => $request->search_id,
            ]);

            foreach (question::findOrFail($request->id)->question_ans as $keys => $item) {
                $ans_id = $item->id;
                foreach ($request->ans as $key => $value) {
                    if ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys) {
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }elseif ($key == $keys){
                        answer::findOrFail($ans_id)->update([
                            'ans' => $value,
                            'answer' => $key,
                            'ques_id' => $request->id,
                        ]);
                    }
                }
            }
        }

        /* IF Question Saved Successfully then Add Asset Files */
        if ($request->hasFile('asset_files')) {

            $question = $this->question_service->findById($request->id);

            /* Delete files from Directory */
            $files = $question->assets()->pluck('path')->toArray();
            foreach ($files as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            /* Delete Asset Files */
            $deleted = $question->assets()->delete();

            foreach ($request->file('asset_files') as $file) {
                if ($file) {
                    $currentTimeDate = Carbon::now()->toDateString();
                    $file_extension = $file->getClientOriginalExtension();
                    $file_original_name = $file->getClientOriginalName();
                    $file_name = $currentTimeDate . '-' . uniqid() . '.' . $file_extension;

                    //now check directory
                    if (env('APP_ENV') == 'local') {
                        $path = storage_path('app/public/questions/' . $request->id);
                    } else {
                        $path = env('STORAGE_PATH').'/questions/' . $request->id;
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

                /* Add Asset Files back in */
                $asset = new Asset();
                $asset->name = $file_original_name;
                $asset->path = $path . '/' . $file_original_name;
                $asset->type = $file_extension;

                $inserted = $question->assets()->save($asset);

                if (!$inserted->id) {
                    return redirect()->back()
                        ->with('error', 'SORRY - Something Wrong...');
                }
            }
        }

        return back()->withSuccess('Question successfully updated !!');
    }

    function DropQuestion($id){

        question::where('id',$id)->delete();
        answer::where('ques_id',$id)->delete();
        return redirect()->back()->with('success', 'Question has been deleted Successfully!');
    }

    function ImportQuestion(Request $request){

        $request->validate([
            'excel' => "required"
        ]);
        $path = $request->file('excel');
        $rows = Excel::toArray(new QuestionImport, $path);

        foreach($rows as $key => $item){
            foreach($item as $key => $value){
                if ($key == '0'){
                    continue;
                }else{
                    if( $value[1] != null){

                        //change 12345 to abcde
                        $main_ans = strtolower($value[2]);
                        $main_ans = str_replace('a','0',strtolower($main_ans));
                        $main_ans = str_replace('b','1',strtolower($main_ans));
                        $main_ans = str_replace('c','2',strtolower($main_ans));
                        $main_ans = str_replace('d','3',strtolower($main_ans));
                        $main_ans = str_replace('e','4',strtolower($main_ans));

                        if( strlen($main_ans) == "1" ){
                            //there have to write my code for single choice question !!
                            $que_id = question::insertGetId([
                                'question' => $value[0],
                                'cat_id' => is_int($value[1]) ? $value[1] : categoty::where('name', strtoupper($value[1]))->first()->id,
                                'ans' => $main_ans,
                                'explanation' => $value[3],
                                'hint' => $value[4],
                                'search_id' => $value[5] ? $value[5] : substr(categoty::findOrFail($value[1])->name,0,3).(time()*rand(1,999)),
                            ]);
                            for($i=6,$y=0;$i<=10;$i++,$y++){
                                answer::insert([
                                    'ans' => $value[$i],
                                    'answer' => $y,
                                    'ques_id' => $que_id,
                                ]);
                            }
                        }else{
                            //there have to write my code multi choice question !!
                            $que_id = question::insertGetId([
                                'question' => $value[0],
                                'cat_id' => is_int($value[1]) ? $value[1] : categoty::where('name', strtoupper($value[1]))->first()->id,
                                'ans' => $main_ans,
                                'explanation' => $value[3],
                                'hint' => $value[4],
                                'search_id' => $value[5] ? $value[5] : substr(categoty::findOrFail($value[1])->name,0,3).(time()*rand(1,999)),
                                'type' => "1",
                            ]);
                            for($i=5,$y=0;$i<=9;$i++,$y++){
                                answer::insert([
                                    'ans' => $value[$i],
                                    'answer' => $y,
                                    'ques_id' => $que_id,
                                ]);
                            }
                        }

                    }else{
                        return back();
                    }
                }
            }
            return redirect()->back()->with('success', 'Questions have been Imported Successfully!');
        }

    }
    function select(Request $request) {
        if(empty($request->select)){
            return back();
        }
        question::whereIn('id',$request->select)->delete();
        answer::whereIn('ques_id',$request->select)->delete();
        return redirect()->back()->with('success','Questions have been Deleted Successfully!');
    }

    function FilterSingle(Request $request) {
        if(empty($request->sear_key) && empty($request->category)){
            return back();
        }

        if ($request->sear_id == 'cat') {

            if(empty( categoty::where('name', 'LIKE', "%{$request->sear_key}%")->get()->toArray() )){
                return back()->with('error',"No result Found");
            }

            if (empty($request->category)) {
                $cat_id[] = null;
                foreach (categoty::select()->where('name', 'LIKE', "%{$request->sear_key}%")->get() as $key => $value) {
                    $cat_id[$key] = $value->id;
                }
                $data = question::select()->whereIn('cat_id', $cat_id)->where('type', '0')->where('status', '0')->paginate(30);
            } else {
                $data = question::select()->where('cat_id', $request->category)->where('type', '0')->where('status', '0')->paginate(30);
            }
        } elseif($request->sear_id == 'sear') {
            $data = question::select()->where('search_id', 'LIKE',"%{$request->sear_key}%")->where('type','0')->where('status','0')->paginate(30);
        } elseif($request->sear_id == 'key') {
            $data = question::select()->where('type','0')->where('status','0')->where('question','LIKE',"%{$request->sear_key}%")->paginate(30);
        }

        $data->appends(request()->query());
        $category = categoty::select()->where('status', true)->get();
        return view('backend.question',['data'=>$data,'categories'=>$category]);
    }

    function FilterMulti(Request $request){

        if(empty($request->sear_key) && empty($request->category)){
            return back();
        }

        if ($request->sear_id == 'cat') {

            if(empty( categoty::where('name', 'LIKE', "%{$request->sear_key}%")->get()->toArray() )){
                return back()->with('error',"No result Found");
            }

            if (empty($request->category)) {
                $cat_id[] = null;
                foreach (categoty::select()->where('name', 'LIKE', "%{$request->sear_key}%")->get() as $key => $value) {
                    $cat_id[$key] = $value->id;
                }
                $data = question::select()->whereIn('cat_id',$cat_id)->where('type','1')->where('status','0')->paginate(30);
            } else {
                $data = question::select()->where('cat_id', $request->category)->where('type', '1')->where('status', '0')->paginate(30);
            }
        } elseif($request->sear_id == 'sear') {
            $data = question::select()->where('search_id', 'LIKE',"%{$request->sear_key}%")->where('type','1')->where('status','0')->paginate(30);
        } elseif($request->sear_id == 'key') {
            $data = question::select()->where('type','1')->where('status','0')->where('question','LIKE',"%{$request->sear_key}%")->paginate(30);
        }

        $data->appends(request()->query());
        $category = categoty::select()->get();
        return view('backend.multi-question',['data'=>$data,'categories'=>$category]);
    }

    function viewFile($id) {

        $file = Asset::find($id);

        // Store the file name into variable
        $filename = $file->path;
        return response()->file($file->path);
    }
}
