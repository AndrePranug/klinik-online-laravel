<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'upcoming_appointments' => Appointment::where('user_id', $user->id)
                ->where('appointment_date', '>=', Carbon::today())
                ->where('status', '!=', 'cancelled')
                ->count(),
            'completed_appointments' => Appointment::where('user_id', $user->id)
                ->where('status', 'completed')
                ->count(),
            'cancelled_appointments' => Appointment::where('user_id', $user->id)
                ->where('status', 'cancelled')
                ->count(),
        ];

        $recent_appointments = Appointment::with(['doctor.user', 'doctor.specialization'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $next_appointment = Appointment::with(['doctor.user', 'doctor.specialization'])
            ->where('user_id', $user->id)
            ->where('appointment_date', '>=', Carbon::today())
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->first();

        return view('patient.dashboard', compact('stats', 'recent_appointments', 'next_appointment'));
    }
}