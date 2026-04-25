<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingUser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'marketing_users';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nama',
        'email',
        'phone',
        'area',
        'posisi',
        'status',
    ];
}
