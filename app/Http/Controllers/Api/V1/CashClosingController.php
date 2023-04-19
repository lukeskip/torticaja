<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashClosing;
use Carbon\Carbon;

class CashClosingController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today      = Carbon::today();
        $request->validate([
            'dough'             => 'required',
            'dough_cold'        => 'required',
            'dough_leftover'    => 'required',
            'flour'             => 'required',
            'tortilla_leftover' => 'required',
            'cash'              => 'required',
            'gas'               => 'required'
        ]);

        $cashClosing = CashClosing::create($request->all());

        $tortilla = Product::where('label','Tortilla KG')->first();

        if($tortilla){

            $incomes = Income::whereDate('created_at',$today)->where('product_id','!=',$tortilla->is_double)->whereHas('orders',function($q){
                $q->where('method','cash');
            })->get();
            
            $outcomes   = Outcome::whereDate('created_at',$today)->where('category','inhouse')->get();
           
            $cash           = $extract->cash;
    
            $incomesTotal   = $incomes->sum('amount');
            $outcomesTotal  = $outcomes->sum('amount');
    
            ///// STARTS: Calculates tortilla sale
    
            $income = Income::where('product_id',$tortilla->id)->wheredate('created_at',$today)->first();
            
            if(!$income){
                $income             = new Income;
    
                $order              = new Order;
                $order->code        = get_code(5);
                $order->address     = 'counter';
                $order->status      = 'delivered'; 
                $order->method      = 'efectivo';
                $order->save();
    
                $income->order_id   = $order->id;
            }

            $amount = ($cash - $incomesTotal) + ($outcomesTotal);
  
            $quantity   = round($amount / $tortilla->price , 1);
       
            $income->amount             = round($amount,2);
            $income->product_id         = $tortilla->id;
            $income->product_quantity   = $quantity;
            
            $income->save();
            $income->categories()->sync($category);
        }

        return response()->json([
            'message' => 'Corte de caja registrado correctamente',
            'cashClosing' => $cashClosing,
            status=>200
        ],200);

        

        
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
