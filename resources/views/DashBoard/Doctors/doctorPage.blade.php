@extends('DashBoard.doctormasterPage')

@section('PageContent')

<div class="container mt-5">

    <!-- ترحيب -->
    <div class="jumbotron text-center">
        <h1 class="display-4">مرحبا {{ Auth::user()->name }}</h1>
        <p class="lead">هنا يمكنك إدارة جدول المواعيد للأسبوع الحالي</p>
    </div>

    <!-- رسائل النجاح -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- رسالة التكرار -->
    @error('duplicate')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror

    <!-- أخطاء الفاليديشن -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- الكارد -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            معلومات العمل
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('appointments.store') }}">
                @csrf

                <!-- أيام العمل -->
                <div class="form-group mb-3">
                    <label for="workDays">أيام العمل لهذا الأسبوع</label>
                    <select multiple class="form-control" id="workDays" name="workDays[]">

                        @php
                            $days = ['السبت','الأحد','الاثنين','الثلاثاء','الأربعاء','الخميس'];
                        @endphp

                        @foreach($days as $index => $day)
                            <option value="{{ $index }}"
                                {{ (collect(old('workDays'))->contains($index)) ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach

                    </select>
                    <small class="form-text text-muted">
                        اضغط Ctrl أو Cmd لاختيار أكثر من يوم
                    </small>
                </div>

                <!-- وقت البداية -->
                <div class="form-group mb-3">
                    <label for="startTime">ساعات العمل من</label>
                    <input type="time"
                           class="form-control"
                           id="startTime"
                           name="startTime"
                           value="{{ old('startTime') }}">
                </div>

                <!-- وقت النهاية -->
                <div class="form-group mb-3">
                    <label for="endTime">ساعات العمل إلى</label>
                    <input type="time"
                           class="form-control"
                           id="endTime"
                           name="endTime"
                           value="{{ old('endTime') }}">
                </div>

                <button type="submit" class="btn btn-success w-100">
                    توليد المواعيد
                </button>

            </form>
        </div>
    </div>

</div>

@endsection
