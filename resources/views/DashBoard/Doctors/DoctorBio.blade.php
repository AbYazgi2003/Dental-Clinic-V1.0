@extends('DashBoard.doctorMasterPage')
@section('PageContent')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>الصفحة الشخصية للدكتور</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="bg-light text-right">

<div class="container mt-5">

    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body text-center">

            <!-- صورة شخصية -->

            <img src="{{asset('storage/'. Auth::user()->doctor->img)}}"
                class="rounded-circle mb-3"
                width="150"
                height="150"
                alt="صورة الدكتور">

            <!-- الاسم -->
            <h3>{{ Auth::user()->name }}</h3>


            <h5 class="text-muted">
                تخصص: {{ Auth::user()->doctor->department->name ?? 'غير محدد' }}
            </h5>

            <hr>

            <!-- السيرة الذاتية -->
            <h5>السيرة الذاتية</h5>
            <p id="doctorBio">
                {{ Auth::user()->doctor->bio ?? Auth::user()->bio ?? 'لا توجد سيرة ذاتية' }}
            </p>

            <!-- البريد الإلكتروني -->
            <div class="mt-3">
                <strong>البريد الإلكتروني:</strong>
                <p>{{ Auth::user()->email }}</p>
            </div>

            <!-- زر تعديل -->
            <a class="btn btn-primary mt-3" href={{route('doctor.doctorEdit', Auth::user()->doctor->id)}}>تعديل المعلومات</a>
        </div>
    </div>
</div>

@endsection
