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
        // if date is not set we use today's date
        if(!$request->date){
            $date  = Carbon::today();
        }else{
            $date  = Carbon::parse($request->date);
        }

        

        $request->validate([
            'dough'             => 'required',
            'dough_cold'        => 'required',
            'dough_leftover'    => 'required',
            'flour'             => 'required',
            'tortilla_leftover' => 'required',
            'cash'              => 'required',
            'gas'               => 'required',
            'branch'            => 'required',
        ]);

        $cashClosing = CashClosing::create($request->all());

        // we get tortilla product by slug
        $tortilla = Product::where('slug','tortilla-kg')->first();

        // if tortilla product exists we calculate the incomes coming from tortilla sales
        if($tortilla){

            // we get all incomes but the ones related to tortilla
            $incomes = Income::where('branch_id',$request->branch)->whereDate('created_at',$date)->where('product_id','!=',$tortilla->is_double)->whereHas('orders',function($q){
                $q->where('method','cash');
            })->get();
            
            $outcomes   = Outcome::where('branch_id',$request->branch)->whereDate('created_at',$date)->where('category','inhouse')->get();
           
            $cash           = $extract->cash;
    
            $incomesTotal   = $incomes->sum('amount');
            $outcomesTotal  = $outcomes->sum('amount');
    
            ///// STARTS: Calculates tortilla sale

            // We estimate the amount of tortilla sold by substrating the total incomes (without tortilla) from the total cash an then we add the total outcomes
            $amount = ($cash - $incomesTotal) + ($outcomesTotal);
            $quantity   = round($amount / $tortilla->price , 1);

            // we get the tortilla income
            $income = Income::where('branch_id',$request->branch)->where('product_id',$tortilla->id)->wheredate('created_at',$date)->first();
            
            // if an income related to tortilla  does not exist we create it along with its order, if does exist we update it
            if(!$income){
                $income             = new Income;
                $order              = new Order;
                $order->address     = 'counter';
                $order->status      = 'delivered'; 
                $order->method      = 'efectivo';
                $order->save();
                $income->order_id   = $order->id;
            }else{

                $income->amount             = round($amount,2);
                $income->product_id         = $tortilla->id;
                $income->product_quantity   = $quantity;
                $income->save();
                $income->categories()->sync($category);
            }
       
        }

        return response()->json([
            'status' => true,
            'message' => 'Corte de caja registrado correctamente',
            'cashClosing' => $cashClosing,
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
