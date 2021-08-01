<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{


    public function editShippingMethod($type)
    {
// 3 anwa3 mn el shipping in sidebar blade free inner outer

        if ($type === 'free')
            $shippingmethod = Setting::where('key', 'free_shipping_label')->first();

        elseif ($type === 'inner') {
            $shippingmethod = Setting::where('key', 'local_label')->first();

        } elseif ($type === 'outer') {
            $shippingmethod = Setting::where('key', 'outer_label')->first();
        }


        return view('dashboard.settings.shipping.edit', compact('shippingmethod'));

    }

    public function updateShippingMethod(ShippingRequest $request, $id)
    {

        // el validation by request ShippingRequest

        try {
            $updateShippingMethod = Setting::find($id);

            DB::beginTransaction();
            $updateShippingMethod->update(['plain_value' => $request->plain_value]);

            $updateShippingMethod->value = $request->value;
            $updateShippingMethod->save();
            DB::commit();

            return redirect() ->back()->with(['success'=>'تم التعديل']);
        }catch (\Exception $ex){

            return redirect() ->back()->with(['errors'=>'في حاجه غلط ']);

        DB::rollBack();
        }


    }

}
