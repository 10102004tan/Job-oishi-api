<?php

namespace App\Http\Controllers;

use App\Models\Benefit;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $benefits = Benefit::all();

        return view('benefit.index', ['benefits' => $benefits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('benefit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required',
            'icon' => 'required',
        ]);

        $benefit = new Benefit();
        $benefit->fill($validated);
        $benefit->save();

        return redirect()->route('benefits.index')
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
        $benefit = Benefit::find($id);
        return view('benefit.edit', ['benefit' => $benefit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'value' => 'required',
            'icon' => 'required',
        ]);

        $benefit = Benefit::find($id);
        $benefit->fill($validated);
        $benefit->save();

        return redirect()->route('benefits.index')
            ->with('success', 'Cập nhật thông tin phúc lợi thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benefit $benefit)
    {
        $benefit->delete();

        return redirect()->route('benefits.index')
            ->with('success', 'Xóa thành công!');
    }
}
