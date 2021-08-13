<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productsBySlug($slug)
    {
        $data=[];
        $data['product'] = Product::where('slug',$slug) -> first();  //improve select only required fields
        if (!$data['product']){ ///  redirect to previous page with message
        }


        $product_categories_ids =  $data['product'] -> categories ->pluck('id');

        $data['related_products'] = Product::whereHas('categories',function ($cat) use($product_categories_ids){
            $cat-> whereIn('categories.id',$product_categories_ids);
        }) -> limit(20) -> latest() -> get();


        $product_id = $data['product'] -> id ;
        $data['product_attributes'] =  Attribute::whereHas('option' , function ($q) use($product_id){
            $q -> whereHas('product',function ($qq) use($product_id){
                $qq -> where('product_id',$product_id);
            });
        })->get();


        return view('front.products-details', $data);
    }

}
