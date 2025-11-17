<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(Request $request)
{
    $query = Appointment::with(['doctor.user', 'doctor.specialization'])
        ->where('user_id', auth()->id())
        ->latest();

    // filter status
    if ($request->has('status') && $request->status !== null) {
        $status = $request->status;

        // hanya izinkan status yang valid
        if (in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            $query->where('status', $status);
        }
    }

    $appointments = $query->paginate(10);

    return view('patient.appointments.index', compact('appointments'));
}


    public function create(Request $request)
    {
        $doctor = null;
        if ($request->filled('doctor_id')) {
            $doctor = Doctor::with(['user', 'specialization', 'schedules'])->findOrFail($request->doctor_id);
        }

        return view('patient.appointments.create', compact('doctor'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'complaint' => 'required|string',
        ]);

        // Generate queue number
        $date = Carbon::parse($validated['appointment_date']);
        $existingCount = Appointment::where('doctor_id', $validated['doctor_id'])
            ->whereDate('appointment_date', $date)
            ->count();

        $queueNumber = 'Q-' . $date->format('Ymd') . '-' . str_pad($existingCount + 1, 3, '0', STR_PAD_LEFT);

        Appointment::create([
            'user_id' => auth()->id(),
            'doctor_id' => $validated['doctor_id'],
            'queue_number' => $queueNumber,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'complaint' => $validated['complaint'],
            'status' => 'pending',
        ]);

        return redirect()->route('patient.appointments.index')
            ->with('success', 'Janji temu berhasil dibuat. Nomor antrian: ' . $queueNumber);
    }

    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        $appointment->load(['doctor.user', 'doctor.specialization']);
        return view('patient.appointments.show', compact('appointment'));
    }

    public function cancel(Appointment $appointment)
    {
        if ($appointment->user_id !== auth()->id()) {
            abort(403);
        }

        if ($appointment->status === 'completed') {
            return back()->with('error', 'Tidak dapat membatalkan janji temu yang sudah selesai.');
        }

        $appointment->update(['status' => 'cancelled']);

        return back()->with('success', 'Janji temu berhasil dibatalkan.');
    }
}