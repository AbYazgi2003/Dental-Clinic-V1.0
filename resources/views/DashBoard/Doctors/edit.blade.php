@extends('DashBoard.masterPage')

@section('pageTitle')
Edit doctor
@endsection


@section('PageContent')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <H1 class="m-0">EDIT  Doctor name</H1>

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

<form action="{{ route('doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" value="{{ old('name',$doctor->user->name)}}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" placeholder="Email" class="form-control" value="{{ old('email',$doctor->user->email)}}"  required>
    </div>

    <div class="mb-3">
        <label>Phone</label>
        <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ old('phone',$doctor->phone)}}"   required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="text" name="password" placeholder="Password" class="form-control" value="{{ old('password')}}" >
    </div>


    <div class="mb-3">
        <label>Department</label>
        <select name="department_id" class="form-control" required>
            <option value="">اختر القسم</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}"
                    {{ old('department_id', $doctor->department_id) == $department->id ? 'selected' : '' }}>
                    {{ $department->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="image">Image Upload</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>

    <div class="mb-3">
        <label for="bio">BIO</label>
        <textarea class="form-control" id="bio" name="bio" rows="3" required>
            value="{{ old('bio',$doctor->bio)}}"
        </textarea>
    </div>

    <button class="btn btn-success">Edit</button>
</form>
@endsection
