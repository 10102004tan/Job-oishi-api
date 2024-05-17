<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Benefit;


class CompanyAPIDBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $hiddenBenefitFields = ['id', 'pivot', 'created_at', 'updated_at'];

    $companies = Company::with('benefits', 'address')->get();

    // Xử lý ẩn các trường trong mối quan hệ 'benefits'
    $companies->each(function ($company) use ($hiddenBenefitFields) {
        $company->benefits->transform(function ($benefit) use ($hiddenBenefitFields) {
            return $benefit->makeHidden($hiddenBenefitFields);
        });
    });


    return $companies;
}

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function getDetail(string $id)
    {
        $company = Company::with('benefits', 'address')->find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        $company->makeHidden(['benefit_id']);

        return response()->json($company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
