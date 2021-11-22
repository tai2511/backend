<?php

namespace App\Http\Controllers\Ecommerce;

use Illuminate\Http\Request;
use App\Models\Ecommerce\Products;
use App\Http\Controllers\Controller;
use App\Manage\Ecommerce\ApiProductManage;
use App\Http\Requests\Ecommerce\Product\ProductRequest;

class ApiProductController extends Controller
{
    protected $products;

    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show']);
        $this->products = new Products;
        $this->productManage = new ApiProductManage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->productManage->getAllProducts($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        return $this->productManage->addProduct($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return $this->productManage->showProduct($slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        return $this->productManage->updateProduct($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->productManage->deleteProduct($id);
    }
}