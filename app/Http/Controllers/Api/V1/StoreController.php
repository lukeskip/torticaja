<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Branch;
use App\Models\Product;
use App\Http\Resources\V1\StoreResource;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::paginate();
        return StoreResource::collection($stores);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth('sanctum')->user();
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $store = new Store();
        $store->name = $request->name;
        $store->address = $request->address;
        $store->phone = $request->phone;
        $store->user_id = $user->id;
        $store->save();

        // we create a one branch for the store if the user has only one store
        if(!$request->branchCheck){
            $branch = new Branch();
            $branch->name = $request->name;
            $branch->address = $request->address;
            $branch->phone = $request->phone;
            $branch->store_id = $store->id;
            $branch->save();

            // we create a the main product tortillas for each branch
            $product = new Product();
            $product->label = 'Tortillas KG';
            $product->slug = 'tortilla-kg';
            $product->price = 21.00;
            $product->branch_id = $branch->id;
            $product->save();

            
        }else{
            // we create multiple branches for the store if the user has multiple stores
            foreach($request->branches as $branchArray){
                $branch = new Branch();
                $branch->name = $branchArray['name'];
                $branch->address = $branchArray['address'];
                $branch->phone = $branch['phone'];
                $branch->store_id = $store->id;
                $branch->save();

                 // we create a the main product tortillas for each branch
                $product = new Product();
                $product->label = 'Tortillas KG';
                $product->price = 21.00;
                $product->branch_id = $branch->id;
                $product->save();
            }
        }
        
        // we respond with all login information
        return response()->json([
            'success'   => true,
            'branch'    => -1,
            'store'     => $store->id,
            'role'      => $user->role,
            'token'     =>$request->bearerToken(),
            'message'   => 'Store created successfully',
            'status'    => 201,
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
