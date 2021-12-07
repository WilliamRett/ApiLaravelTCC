<?php

namespace App\Http\Controllers\API;

use App\Models\CompanyProfile;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Http\Resources\CompanyProfileResource;
use Illuminate\Support\Facades\Validator;

class CompanyProfileController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CompanyProfile = CompanyProfile::all();

        return $this->sendResponse(CompanyProfileResource::collection($CompanyProfile), 'successfully created company profile.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyProfileRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $CompanyProfile = CompanyProfile::create($input);;

        return $this->sendResponse(new CompanyProfileResource($CompanyProfile), 'Product updated successfully.');
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyProfileRequest  $request
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyProfileRequest $request, CompanyProfile $companyProfile)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $companyProfile->name = $input['name'];
        $companyProfile->detail = $input['detail'];
        $companyProfile->save();

        return $this->sendResponse(new CompanyProfileResource($companyProfile), 'company profile update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyProfile  $companyProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyProfile $companyProfile)
    {
        $companyProfile->delete();

        return $this->sendResponse([], 'CompanyProfile deleted successfully.');
    }
}
