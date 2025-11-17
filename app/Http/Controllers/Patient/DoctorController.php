<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::with(['user', 'specialization']);

        if ($request->filled('specialization')) {
            $query->where('specialization_id', $request->specialization);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $doctors = $query->get();
        $specializations = Specialization::all();

        return view('patient.doctors.index', compact('doctors', 'specializations'));
    }

    public function show(Doctor $doctor)
    {
        $doctor->load(['user', 'specialization', 'schedules']);
        return view('patient.doctors.show', compact('doctor'));
    }
}