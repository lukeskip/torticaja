<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    use HasFactory;

    protected $total;
    protected $wholesales;

    
    public function wholesales(){
        return $this->wholesales = Wholesale::where('date',$this->date)->get()->sum('amount');
    }

    public function getFormatDateAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('D d/m');
    }

    public function getFlourFinalAttribute()
    {
        return ($this->flour * 20) * get_config('dough_ratio');
    }

    public function getResultGasAttribute()
    {
        $prev   = Extract::where('id', '<', $this->id)->max('gas');
        $result = $this->gas - $prev;
        return $result;
    }


    public function getTotalAttribute()
    {
        // Porcentaje de pérdida de peso en la cocción calculada a 10%
        $this->decrease = .1;

        // La suma de la masa, la masa fría y la harina ya transformada en masa
        $this->initial = (($this->dough + $this->dough_cold + $this->flour_final) - $this->dough_leftover);

        // La perdida de peso en la cocción
        $this->loosing = ($this->initial * $this->decrease);
        
        
        $this->total = ($this->initial  - $this->loosing ) - $this->tortilla_leftover;

        return format_number($this->total);
    }

    public function getBalanceAttribute()
    {
        return format_number($this->wholesales - $this->total);
    }


    public function getKgCostAttribute(){
        $category   = Category::where('label','Tortillería')->first();
        $today      = Carbon::parse($this->date);;
        $incomes    = Income::where('date',$today)->whereHas('products',function ($q) use($category){
            $q->whereHas('categories',function ($q)use($category){
               $q->where('categories.id',$category->id);
            });
        })->join('products', 'incomes.product_id', '=', 'products.id')->get();
        
        $outcomes = Outcome::where('date',$today)->whereHas('categories',function ($q) use($category){
            $q->where('categories.id',$category->id);
        })->orderBy('date','ASC')->get();

        
        $whole      = $incomes->where('label','!=','Medio KG tienda')->sum('product_quantity');
        $half       = $incomes->where('label','Medio KG tienda')->sum('product_quantity') / 2;

        $totalKg            = $half + $whole;
        $insightTotal       = ($outcomes->sum('amount')) / $totalKg;

        return format_number($insightTotal);
    }
}
