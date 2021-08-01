<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TagsController extends Controller
{
    public function index()
    {
        $Tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('dashboard.tags.index', compact('Tags'));


    }

    public function create()
    {

        return view('dashboard.tags.create');

    }

    public function store(TagsRequest $request)
    {
        try {
            DB::beginTransaction();

            //validation

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $tags = tag::create(['slug'=> $request->slug]);

            //save translations
            $tags->name = $request->name;

            $tags->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($id)
    {

        $tags = Tag::find($id);
        if (!$tags) {
            return redirect()->back()->with(['error', 'هذا القسم غير موجود']);
        }
        return view('dashboard.tags.edit', compact('tags'));
    }

    public function update($id, TagsRequest $request)
    {

        try {



            $tags = Tag::find($id);

            if (!$tags)
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود']);

            $tags->update($request->except('_token','id'));

            //save translations
            $tags->name = $request->name;


            $tags->save();
            DB::commit();


            return redirect()->route('admin.tags')->with(['success' => 'تم  التعديل  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

    public function destroy($id)
    {



        try {
            //get specific categories and its translations
            $tags = Tag::find($id);

            if (!$tags){
                return redirect()->route('admin.tags')->with(['error' => 'هذا القسم غير موجود ']);

            }

            $tags->delete();


            return redirect()->route('admin.tags')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
