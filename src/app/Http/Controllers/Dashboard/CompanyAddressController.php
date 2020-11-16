<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Company\CompanyAddressCreateRequest;
use App\Http\Requests\Dashboard\Company\CompanyAddressUpdateRequest;
use App\Http\Resources\AddressCollection;
use App\Models\Company\Company;
use Exception;
use App\Models\Company\CompanyAddress;
use Illuminate\Http\Response;

class CompanyAddressController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(CompanyAddress::class, "address");
    }

    /**
     * Display a listing of the resource.
     *
     * @param Company $company
     * @return AddressCollection
     */
    public function index(Company $company)
    {
        return new AddressCollection($company->addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyAddressCreateRequest $request
     * @param Company $company
     * @param CompanyAddress $address
     * @return Response
     */
    public function store(CompanyAddressCreateRequest $request, Company $company, CompanyAddress $address)
    {
        $attributes = $request->toArray();
        $attributes['company_id'] = $company->id;
        $address->fill($attributes);
        return response(tap($address)->save());
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param CompanyAddress $address
     * @return Response
     */
    public function show(Company $company, CompanyAddress $address)
    {
        return response($address);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CompanyAddressUpdateRequest $request
     * @param Company $company
     * @param CompanyAddress $address
     * @return Response
     */
    public function update(CompanyAddressUpdateRequest $request, Company $company, CompanyAddress $address)
    {
        $attributes = $request->toArray();
        $attributes['company_id'] = $company->id;
        return response(tap($address)->update($attributes));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @param CompanyAddress $address
     * @return AddressCollection
     * @throws Exception
     */
    public function destroy(Company $company, CompanyAddress $address)
    {
        $address->delete();
        return new AddressCollection($company->addresses);
    }
}
