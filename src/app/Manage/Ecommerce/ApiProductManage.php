<?php

namespace App\Manage\Ecommerce;

use App\Util\ManageUtil;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Products;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Enum\Ecommerce\ParameterRequestEnum;

class ApiProductManage
{
    protected $products;

    public function __construct()
    {
        $this->products = new Products;
    }

    public function getAllProducts(Request $request)
    {   
        if ($request["perPage"] == 'all') {
            return  DB::table('products')
                    ->leftJoin('images', 'products.image', '=', 'images.id')
                    ->select('products.*', 'images.image')
                    ->get();
        }
        $requestOrderBy = ManageUtil::getOderBy($request, "id");
        if (Schema::hasColumn('products', $requestOrderBy[0])){
            return $this->products->orderBy($requestOrderBy[0],$requestOrderBy[1])->paginate($request[ParameterRequestEnum::PAGINATE]);
        }
        return null;
    }

    public function addProduct(Request $request)
    {
        $user = $request->user('api');
        $this->products->user = $user->id;
        $this->products->fill($request->all());
        $this->products->save();
        return response()->json($this->products);
    }

    public function showProduct($slug)
    {
        return $this->products->where("slug", $slug)->first();
    }

    public function updateProduct(Request $request, $id)
    {
        $product = $this->products::find($id);
        $data = $request->all();
        $product->fill($data)->save();
        return response()->json(['success' => 'Update product success'], 200);
    }

    public function deleteProduct($id)
    {
        $product = $this->products::find($id);
        $product->delete();
        return response()->json(['success' => 'Delete product success'], 200);
    }
}