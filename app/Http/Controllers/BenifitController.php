<?php

namespace App\Http\Controllers;

use App\Models\Benifit;
use Illuminate\Http\Request;

class BenifitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benifits = Benifit::all();

        return view('benifit.index', ['benifits' => $benifits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('benifit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'benifit_name' => 'required',
            'benifit_icon' => 'required',
        ]);

        $benifit = new Benifit();
        $benifit->fill($validated);
        $benifit->save();

        return redirect()->route('benifits.index')
            ->with('success', 'Thêm phúc lợi mới thành công!');
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
        $benifit = Benifit::find($id);
        return view('benifit.edit', ['benifit' => $benifit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'benifit_name' => 'required',
            'benifit_icon' => 'required',
        ]);

        $benifit = Benifit::find($id);
        $benifit->fill($validated);
        $benifit->save();

        return redirect()->route('benifits.index')
            ->with('success', 'Cập nhật thông tin phúc lợi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benifit $benifit)
    {
        $benifit->delete();

        return redirect()->route('benifits.index')
            ->with('success', 'Xóa thành công!');
    }
}
