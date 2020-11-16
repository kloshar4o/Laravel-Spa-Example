<?php

namespace App\Models\Company;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @method static Builder whereCompanyId(int $company_id)
 */

class CompanyAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'city',
        'town',
        'street_address',
        'state',
        'zip',
        'company_id',
    ];

    function company(){
        return $this->belongsTo(Company::class);
    }

    function user(){
        return $this->hasOneThrough(User::class, Company::class, 'id', 'company_id', 'company_id');
    }

}
