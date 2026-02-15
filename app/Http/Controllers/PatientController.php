<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\AvailableTimes;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class PatientController extends Controller
{

    public function Bio()
    {
        $departments = Department::all();
        return view('Patient.PatientinfoPage', compact('departments'));
    }

    public function department(string $id)
    {
        $departments = Department::all();
        $department = Department::where('id', $id)->firstOrFail();
        return view('Patient.department', compact(['departments', 'department']));
    }

    public function getDoctorTimes($id)
    {
        $times = AvailableTimes::where('doctor_id', $id)
            ->where('is_reserved', 0)
            ->get();

        return response()->json($times);
    }

    public function reservation(Request $request ){
        $selectedavailableTime = AvailableTimes::findOrFail($request->available_time_id);
        $selectedavailableTime->is_reserved =1;
        $selectedavailableTime->save();

        Appointments::create([
            'patient_id' => $request->patient_id,
            'available_time_id' => $request->available_time_id

        ]);
        return redirect()->back()->with('success', 'تم حجز الموعد بنجاح');
    }

    public function showBookedAppointments(){
        $departments = Department::all();
        $BookedAppointments = Appointments::where('patient_id', Auth::id())
            ->with('availableTimes.doctor.user', 'availableTimes.doctor.department')
            ->get();
        return view('Patient.BookedAppointments', compact('BookedAppointments', 'departments'));
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'تم تسجيل الخروج بنجاح!');
    }
}
