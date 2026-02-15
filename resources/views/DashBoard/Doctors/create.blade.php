@extends('DashBoard.masterPage')

@section('pageTitle')
Add doctor
@endsection


@section('PageContent')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <H1 class="m-0">Add new Doctor</H1>

    <a href="#" onclick="history.back()" class="btn btn-outline-primary">return back</a>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('doctors.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="Phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="text" name="password" placeholder="Password" class="form-control" required>
    </div>


    {{-- Dropdown الأقسام --}}
    <div class="mb-3">
        <label>Department</label>
        <select name="department_id" class="form-control" required>
            <option value="">اختر القسم</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="image">Image Upload</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <div class="mb-3">
        <label for="bio">BIO</label>
        <textarea class="form-control" id="bio" name="bio" rows="3" required></textarea>
    </div>

    <button class="btn btn-success">Add</button>
</form>
@endsection
