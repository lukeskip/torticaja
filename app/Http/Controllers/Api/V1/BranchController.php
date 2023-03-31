<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Income;
use App\Models\Outcome;
use App\Http\Resources\V1\IncomeResource;
use App\Http\Resources\V1\OutcomeResource;
use App\Http\Resources\V1\BranchResource;
use Illuminate\Http\Request;




class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::paginate(5);
        return BranchResource::collection($branches);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {   

        $outcomes   = $branch->stores->outcomes;
        $outcomes   = OutcomeResource::collection($outcomes);

        $incomes   = $branch->stores->incomes;
        $incomes   = OutcomeResource::collection($incomes);
        
        $branch = new BranchResource($branch);
    
        $data = [
            'data'=>[
                'incomes'=>$incomes,
                'outcomes'=>$outcomes,
                'branch'  => $branch,
                'status'    =>true
        ]];
        
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Branch $branch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function destroy(Branch $branch)
    {
        //
    }
}
