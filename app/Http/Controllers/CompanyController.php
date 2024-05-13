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
    dd($request->all());
    // Validate the request data
    $validated = $request->validate([
        'display_name' => 'required|max:255',
        'description' => 'required',
        'image_logo' => 'required|url',
        'website' => 'required|url',
        'tagline' => 'nullable|string',
        'company_size' => 'nullable|string',
        'num_job_openings' => 'nullable|integer',
        'nationality_id' => 'nullable|integer',
        'benefits' => 'nullable|array',
        'addresses.*.line_1' => 'required|string',
        'addresses.*.line_2' => 'nullable|string',
        // Add validation rules for other address fields if needed
    ]);

    // Create a new Company instance and fill its attributes
    $company = new Company();
    $company->fill($validated);
    $company->save();

    // Attach benefits to the company
    if (isset($validated['benefits'])) {
        $company->benefits()->attach($validated['benefits']);
    }

    // Add Addresses
    if ($request->has('addresses')) {
        foreach ($validated['addresses'] as $addressData) {
            $address = new Address();
            $address->fill($addressData);
            $address->company_id = $company->id;
            $address->save();
        }
    }

    return redirect()->route('companies.index')
        ->with('success', 'Thêm công ty, doanh nghiệp mới thành công!');
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
