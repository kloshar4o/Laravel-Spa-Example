<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company\CompanyStatus;

class CompanyStatusController extends Controller
{
    public function __invoke()
    {
        return response(CompanyStatus::cached());
    }}
