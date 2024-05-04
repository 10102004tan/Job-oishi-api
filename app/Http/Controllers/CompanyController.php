<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use App\Models\Company;
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

        // dd($request);
        // Validate the request data
        $validated = $request->validate([
            'display_name' => 'required|max:255',
            'description' => 'required',
            'image_logo' => 'required|url',
            'website' => 'required|url',
            'tagline' => 'nullable|string',
            'company_size' => 'nullable|string',
            'address_region_id' => 'nullable|integer',
            'num_job_openings' => 'nullable|integer',
            'nationality_id' => 'nullable|integer',
            'benifits' => 'nullable|array', 
        ]);

        $company = new Company();

        // Fill the company attributes
        $company->company_name = $validated['display_name'];
        $company->description = $validated['description'];
        $company->company_logo = $validated['image_logo'];
        $company->website = $validated['website'];
        $company->tagline = $validated['tagline'];
        $company->company_size = $validated['company_size'];
        $company->address_region_id = $validated['address_region_id'];
        $company->number_job_opening = $validated['num_job_openings'];
        $company->nationallity_id = $validated['nationality_id'];

        $company->save();
        $company->benefits()->attach($validated['benefits']);

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
