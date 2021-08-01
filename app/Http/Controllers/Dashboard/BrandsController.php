<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\brandsRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);

        return view('dashboard.brands.index', compact('brands'));


    }

    public function create()
    {

        return view('dashboard.brands.create');

    }

    public function store(brandsRequest $request)
    {
        try {
            DB::beginTransaction();

            //validation

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $fileName = "";
            if ($request->has('photo')) {

                $fileName = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create($request->except('_token', 'photo'));

            //save translations
            $brand->name = $request->name;
            $brand->photo = $fileName;

            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => 'تم ألاضافة بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function edit($id)
    {

        $brand = Brand::find($id);
        if (!$brand) {
            return redirect()->back()->with(['error', 'هذا القسم غير موجود']);
        }
        return view('dashboard.brands.edit', compact('brand'));
    }

    public function update($id, brandsRequest $request)
    {
        try {



            $brands = Brand::find($id);

            if (!$brands)
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود']);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $fileName = "";

            if ($request->has('photo')) {

                $image_path = public_path("assets/images/Brands/{$brands->photo}");
                if (File::exists($image_path)) {
                    unlink($image_path);
                }

                $fileName = uploadImage('brands', $request->photo);



            }



            $brands->update($request->all());

            //save translations
            $brands->name = $request->name;
            $brands->photo = $fileName;

            $brands->save();
            return redirect()->route('admin.brands')->with(['success' => 'تم  التعديل  بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

    public function destroy($id)
    {



        try {
            //get specific categories and its translations
            $Brand = Brand::find($id);

            if (!$Brand){
                return redirect()->route('admin.brands')->with(['error' => 'هذا القسم غير موجود ']);

            }



            $image_path = public_path("assets/images/Brands/{$Brand->photo}");

            if (File::exists($image_path)) {
                unlink($image_path);
            }
            $Brand->delete();


            return redirect()->route('admin.brands')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
