@extends('Patient.PatientMasterPage')
@section('items')
@foreach ($departments as $dep)
<a class="collapse-item" href="{{route('patient.departments',$dep->id)}}">{{$dep->name}}</a>
@endforeach
@endsection

@section('PageContent')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow">

                <!-- عنوان البطاقة -->
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">{{$department->name}}</h4>
                </div>

                <div class="card-body">

                    <!-- نبذة عن القسم -->
                    <p class="card-text">
                        {{$department->description}}
                    </p>

                    <hr>

                    <div class="form-group">
                        <label>الأطباء</label>
                        <select class="form-control" id="doctorSelect">
                            <option value="">اختر الطبيب</option>
                            @foreach ($department->doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- المواعيد المتاحة -->

                    <form action="{{route('reservation')}}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label>المواعيد المتاحة</label>
                        <select class="form-control" id="appointmentsSelect" name="available_time_id">
                            <option value="">اختر الطبيب أولاً</option>
                        </select>
                    </div>

                        <input type="hidden" name="patient_id" value="{{Auth::user()->id}}">


                        <button class="btn btn-success btn-block"> حجز الموعد </button>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
document.getElementById('doctorSelect').addEventListener('change', function() {

    let doctorId = this.value;
    let appointmentsSelect = document.getElementById('appointmentsSelect');

    appointmentsSelect.innerHTML = '<option>جارٍ التحميل...</option>';

    if(doctorId){

        fetch('/get-doctor-times/' + doctorId)
        .then(response => response.json())
        .then(data => {

            let options = '<option value="">اختر الموعد</option>';

            if(data.length > 0){
                data.forEach(function(time){
                    options += `<option value="${time.id}">
                        ${time.date} | ${time.time_from} - ${time.time_to}
                    </option>`;
                });
            } else {
                options += '<option>لا توجد مواعيد متاحة</option>';
            }

            appointmentsSelect.innerHTML = options;

        });

    } else {
        appointmentsSelect.innerHTML = '<option>اختر الطبيب أولاً</option>';
    }

});
</script>
@endsection
