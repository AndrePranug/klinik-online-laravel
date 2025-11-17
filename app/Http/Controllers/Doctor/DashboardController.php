<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->doctor;

        $stats = [
            'today_appointments' => Appointment::where('doctor_id', $doctor->id)
                ->whereDate('appointment_date', Carbon::today())
                ->count(),
            'pending_appointments' => Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'pending')
                ->count(),
            'completed_appointments' => Appointment::where('doctor_id', $doctor->id)
                ->where('status', 'completed')
                ->count(),
        ];

        $today_appointments = Appointment::with('user')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', Carbon::today())
            ->orderBy('appointment_time')
            ->get();

        $upcoming_appointments = Appointment::with('user')
            ->where('doctor_id', $doctor->id)
            ->where('appointment_date', '>', Carbon::today())
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        return view('doctor.dashboard', compact('stats', 'today_appointments', 'upcoming_appointments'));
    }
}