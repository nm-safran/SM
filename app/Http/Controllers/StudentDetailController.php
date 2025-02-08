<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use Illuminate\Http\Request;

class StudentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentDetails = StudentDetail::all();
        return view('studentdetails.index', compact('studentDetails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studentdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentDetailRequest $request)
    {
        StudentDetail::create($request->validated());
        return redirect()->route('studentdetails.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDetail $studentDetail)
    {
        return view('studentdetails.show', compact('studentDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentDetail $studentDetail)
    {
        return view('studentdetails.edit', compact('studentDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail)
    {
        $studentDetail->update($request->validated());
        return redirect()->route('studentdetails.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentDetail $studentDetail)
    {
        $studentDetail->delete();
        return redirect()->route('studentdetails.index');
    }
}
