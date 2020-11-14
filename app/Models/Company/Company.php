<?php

namespace App\Models\Company;

use App\Models\User\User;
use App\Traits\SearchTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * @property mixed status_options
 * @property mixed users_count
 */
class Company extends Model
{
    use HasFactory, SearchTrait;
    
    protected $search = ['company_name'];

    protected $fillable = ['company_name', 'company_status'];

    function user()
    {
        return $this->hasOne(User::class);
    }

    function users()
    {
        return $this->hasMany(User::class);
    }

    function usersPagination($perPage)
    {
        return $this->users()
            ->where('id', '<>', auth()->id())
            ->paginate($perPage);
    }

    function addresses()
    {
        return $this->hasMany(CompanyAddress::class);
    }

    function setStatusOptions()
    {
        return $this->status_options = CompanyStatus::cached();
    }

}
