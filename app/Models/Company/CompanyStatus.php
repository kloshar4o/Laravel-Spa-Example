<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CompanyStatus extends Model
{
    use HasFactory;

    protected $primaryKey = 'value';
    public $incrementing = false;


    static function cached()
    {
        return Cache::remember(
            'statusOptions',
            86400,
            function () {
                return self::all();
            }
        );
    }
}
