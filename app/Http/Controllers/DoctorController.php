<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{

    public function index()
    {
        $doctors = Doctor::all();

        return view('DashBoard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('DashBoard.Doctors.create',compact('departments'));
    }

    public function store(Request $request)
{
    // dd($request->all());
    $request->validate([
        'name' => 'required|string|unique:users,name|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:4',
        'department_id' => 'required',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'bio' => 'nullable|string',
        'phone'=>'required'
    ]);

    return DB::transaction(function () use ($request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
        ]);



        $path = "no-img.png";
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('uploads/images', 'public');
        }

        // إنشاء سجل الدكتور وربطه بالـ user_id

        $user->doctor()->create([
            'bio' => $request->bio,
            'department_id' =>3,
            'img' => $path,
            'phone'=>$request->phone
        ]);

        return redirect()->back()->with('success', 'تم إضافة الطبيب بنجاح');
    });
}


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
{
    $departments = Department::all();
    $doctor = Doctor::where('id', $id)->firstOrFail();
    return view('DashBoard.Doctors.edit', compact(['doctor','departments']));
}


public function update(Request $request, $id)
{
    $doctor = Doctor::findOrFail($id);
    $user = $doctor->user;

    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required',
        'department_id' => 'required',
        'bio' => 'nullable',
        'image' => 'nullable|image',
        'password' => 'nullable|min:4'
    ]);

    $user->name = $data['name'];
    $user->email = $data['email'];

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    $doctor->phone = $data['phone'];
    $doctor->department_id = $data['department_id'];
    $doctor->bio = $data['bio'];


    $doctor->save();

    return redirect()->back()->with('success', 'تم التحديث بنجاح');
}

public function destroy($id)
{
    try {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return redirect()->back()->with('success', 'تم الحذف بنجاح');

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'حدث خطأ أثناء الحذف'
        ], 500);
    }
}
}
