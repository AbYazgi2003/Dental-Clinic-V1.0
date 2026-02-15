@extends('DashBoard.masterPage')

@section('pageTitle')
Edit Department
@endsection

@section('PageContent')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <h1 class="m-0">Edit Department</h1>
    <a href="{{ route('departments.index') }}" class="btn btn-outline-primary">Return Back</a>
</div>

{{-- عرض الأخطاء --}}
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

<form action="{{ route('departments.update', $department->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control"
               value="{{ old('name', $department->name) }}">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <input type="text" name="description" placeholder="Description ...." class="form-control"
               value="{{ old('description', $department->description) }}">
    </div>

    <button class="btn btn-success" onsubmit="return confirm('هل أنت متأكد حفظ التعديلات؟');">Update</button>
</form>
@endsection
