<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('DashBoard.Departments.index', compact('departments'));
    }


    public function create()
    {
        return view('DashBoard.Departments.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:departments,name',
            'description' => 'required'
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('departments.index')
        ->with('success', 'تم إضافة القسم بنجاح');
    }


    // public function show(string $id)
    // {
    //     //
    // }


    public function edit(Department $department)
{
    return view('DashBoard.Departments.edit', compact('department'));
}

public function update(Request $request, Department $department)
{
    $request->validate([
        'name' => 'required|unique:departments,name,' . $department->id,
        'description' => 'required'
    ]);

    $department->update([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('departments.index')->with('success', 'تم تعديل القسم بنجاح');
}


public function destroy($id)
{
    $department = Department::findOrFail($id);

    $generalDepartment = Department::where('name', 'قسم طب الأسنان العام')->first();

    if (!$generalDepartment) {
        return back()->with('error', 'General department not found');
    }

    $department->doctors()->update([
        'department_id' => $generalDepartment->id
    ]);

    $department->delete();

    return back()->with('success', 'Department deleted successfully');
}
}
