<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\AvailableTimes;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorOperationsController extends Controller
{

public function Bio (){
    return view('DashBoard.Doctors.DoctorBio');
}


public function Appointments (){
    return view('DashBoard.Doctors.DoctorPage');
}


public function BookedAppointments (){

    $Appointments = AvailableTimes::with('appointments.patient.user')
    ->where('doctor_id', Auth::user()->doctor->id)
    ->where('is_reserved', 1)
    ->get();
    $patients = Patient::all();
    return view('DashBoard.Doctors.BookedAppointments',compact('Appointments','patients'));
}

public function doctorEdit(string $id)
{
    $departments = Department::all();
    return view('DashBoard.Doctors.doctoredit', compact(['doctor','departments']));
}

public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'تم تسجيل الخروج بنجاح!');
    }

}
