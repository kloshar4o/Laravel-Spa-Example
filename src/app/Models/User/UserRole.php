<?php

namespace App\Models\User;

use App\Models\Company\CompanyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserRole extends Model
{
    use HasFactory;
    public $incrementing = false;

    static function cached()
    {
        return Cache::remember(
            'roleOptions',
            86400,
            function () {
                return self::query()
                    ->get()
                    ->each(function ($role){
                        $role->label = $role->name;
                        $role->value = $role->id;
                    });
            }
        );
    }
}
