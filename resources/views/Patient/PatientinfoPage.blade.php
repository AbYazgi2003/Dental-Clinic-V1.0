@extends('Patient.PatientMasterPage')

@section('items')
@foreach ($departments as $dep)
<a class="collapse-item" href="{{route('patient.departments',$dep->id)}}">{{$dep->name}}</a>
@endforeach
@endsection

@section('PageContent')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>الصفحة الشخصية للمريض</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light text-right">

<div class="container mt-5">

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">



            <strong>مرحبا {{ Auth::user()->name }}</strong>
            <h3></h3>

            <!-- البريد الإلكتروني -->
            <div class="mt-3">
                <strong>البريد الإلكتروني:</strong>
                <p>{{ Auth::user()->email }}</p>
            </div>


            <h5 class="text-muted">
                العمر: {{ Auth::user()->patient->age }}
            </h5>
            <hr>


            <!-- زر تعديل -->
            <a class="btn btn-primary mt-3" href="#">تعديل المعلومات</a>
        </div>
    </div>
</div>

@endsection


