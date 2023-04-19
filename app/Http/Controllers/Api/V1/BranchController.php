<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Order;
use App\Http\Resources\V1\IncomeResource;
use App\Http\Resources\V1\OutcomeResource;
use App\Http\Resources\V1\BranchResource;
use App\Http\Resources\V1\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\V1\ProductResource;

use Carbon\Carbon;




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
        
       
        $outcomes   = Outcome::where('branch_id',$branch->id)->whereDate('created_at',Carbon::today())->orderBy('created_at','desc')->get();
        $outcomes   = OutcomeResource::collection($outcomes);

        
        
        $incomes = Income::where('incomes.branch_id',$branch->id)->whereDate('incomes.created_at',Carbon::today())
        ->join("products","products.id", "=", "incomes.product_id")
        ->select("products.id","products.label", \DB::raw('count(*) as items'),\DB::raw('sum(incomes.amount) as amount'))->groupBy('label')->orderBy('amount','DESC')
        ->get();
        
        $incomes = IncomeResource::collection($incomes);
        $branch = new BranchResource($branch);
    
      
        $data = [
            'incomes'    =>$incomes,
            'outcomes'  =>$outcomes,
            'branch'    => $branch,
            'status'    =>200
        ];
       
        
       return response()->json($data,200);
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
