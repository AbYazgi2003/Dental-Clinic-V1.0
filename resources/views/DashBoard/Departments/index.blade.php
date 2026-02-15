@extends('DashBoard.masterPage')

@section('pageTitle')
Departments
@endsection

@section('PageContent')

<div class="mb-4 d-flex justify-content-between align-items-center">
    <H1 class="m-0">All departments</H1>
    <a href="{{route('departments.create')}}" class="btn btn-outline-primary">Add NEW</a>
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

<table class="table table-hover table-striped table-borderd">
    <tr class="table-dark text-white">
        <th>ID</th>
        <th>Eng-name</th>
        <th>descripton</th>
        <th>created-at</th>
        <th>Actions</th>
    </tr>
    @foreach ($departments as $dep)
<tr>
    <th>{{ $dep->id }}</th>
    <th>{{ $dep->name }}</th>
    <th>{{ $dep->description }}</th>
    <td>{{ $dep->created_at->format('Y-m') }}</td>

    <td class="d-flex gap-2">

        @if ($dep->id != 1)
            <a href="{{ route('departments.edit', $dep->id) }}"
               class="btn btn-sm btn-primary">Edit</a>

            <form action="{{ route('departments.destroy', $dep->id) }}"
                  method="POST"
                  onsubmit="return confirm('هل أنت متأكد من حذف هذا القسم؟');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="btn btn-sm btn-danger">Delete</button>
            </form>
        @else
            <span class="badge bg-secondary">Protected</span>
        @endif

    </td>
</tr>
@endforeach
</table>
@endsection
