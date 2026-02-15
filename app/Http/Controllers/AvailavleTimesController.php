<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AvailableTimes;
use Illuminate\Support\Facades\Auth;

class AvailavleTimesController extends Controller
{
    

public function store(Request $request)
{
    $request->validate([
        'workDays' => 'required|array',
        'startTime' => 'required',
        'endTime' => 'required',
    ]);

    $doctor_id = Auth::user()->doctor->id;

    $startTime = Carbon::createFromFormat('H:i', $request->startTime);
    $endTime = Carbon::createFromFormat('H:i', $request->endTime);

    $weekStart = Carbon::now()->startOfWeek(Carbon::SATURDAY);

    $duplicateSlots = [];

    foreach ($request->workDays as $dayIndex) {

        $dayIndex = (int) $dayIndex;
        $date = $weekStart->copy()->addDays($dayIndex);

        $currentTime = $startTime->copy();

        while ($currentTime->lt($endTime)) {

            $timeFrom = $currentTime->format('H:i:s');
            $currentTime->addMinutes(30);
            $timeTo = $currentTime->format('H:i:s');

            // 🔍 فحص إذا الموعد موجود
            $exists = AvailableTimes::where('doctor_id', $doctor_id)
                ->where('date', $date->format('Y-m-d'))
                ->where('time_from', $timeFrom)
                ->exists();

            if ($exists) {
                $duplicateSlots[] = $date->format('Y-m-d') . ' ' . $timeFrom;
                continue;
            }

            AvailableTimes::create([
                'doctor_id' => $doctor_id,
                'date' => $date->format('Y-m-d'),
                'time_from' => $timeFrom,
                'time_to' => $timeTo,
            ]);
        }
    }

    if (!empty($duplicateSlots)) {
        return back()->withErrors([
            'duplicate' => 'المواعيد التالية موجودة مسبقاً: ' . implode(', ', $duplicateSlots)
        ]);
    }

    return back()->with('success', 'تم توليد المواعيد بنجاح!');
}
}
