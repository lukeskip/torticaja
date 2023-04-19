<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Outcome;
use App\Models\Branch;
use App\Http\Resources\V1\OutcomeResource;

class OutcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch =  auth('sanctum')->user()->branch_id;
        $outcomes = Outcome::where('branch_id', $branch)->orderBy('created_at', 'desc')->get();
        $outcomes = OutcomeResource::collection($outcomes);

        $data = [
            'outcomes' => $outcomes,
            'status'=>200
        ];
        return response()->json($data, 200);
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $branch_id =  auth('sanctum')->user()->branch_id;
        $branch = Branch::find($branch_id);
        $store = $branch->store_id;
        
        $request->validate([
            'label' => 'required',
            'amount' => 'required',
        ]);


        $outcome = new Outcome;
        $outcome->label = $request->label;
        $outcome->amount = $request->amount;
        $outcome->category = $request->category;
        $outcome->branch_id = $branch_id;
        $outcome->store_id = $store;
        $outcome->save();

        return response()->json([
            'message' => 'Outcome created successfully',
            'status' => 200
        ], 200);
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
