<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address1', 
        'address2',
        'city',  
        'state',
        'zipcode',  
        'macaddress',      
    ];

    public function getRouteKeyName()
    {
        return 'macaddress';
    }
}
