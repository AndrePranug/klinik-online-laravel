<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // COUNT USER DENGAN ROLE "patient"
            'total_patients' => User::role('patient')->count(),

            // COUNT DOCTOR MODEL
            'total_doctors' => Doctor::count(),

            // COUNT APPOINTMENTS
            'total_appointments' => Appointment::count(),

            // COUNT APPOINTMENT STATUS
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
        ];

        $recent_appointments = Appointment::with(['user', 'doctor.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_appointments'));
    }
}
