<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\DashboardResource;
use App\Http\Resources\V1\IncomeResource;
use App\Http\Resources\V1\OutcomeResource;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Store;
use App\Models\Branch;
use App\Models\Income;
use App\Models\Outcome;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user       = Auth::user();
  
        if($user->has('stores')){

            // $store      = Store::where('user_id',$user->id)->first();

            $incomes    = Income::where('branch_id',$user->branch_id)->get();
            $outcomes   = Outcome::where('branch_id',$user->branch_id)->get();

            $incomes    = IncomeResource::collection($incomes);
            $outcomes   = OutcomeResource::collection($outcomes);
    
            $dashboardData = [
                'data'=>[
                    'incomes'=>$incomes,
                    'outcomes'=>$outcomes,
                    'status'=>true
            ]];
            return $dashboardData;
        }else{
            return response()->json([
                'message'=>'No hay información que mostrar',
                'status'=>false
            ],200);
        }

        
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
