<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index()
    {
        $Attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('dashboard.attributes.index', compact('Attributes'));


    }
    public function create()
    {

        return view('dashboard.attributes.create');

    }

    public function store(AttributeRequest $request)
    {

        try {
            DB::beginTransaction();


            $Attribute = Attribute::create($request->except('_token'));

            //save translations
            $Attribute->name = $request->name;


            $Attribute->save();
            DB::commit();
            return redirect()->route('admin.attribute')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.attribute')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }





    public function edit($id)
    {

        $Attribute = Attribute::find($id);
        if (!$Attribute) {
            return redirect()->back()->with(['error', 'هذا القسم غير موجود']);
        }
        return view('dashboard.attributes.edit', compact('Attribute'));
    }

    public function update($id, AttributeRequest $request)
    {
        try {



            $Attribute = Attribute::find($id);
            if (!$Attribute)
                return redirect()->route('admin.attribute')->with(['error' => 'هذا القسم غير موجود']);


            $Attribute->update($request->all());

            //save translations
            $Attribute->name = $request->name;


            $Attribute->save();
            return redirect()->route('admin.attribute')->with(['success' => 'تم  التعديل  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.attribute')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

    public function destroy($id)
    {



        try {
            //get specific categories and its translations
            $Attribute = Attribute::find($id);
            if (!$Attribute)

                return redirect()->route('admin.attribute')->with(['error' => 'هذا القسم غير موجود']);


            $Attribute->delete();


            return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



}
