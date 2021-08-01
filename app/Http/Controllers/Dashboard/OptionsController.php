<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
    public function index()
    {
          $Options = Option::with(['Product' =>function ($prod) {$prod->select('id');}
         ,                              'Attribute' =>function ($attr) {$attr->select('id');}
                                         ])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);
        return view('dashboard.Option.index', compact('Options'));
    }

    public function create()
    {
        $data = [];
        $data['products'] = Product::Active()->select('id')->get();
          $data['Attributes'] = Attribute::select('id')->get();

        return view('dashboard.Option.create', $data);


    }

    public function store(OptionsRequest $request)
    {


        DB::beginTransaction();

        //validation


        $Option = Option::create([
            'price' => $request->price,
            'product_id' => $request->product_id,
            'attribute_id' => $request->attribute_id,

        ]);
        //save translations
        $Option->name = $request->name;
        $Option->save();

        //save Option categories


        DB::commit();
        return redirect()->route('admin.options')->with(['success' => 'تم ألاضافة بنجاح']);

    }
    public function edit($optionid)
    {
        $data = [];

        $data['Option'] = Option::find($optionid);
        if (!$data['Option'])
            return redirect()->back()->with(['error', 'هذا القسم غير موجود']);

        $data['Attributes'] = Attribute::select('id')->get();
        $data['Products'] = Product::active()->select('id')->get();
        return view('dashboard.Option.edit', $data);




   }
    public function update($id, OptionsRequest $request)
    {
        try {
            DB::beginTransaction();

            $Option = Option::find($id);

            if (!$Option)
                return redirect()->route('admin.options')->with(['error' => 'هذا ألعنصر غير موجود']);

            $Option->update($request->only(['price','product_id','attribute_id']));
            //save translations
            $Option->name = $request->name;
            $Option->save();
            DB::commit();

            return redirect()->route('admin.options')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function destroy($id)
    {

        try {
            $Option = Option::find($id);

            if (!$Option)
                return redirect()->route('admin.options')->with(['error' => 'هذا القسم غير موجود ']);

            $Option->delete();

            return redirect()->route('admin.options')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



}
