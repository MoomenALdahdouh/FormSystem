<x-app-layout>
    <x-slot name="header">
        <h2 class="home-section font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="header-section">
        <div class="container">
            <div class="row">
                <div class="card-style col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                            <div class="mr-5">26 New Messages!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                                   <i class='bx bxs-bar-chart-alt-2'></i>
                        </span>
                        </a>
                    </div>
                </div>
                <div class="card-style col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                            <div class="mr-5">11 New Tasks!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class='bx bxs-bar-chart-alt-2'></i>
              </span>
                        </a>
                    </div>
                </div>
                <div class="card-style col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                            <div class="mr-5">123 New Orders!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class='bx bxs-bar-chart-alt-2'></i>
              </span>
                        </a>
                    </div>
                </div>
                <div class="card-style col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                            <div class="mr-5">13 New Tickets!</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class='bx bxs-bar-chart-alt-2'></i>
              </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </div>


</x-app-layout>
