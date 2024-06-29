<a href="javascript:void(0);" class="nav-link dropdown-toggle pulse" role="button" data-bs-toggle="dropdown">
    <i class="icofont-alarm fs-5"></i>
    <span class="pulse-ring"></span>
</a>

<div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
    <div class="card border-0 w380">
        <div class="card-header border-0 p-3">
            <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                <span>Уведомления</span>
                <span class="badge text-white">06</span>
            </h5>
        </div>

        <div class="tab-content card-body">
            <div class="tab-pane fade show active">
                <ul class="list-unstyled list mb-0">
                    <li class="py-2 mb-1 border-bottom">
                        <a href="javascript:void(0);" class="d-flex">
                            
                            @if (File::exists('assets/img/avatar/user-1.svg'))
                                <img src="{{ asset('assets/img/avatar/user-1.svg') }}" class="avatar rounded-circle">
                            @else
                                <div class="avatar rounded-circle no-thumbnail">AH</div>
                            @endif

                            <div class="flex-fill ms-2">
                                <p class="d-flex justify-content-between mb-0">
                                    <span class="font-weight-bold">Chloe Walkerr</span>
                                    <small>2MIN</small>
                                </p>
                                <span>Added New Product 2021-07-15
                                    <span class="badge bg-success">Add</span>
                                </span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>

    </div>
</div>