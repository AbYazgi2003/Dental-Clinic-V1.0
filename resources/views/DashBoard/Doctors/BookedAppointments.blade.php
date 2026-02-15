@extends('DashBoard.doctormasterPage')
@section('PageContent')
<div class="container mt-5">
    <!-- ترحيب -->
    <div class="jumbotron text-center">
        <h1 class="display-4">المواعيد المحجوزة</h1>
        <p class="lead">هنا يمكنك عرض كل المواعيد المحجوزة للعيادة</p>
    </div>

    <!-- جدول المواعيد -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            قائمة المواعيد
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>اليوم</th>
                        <th>الساعةمن</th>
                        <th>الساعةالى</th>
                        <th>اسم المريض</th>
                    </tr>
                </thead>
                <tbody id="bookedAppointments">
                    <!-- هنا نضيف المواعيد المحجوزة -->
                    @foreach ($Appointments as $BA)
                    <tr>
                        <td>{{$BA->date}}</td>
                        <td>{{$BA->time_from}}</td>
                        <td>{{$BA->time_to}}</td>
                        {{-- <td>{{$BA->appointments->patient_id }}</td> --}}
                        <td>@foreach ($patients as $pat)
                           @if($pat->user_id == $BA->appointments->patient_id )
                           {{$pat->user->name}}
                           @endif
                        @endforeach</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
