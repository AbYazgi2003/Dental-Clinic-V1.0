<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOperationsController extends Controller
{
    public function index()
    {
        $doctorsCount = User::where('role', 'doctor')->count();
        $patientsCount = User::where('role', 'patient')->count();
        $departmentsCount = Department::count();
        $appointmentsCount = Appointments::count();

        return view('DashBoard.AdminMainPage', compact(
            'doctorsCount',
            'patientsCount',
            'departmentsCount',
            'appointmentsCount'
        ));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'تم تسجيل الخروج بنجاح!');
    }
}
