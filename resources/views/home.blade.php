<x-app-layout>
    <x-slot name="header_2">
        <br>
        <h1 class="home-section font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h1>
    </x-slot>
    <div class="header-section">
        <div class="container">
            <div class="row section-one">
                <div class="col-sm-12 col-md-4 col-lg-4 col-one">
                    <div class="card">
                        <ul class="list-group group-one">
                            <li class="alert-success">
                                {{--Larapex chart--}}
                                <div class="pt-3">
                                    {!! $chart->container() !!}
                                </div>
                                <br>
                                <br>
                            </li>
                            <li class="list-item-two">
                                <div class="row">
                                    <div class="card-style col-sm-6 col-md-6 col-lg-6  ">
                                        <div class="card text-white bg-primary o-hidden h-75">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class='bx bxs-bar-chart-alt-2'></i>
                                                </div>
                                                <div class="mr-5">26 New Messages!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-style col-sm-6 col-md-6 col-lg-6  ">
                                        <div class="card text-white bg-warning o-hidden h-75">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class='bx bxs-bar-chart-alt-2'></i>
                                                </div>
                                                <div class="mr-5">11 New Tasks!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-style col-sm-6 col-md-6 col-lg-6  ">
                                        <div class="card text-white bg-success o-hidden h-75">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class='bx bxs-bar-chart-alt-2'></i>
                                                </div>
                                                <div class="mr-5">123 New Orders!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-style col-sm-6 col-md-6 col-lg-6  ">
                                        <div class="card text-white bg-danger o-hidden h-75">
                                            <div class="card-body">
                                                <div class="card-body-icon">
                                                    <i class='bx bxs-bar-chart-alt-2'></i>
                                                </div>
                                                <div class="mr-5">13 New Tickets!</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-two">
                    <div class="caaa card">

                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4 col-three">
                    <div class="card">

                    </div>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>
    <br>
    <br>
    {{--Statistics--}}
    <div class="header-section">
        <div class="container">
            <div class="row">

            </div>
        </div>
    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</x-app-layout>

