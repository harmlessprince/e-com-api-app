<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            "name"  => $request->name,
            "detail"  => $request->description,
            "stock"  => $request->stock,
            "price"  => $request->price,
            "discount"  => $request->discount,
        ]);

        if ($product) {
            return response([
                "data"  => new ProductResource($product),
            ], 201);
        }else{
            return response([
                "error"  => "Product not created",
            ],200);
        }

        // "name": [
        //     "The name field is required."
        // ],
        // "detail": [
        //     "The detail field is required."
        // ],
        // "stock": [
        //     "The stock field is required."
        // ],
        // "price": [
        //     "The price field is required."
        // ],
        // "discount": [
        //     "The discount field is required."
        // ]
        //
        // return $request->all();
        // $product = Produc
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
       return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $request['detail'] = $request->description ;

        unset($request['description']);

        $product->update($request->all());

        return response([
            "data"  => new ProductResource($product),
        ], 201);
    


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response([
            "message"  => "Product Deleted",
        ], 204);


    }
}
