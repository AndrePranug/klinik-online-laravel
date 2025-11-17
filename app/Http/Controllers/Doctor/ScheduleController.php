<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $doctor = auth()->user()->doctor;
        $schedules = Schedule::where('doctor_id', $doctor->id)->get();

        return view('doctor.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('doctor.schedules.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration' => 'required|integer|min:15|max:120',
        ]);

        $doctor = auth()->user()->doctor;

        Schedule::create([
            'doctor_id' => $doctor->id,
            'day' => $validated['day'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'slot_duration' => $validated['slot_duration'],
        ]);

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(Schedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        return view('doctor.schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        $validated = $request->validate([
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration' => 'required|integer|min:15|max:120',
        ]);

        $schedule->update($validated);

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil diupdate.');
    }

    public function destroy(Schedule $schedule)
    {
        if ($schedule->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }

        $schedule->delete();

        return redirect()->route('doctor.schedules.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}