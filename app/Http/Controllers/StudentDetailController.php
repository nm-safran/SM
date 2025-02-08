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
            ->paginate(10);

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
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'student_code' => 'required|string|max:20|unique:student_details',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'birth_date' => 'required|date|before:today',
            'contact_no' => 'required|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'address_one' => 'required|string|max:255',
            'city' => 'required|string|max:50',
            'district' => 'required|string|max:50',
        ]);

        try {
            if ($request->hasFile('profile_image')) {
                $image = $request->file('profile_image');
                $filename = time() . '_' . $image->getClientOriginalName();
                // Store in public/storage/profile_images
                $path = $image->storeAs('profile_images', $filename, 'public');
                // Generate the correct URL for the image
                $validated['profile_image'] = '/storage/' . $path;
            }

            // Calculate age
            $birthDate = Carbon::parse($validated['birth_date']);
            $validated['age'] = $birthDate->age;

            // Create student record
            $student = StudentDetail::create($validated);

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
