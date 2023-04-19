<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function incomes()
    {
        return $this->hasMany(Income::class,'order_id')->join("products","products.id", "=", "incomes.product_id")
        ->select("incomes.id","incomes.product_id","incomes.amount as amount","incomes.product_quantity as quantity","products.label as label",'products.price as price','products.unit as unit');
    }

    public function branches(){
        return $this->belongsTo(Branch::class,'branch_id');
    }

    public function getTotalAttribute(){   
        $total_price = 0;
        foreach($this->incomes as $income){
            $total_price += $income->amount;
        }

        return $this->attributes['total'] = round($total_price,2);
    }

    public function getStatusLabelAttribute(){
        switch ($this->attributes['status']){
            case 'pending':  
                return $this->attributes['status_label'] = 'Pendiente';
                break;
            case 'delivered':  
                return $this->attributes['status_label'] = 'Entregada';
                break;
            case 'canceled':  
                return $this->attributes['status_label'] = 'Cancelada';
                break;
        }
    }

    public function getMethodIconAttribute(){
        switch ($this->attributes['method']){
            case 'efectivo':  
                return $this->attributes['method_icon'] = '<i class="fa fa-money" aria-hidden="true"></i>';
                break;
            case 'tarjeta':  
                return $this->attributes['method_icon'] = '<i class="fa fa-credit-card" aria-hidden="true"></i>';
                break;
            case 'mercado-pago':  
                return $this->attributes['method_icon'] = '<i class="fa fa-qrcode" aria-hidden="true"></i>';
                break;
        }
    }


    public function getAddressAttribute(){
        if($this->attributes['address'] == 'counter'){
            return $this->attributes['address'] = 'Mostrador';
        }else{
            return $this->attributes['address'];
        }
    }

    public function getDateAttribute(){
        return Carbon::parse($this->created_at)->translatedFormat('D d/m H:i').' hrs.';
    }

    public function getDateNonFormattedAttribute(){
        return Carbon::parse($this->created_at)->translatedFormat('m-d-Y');
    }
}
