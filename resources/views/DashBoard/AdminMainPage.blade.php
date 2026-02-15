@extends('DashBoard.masterPage')

@section('pageTitle')
Main Page
@endsection

@section('PageContent')

<div class="row">

    <!-- Departments -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start border-primary border-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                        # of Departments
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">
                        {{ $departmentsCount }}
                    </div>
                </div>
                <i class="fas fa-building fa-2x text-secondary"></i>
            </div>
        </div>
    </div>

    <!-- Doctors -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start border-success border-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs fw-bold text-success text-uppercase mb-1">
                        # of Doctors
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">
                        {{ $doctorsCount }}
                    </div>
                </div>
                <i class="fas fa-user-md fa-2x text-secondary"></i>
            </div>
        </div>
    </div>

    <!-- Patients -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start border-warning border-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                        # of Patients
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">
                        {{ $patientsCount }}
                    </div>
                </div>
                <i class="fas fa-users fa-2x text-secondary"></i>
            </div>
        </div>
    </div>

    <!-- Appointments -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card shadow h-100 py-2 border-start border-danger border-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                        # of Booked Appointments
                    </div>
                    <div class="h5 mb-0 fw-bold text-dark">
                        {{ $appointmentsCount }}
                    </div>
                </div>
                <i class="fas fa-calendar-check fa-2x text-secondary"></i>
            </div>
        </div>
    </div>

</div>

@endsection
