<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{

    protected $fillable = [ 
        'tours_id', 
        'customers_id', 
        'Preferential_Terms', 
        'Presence', 
        'Occupied_Place_Bus', 
        'Payment_method',
        'LogicalDelete',
        'Comment_Customer',
        'Stars',
        'Paid',
        'Amount_Children',
        'Accompanying',
        'Final_Price',
        'Presence',
        'Amount_Children',
        'Free_Children',
        'Comment_Employee',
        
    ];

    public static function fullname($tour, $place)
    {
        $passenger = Passenger::where('tours_id', $tour)->where('Occupied_Place_Bus', $place)->first();
        $fullname = $passenger->customer->Name . ' ' .  $passenger->customer->Surname . ' ' .  $passenger->customer->Middle_Name ?? '';
        
        return $fullname;
    }

    public static function fullnameemploye($tour, $place)
    {
        $passenger = Tour_employees::where('tour_id', $tour)->where('Occupied_Place_Bus', $place)->first();
        $fullname = $passenger->employee->Name . ' ' .  $passenger->employee->Surname . ' ' .  $passenger->employee->Middle_Name ?? '';
        
        return $fullname;
    }

    protected $hidden = [

    ];

    public function dept()
    {
        return $this->hasOne('App\Dept', 'passengers_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customers_id');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour', 'tours_id');
    }

    public function stock()
    {
        return $this->belongsTo('App\Stock','stock_id');
    }

    public function contracts_for_passenger()
    {
        return $this->hasMany('App\Contracts_for_passenger','contracts_for_passengers_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Children','childrens_id');
    }

    public function used_ticket()
    {
        return $this->hasMany('App\Used_ticket','passengers_id');
    }

    public function purchased_additional_services()
    {
        return $this->hasMany('App\Purchased_additional_services','passengers_id');
    }

    public function passenger()
    {
        return $this->belongsTo('App\Employee', 'employee_id');
    }

}
