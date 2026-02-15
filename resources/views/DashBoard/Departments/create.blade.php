@extends('DashBoard.masterPage')

@section('pageTitle')
Departments
@endsection


@section('PageContent')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <H1 class="m-0">Add new Department</H1>

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


<form action="{{route('departments.store')}}" method="post">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name"placeholder="Name" class="form-control" maxlength="30" minlength="10">
        </div>



        <div class="mb-3">
        <label>Description</label>
        <input type="text" name="description" placeholder="Description ...." class="form-control" />
        </div>
    <button class="btn btn-success">Add</button>
</form>
@endsection
