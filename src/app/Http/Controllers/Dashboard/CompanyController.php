<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Company\CompanyUpdateRequest;
use App\Models\Company\Company;
use Illuminate\Http\Response;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Company::class);
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
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        $company->setStatusOptions();
        return response($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CompanyUpdateRequest $request
     * @param Company $company
     * @return Response
     */
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $company = tap($company)->update($request->toArray());
        return response($company);
    }

}
