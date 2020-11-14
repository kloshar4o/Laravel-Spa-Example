<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\UserRole;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __invoke()
    {
        return response(UserRole::cached());
    }}
