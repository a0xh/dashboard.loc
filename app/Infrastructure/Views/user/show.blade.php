@extends('layouts.main')

@section('title', trans('Просмотр пользователя'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endpush

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">

        <x-heading />

        <div class="row g-3 mb-xl-3">
            <div class="col-xxl-4 col-xl-12 col-lg-12 col-md-12">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-1 row-deck g-3">
                    <div class="col">
                        <div class="card profile-card">

                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold">Профиль</h6>
                            </div>

                            <div class="card-body d-flex profile-fulldeatil flex-column">
                                <div class="profile-block text-center w220 mx-auto">
                                    @isset ($user->media)
                                        <a href="{{ Storage::url($user->media) }}">
                                            <img src="{{ Storage::url($user->media) }}" class="avatar xl rounded img-thumbnail shadow-sm">
                                        </a>
                                    @else
                                        <a href="{{ Storage::url($user->media) }}">
                                            <img src="{{ asset('assets/img/user.png') }}" class="avatar xl rounded img-thumbnail shadow-sm">
                                        </a>
                                    @endisset

                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                        <span class="text-muted small">
                                            @isset($user->id)
                                                @if ($user->id <= 9)
                                                    ID: #PX-0000{{ $user->id }}
                                                @elseif ($user->id >= 10)
                                                    ID: #PX-000{{ $user->id }}
                                                @elseif ($user->id >= 100)
                                                    ID: #PX-00{{ $user->id }}
                                                @elseif ($user->id >= 1000)
                                                    ID: #PX-0{{ $user->id }}
                                                @else ($user->id >= 1000)
                                                    ID: #PX-{{ $user->id }}
                                                @endif
                                            @endisset
                                        </span>
                                    </div>
                                </div>

                                <div class="profile-info w-100">
                                    <h6  class="mb-0 mt-2  fw-bold d-block fs-6 text-center">
                                        {{ $user->first_name ?? null }} {{ $user->last_name ?? null }}
                                    </h6>

                                    @isset ($user->roles)
                                        @foreach ($user->roles as $role)
                                            <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">{{ $role->name }}</span>
                                        @endforeach
                                    @endisset

                                    <div class="row g-2 pt-2">
                                        <div class="col-xl-12">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-ui-touch-phone"></i>
                                                <span class="ms-2">IP: {{ $user->data->ip_address ?? null }}</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-email"></i>
                                                <span class="ms-2">{{ $user->email ?? null }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Expence Count</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-end text-center">
                                    <div class="p-2">
                                        <h6 class="mb-0 fw-bold">$1790</h6>
                                        <span class="text-muted">Total</span>
                                    </div>
                                    <div class="p-2 ms-4">
                                        <h6 class="mb-0 fw-bold">$149.16</h6>
                                        <span class="text-muted">Avg Month</span>
                                    </div>
                                </div>
                                <div id="apex-circle-gradient"></div>
                                <div class="row">
                                    <div class="col">
                                        <span class="mb-3 d-block">Food</span>
                                        <div class="progress-bar  bg-secondary" role="progressbar" style="width: 55%; height: 5px;"></div>
                                        <span class="mt-2 d-block text-secondary">$597 spend</span>
                                    </div>
                                    <div class="col">
                                        <span class="mb-3 d-block">Cloth</span>
                                        <div class="progress-bar  bg-primary" role="progressbar" style="width: 60%; height: 5px;"></div>
                                        <span class="mt-2 d-block text-primary">$845 spend</span>
                                    </div>
                                    <div class="col">
                                        <span class="mb-3 d-block">Other</span>
                                        <div class="progress-bar  bg-lavender-purple" role="progressbar" style="width: 70%; height: 5px;"></div>
                                        <span class="mt-2 d-block color-lavender-purple">$348 spend</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                        <h6 class="mb-0 fw-bold">Status report</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">54</h6>
                                    <span class="small text-muted">Product Visit</span>
                                </div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="87" data-transitiongoal="87"  style="width: 87%;"></div>
                                </div>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">27</h6>
                                    <span class="small text-muted">Product Buy</span>
                                </div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="34" data-transitiongoal="34"  style="width: 34%;"></div>
                                </div>
                            </li>
                            <li class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">102</h6>
                                    <span class="small text-muted">Comment on Product</span>
                                </div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="14" data-transitiongoal="14"  style="width: 14%;"></div>
                                </div>
                            </li>
                            <li class="mb-0">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="mb-0">1024 Hours</h6>
                                    <span class="small text-muted">Total spent time</span>
                                </div>
                                <div class="progress" style="height: 2px;">
                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="67" data-transitiongoal="67"  style="width: 67%;"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> 
            </div>

            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12">
                <div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-2 row-deck"> 
                    <div class="col">
                        <div class="card auth-detailblock">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold">Delivery Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Block Number:</label>
                                        <span><strong>A-510</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Address:</label>
                                        <span><strong>81 Fulton London</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Pincode:</label>
                                        <span><strong>385467</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Phone:</label>
                                        <span><strong>202-458-4568</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold">Billing Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Block Number:</label>
                                        <span><strong>A-510</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Address:</label>
                                        <span><strong>81 Fulton London</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Pincode:</label>
                                        <span><strong>385467</strong></span>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label col-6 col-sm-5">Phone:</label>
                                        <span><strong>202-458-4568</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/libscripts.bundle.js') }}"></script>

    <script src="{{ asset('assets/js/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bundle.js') }}"></script>

    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#orders').addClass('nowrap').dataTable({
                responsive: true,
                columnDefs: [
                    {
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }
                ]
            });
        });
    </script>
@endpush