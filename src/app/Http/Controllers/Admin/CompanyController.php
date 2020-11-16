<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyCollection;
use App\Models\Company\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CompanyCollection
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return new CompanyCollection($companies);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return Response
     */
    public function store(Request $request, Company $company)
    {
        $attributes = $request->all();
        $company->fill($attributes);
        return response(tap($company)->save());
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function show(Company $company)
    {
        return response($company);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Company $company
     * @return Response
     */
    public function update(Request $request, Company $company)
    {
        $attributes = $request->toArray();
        $company = tap($company)->update($attributes);
        return response($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return CompanyCollection
     * @throws Exception
     */
    public function destroy(Company $company)
    {
        $company->delete();
        $companies = Company::paginate(10);
        return new CompanyCollection($companies);

    }
}
