<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StudentDetailController extends Controller
{
    /**
     * Instantiate a new StudentDetailController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-studentdetail|create-studentdetail|edit-studentdetail|delete-studentdetail', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-studentdetail', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-studentdetail', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-studentdetail', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('studentdetails.index', [
            'studentDetails' => StudentDetail::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('studentdetails.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentDetailRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['age'] = \Carbon\Carbon::parse($data['birth_date'])->diff(\Carbon\Carbon::create(2025, 1, 1))->y;
        StudentDetail::create($data);
        return redirect()->route('studentdetails.index')
            ->withSuccess('New student detail is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDetail $studentDetail): View
    {
        return view('studentdetails.show', [
            'studentDetail' => $studentDetail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentDetail $studentDetail): View
    {
        return view('studentdetails.edit', [
            'studentDetail' => $studentDetail
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail): RedirectResponse
    {
        $data = $request->validated();
        $data['age'] = \Carbon\Carbon::parse($data['birth_date'])->diff(\Carbon\Carbon::create(2025, 1, 1))->y;
        $studentDetail->update($data);
        return redirect()->back()
            ->withSuccess('Student detail is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentDetail $studentDetail): RedirectResponse
    {
        $studentDetail->delete();
        return redirect()->route('studentdetails.index')
            ->withSuccess('Student detail is deleted successfully.');
    }
}
