<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Income;
use App\Models\Order;
use App\Http\Resources\V1\ProductResource;
use Carbon\Carbon;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create(Request $request)
    {   
        $branch = $request->user()->branch_id;
        $products = Product::where('branch_id',$branch)->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user =  auth('sanctum')->user();
        
        $request->validate([
            'products' => 'required',
            'method'   => 'required',
        ]);

        $order = new Order;
        $order->method = $request->method;
        $order->status = 'completed';
        $order->branch_id = $request->branch;
        $order->save();


        $idArray        = [];
        $productsArray  = [];

        // Generate an array with products id
        foreach($request->products as $product){
            array_push($idArray, $product['id']);
        }
        
        // We search the products on the data base
        $products = Product::whereIn('id', $idArray)->get();
        

        for ($i = 0; $i < count($request->products); $i++){
            $product = $products->where('id',$request->products[$i]['id'])->first();
            
            $price      = json_decode($request->products[$i]['price']);
            $amount     = json_decode($request->products[$i]['amount']);

            $income                     = new Income;
            $income->amount             = $price * $amount;
            $income->product_quantity   = $amount;
            $income->order_id           = $order->id;
            $income->branch_id          = $request->branch;
            $income->product_id         = $product->id;
            if($user->stores){
                $income->store_id           = $user->stores->id;
            }
            
            if($request->date){
                $income->created_at = $request->date;
            }

            $categories = $product->categories;
            
            $income->save();
            $income->categories()->sync($categories);

        }

        return response()->json([
            'success' => true,
            'message' => 'Orden creada con exito',
            'order'   => $order,
            'status'  =>201
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
