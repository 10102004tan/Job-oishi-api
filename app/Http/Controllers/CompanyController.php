<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Company;
use App\Models\Address;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();

        return view('company.index', ['companies' => $companies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create', ['benefits' => Benefit::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'display_name' => 'nullable|string|max:255',
        'image_logo' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'website' => 'nullable|string|max:255',
        'tagline' => 'nullable|string',
        'company_size' => 'nullable|string|max:255',
        'num_job_openings' => 'nullable|integer',
        'industries_arr' => 'nullable|string|max:255',
        'addresses.*.street' => 'nullable|string|max:255', // Validate each address street
        'addresses.*.ward' => 'nullable|string',
        'addresses.*.district' => 'nullable|string|max:255',
        'addresses.*.province' => 'nullable|string|max:255',
    ]);

    // Create a new company record
    $company = Company::create([
        'display_name' => $validatedData['display_name'] ?? null,
        'image_logo' => $validatedData['image_logo'] ?? null,
        'description' => $validatedData['description'] ?? null,
        'website' => $validatedData['website'] ?? null,
        'tagline' => $validatedData['tagline'] ?? null,
        'company_size' => $validatedData['company_size'] ?? null,
        'num_job_openings' => $validatedData['num_job_openings'] ?? null,
        'industries_arr' => $validatedData['industries_arr'] ?? null,
    ]);

    // Create a new address record associated with the company
    foreach ($validatedData['addresses'] as $addressData) {
        Address::create([
            'company_id' => $company->id,
            'street' => $addressData['street'] ?? null,
            'ward' => $addressData['ward'] ?? null,
            'district' => $addressData['district'] ?? null,
            'province' => $addressData['province'] ?? null,
        ]);
    }

    // Return a response, typically a redirect or a JSON response
    return response()->json(['company' => $company], 201);
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('company.edit', ['company' => Company::find($id), 'benefits' => Benefit::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $validated = $request->validate([
            'display_name' => 'required|max:255',
            'description' => 'required',
            'image_logo' => 'required',
            'website' => 'required'
        ]);

        $company = Company::find($id);
        $company->fill($validated);
        $company->tagline = $request['tagline'];
        $company->company_size = $request['company_size'];
        $company->address_region_id = $request['address_region_id'];
        $company->num_job_openings = $request['num_job_openings'];
        $company->nationality_id = $request['nationality_id'];
        $company->benefits()->sync($request->benefits);
        $company->save();

        return redirect()->route('companies.index')
            ->with('success', 'Cập nhật thông tin công ty, doanh nghiệp thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->benefits()->detach();
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Xóa thành công!');
    }
}
