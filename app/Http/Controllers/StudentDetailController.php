<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use App\Http\Requests\StoreStudentDetailRequest;
use App\Http\Requests\UpdateStudentDetailRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function index(Request $request): View
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'id'); // default sort by id
        $sortOrder = $request->input('sort_order', 'asc'); // default ascending

        $studentDetails = StudentDetail::query()
            ->when($search, function ($query, $search) {
                return $query->where('student_code', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('middle_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('city', 'like', "%{$search}%")
                    ->orWhere('district', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortOrder)
            ->paginate(5);

        return view('studentdetails.index', compact('studentDetails', 'search'));
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
        try {
            $validated = $request->validated();

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('profile_images', $filename, 'public');
                $validated['profile_image'] = '/storage/' . $path;
            }

            // Calculate age
            $birthDate = Carbon::parse($validated['birth_date']);
            $validated['age'] = $birthDate->age;

            // Create student record
            StudentDetail::create($validated);

            return redirect()->route('studentdetails.index')
                ->with('success', 'Student created successfully.');
        } catch (\Exception $e) {
            // If there's an error, delete the uploaded image if it exists
            if (isset($path)) {
                Storage::delete($path);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating student: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentDetail $studentDetail): View
    {
        try {
            // Format the birth date
            $studentDetail->formatted_birth_date = Carbon::parse($studentDetail->birth_date)->format('d-m-Y');

            // Calculate age
            $studentDetail->age = Carbon::parse($studentDetail->birth_date)->age;

            // Format contact number (assuming 10 digits)
            $studentDetail->formatted_contact = chunk_split($studentDetail->contact_no, 3, '-');
            $studentDetail->formatted_contact = rtrim($studentDetail->formatted_contact, '-');

            // Get individual names
            $studentDetail->first_name = $studentDetail->first_name;
            $studentDetail->middle_name = $studentDetail->middle_name;
            $studentDetail->last_name = $studentDetail->last_name;

            // Get full name
            $studentDetail->full_name = trim(implode(' ', array_filter([
                $studentDetail->first_name,
                $studentDetail->middle_name,
                $studentDetail->last_name
            ])));

            // Get address components
            $studentDetail->address = $studentDetail->address_one;
            $studentDetail->city = $studentDetail->city;
            $studentDetail->district = $studentDetail->district;

            // Format full address
            $studentDetail->full_address = implode(', ', array_filter([
                $studentDetail->address_one,
                $studentDetail->city,
                $studentDetail->district
            ]));

            // Student code
            $studentDetail->student_code = $studentDetail->student_code;

            return view('studentdetails.show', compact('studentDetail'));
        } catch (\Exception $e) {
            return redirect()->route('studentdetails.index')
                ->with('error', 'Error displaying student details: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $studentDetail = StudentDetail::findOrFail($id);
        return view('studentdetails.edit', compact('studentDetail'));
    }

    public function update(UpdateStudentDetailRequest $request, StudentDetail $studentDetail): RedirectResponse
    {
        $data = $request->validated();
        $data['age'] = Carbon::parse($data['birth_date'])->age;

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            // Store in public/storage/profile_images
            $path = $image->storeAs('profile_images', $filename, 'public');
            // Generate the correct URL for the image
            $data['profile_image'] = '/storage/' . $path;

            // Delete the old image if it exists
            if ($studentDetail->profile_image) {
                Storage::delete(str_replace('/storage/', '', $studentDetail->profile_image));
            }
        }

        $studentDetail->update($data);

        return redirect()->route('studentdetails.index')
            ->withSuccess('Student detail is updated successfully.');
    }

    public function destroy(StudentDetail $studentDetail)
    {
        $studentDetail->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Student detail is deleted successfully.'
            ]);
        }

        return redirect()->route('studentdetails.index')
            ->withSuccess('Student detail is deleted successfully.');
    }
}
