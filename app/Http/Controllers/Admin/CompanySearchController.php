<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanySearchCollection;
use App\Models\Company\Company;
use Illuminate\Http\Request;

class CompanySearchController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return CompanySearchCollection
     */
    public function __invoke(Request $request)
    {
        $term = $request->company_name;
        $result = $term ? Company::search($request->company_name)->limit(10)->get() : [];

        return new CompanySearchCollection($result);
    }
}
