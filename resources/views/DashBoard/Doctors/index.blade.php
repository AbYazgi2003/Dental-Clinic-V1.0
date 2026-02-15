@extends('DashBoard.masterPage')

@section('pageTitle')
Appointments
@endsection

@section('PageContent')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <H1 class="m-0">All Doctors</H1>
    <a href="{{route('doctors.create')}}" class="btn btn-outline-primary">Add NEW Doctor</a>
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
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif
<table class="table table-hover table-striped table-borderd">
    <tr class="table-dark text-white">
        <th>ID</th>
        <th>image</th>
        <th>name</th>
        <th>email</th>
        <th>created-at</th>
        <th>Actions</th>
    </tr>
    @foreach ($doctors as $doctor)
    <tr>
        <th>{{$doctor->id}}</th>
        <th><img src="{{ asset('storage/' . $doctor->img) }}" width="50" height="50"></th>
        <th>{{$doctor->user->name}}</th>
        <th>{{$doctor->user->email}}</th>
        <td>{{ $doctor->created_at->format('Y-m') }}</td>
        <td class="d-flex gap-2">
            <a href="{{ route('doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary">Edit</a>

            <form action="{{ route('doctors.destroy', $doctor->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا ألدكتور');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
