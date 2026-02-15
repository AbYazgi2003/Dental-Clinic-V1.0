@extends('Patient.PatientMasterPage')
@section('items')
@foreach ($departments as $dep)
<a class="collapse-item" href="{{route('patient.departments',$dep->id)}}">{{$dep->name}}</a>
@endforeach
@endsection

@section('PageContent')

<table class="table table-hover table-striped table-borderd">
    <tr class="table-dark text-white">
        <th>Doctor</th>
        <th>department</th>
        <th>Date</th>
        <th>time from</th>
        <th>time to</th>

    </tr>
    @foreach ($BookedAppointments as $BookedAppointment)

    <tr>
        <th>{{ $BookedAppointment->availableTimes->doctor->user->name }}</th>
        <th>{{ $BookedAppointment->availableTimes->doctor->department->name }}</th>
        @php
    $dateTime = \Carbon\Carbon::parse(
        $BookedAppointment->availableTimes->date . ' ' .
        $BookedAppointment->availableTimes->time_from
    );

    $now = \Carbon\Carbon::now();
@endphp

<th>
    @if($dateTime->isSameDay($now))

        @if($dateTime->isFuture())
            @php
                $diffInSeconds = $now->diffInSeconds($dateTime);

                $hours = floor($diffInSeconds / 3600);
                $minutes = floor(($diffInSeconds % 3600) / 60);
            @endphp

            اليوم بعد {{ $hours }} ساعة
            @if($minutes > 0)
                و {{ $minutes }} دقيقة
            @endif

        @else
            منتهي
        @endif

    @elseif($dateTime->isTomorrow())
        غداً

    @elseif($dateTime->isFuture())
        بعد {{ $now->startOfDay()->diffInDays($dateTime->startOfDay()) }} أيام

    @else
        منتهي
    @endif
</th>
    </th>
        <th>{{ $BookedAppointment->availableTimes->time_from }}</th>
        <th>{{ $BookedAppointment->availableTimes->time_to }}</th>
    </tr>
@endforeach
</table>

@endsection
