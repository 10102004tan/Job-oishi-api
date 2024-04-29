<?php

namespace App\Http\Controllers;

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
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($request);
        $validated = $request->validate([
            'company_name' => 'required|max:255',
            'description' => 'required',
            'company_image' => 'required',
            'website' => 'required'
        ]);

        $company = new Company();
        $company->fill($validated);
        $company->tagline = $request['tagline'];
        $company->company_size = $request['company_size'];
        $company->address_region_id = $request['address_region_id'];
        $company->number_job_opening = $request['number_job_opening'];
        $company->benifits_id = $request['benifits_id'];
        $company->nationallity_id = $request['nationallity_id'];

        $company->save();
        
        return redirect()->route('companies.index')
            ->with('success', 'Thêm công ty, doanh nghiệp mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('company.edit', ['company' => Company::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request);
        $validated = $request->validate([
            'company_name' => 'required|max:255',
            'description' => 'required',
            'company_image' => 'required',
            'website' => 'required'
        ]);

        $company = Company::find($id);
        $company->fill($validated);
        $company->tagline = $request['tagline'];
        $company->company_size = $request['company_size'];
        $company->address_region_id = $request['address_region_id'];
        $company->number_job_opening = $request['number_job_opening'];
        $company->benifits_id = $request['benifits_id'];
        $company->nationallity_id = $request['nationallity_id'];

        $company->save();
        
        return redirect()->route('companies.index')
            ->with('success', 'Cập nhật thông tin công ty, doanh nghiệp thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Xóa thành công!');
    }
}
