<x-app-layout>
    <x-slot name="header_2">
        <br>
        <h1 class="home-section font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h1>
    </x-slot>

    {{--//TODO:: MOOMEN S. ALDAHDOUH 11/15/2021--}}

    <div class="header-section">
        <div class="container">
            <div class=" row section-one">
                <div class="col-sm-12 col-md-4 col-lg-4 col-one">
                    <ul class="main-ul">
                        <li>
                            <ul class="group-one">
                                <li class="list-one">
                                    {{--Larapex chart--}}
                                    <div class="pt-3">
                                        {!! $chart->container() !!}
                                    </div>
                                    <br>
                                    <br>
                                </li>
                                <li class="list-item-two">
                                    <div class="row">
                                        <div class="h-75 card-style-1 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bx-folder'></i>
                                            <div class="mr-5">
                                                <p>Projects</p>
                                                <p>{{count($projects)}}</p>
                                            </div>
                                        </div>
                                        <div class="h-75 card-style-2 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bx-file'></i>
                                            <p>Subprojects</p>
                                            <p>{{count($subprojects)}}</p>

                                        </div>
                                        <div class="card-style-3 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class='icon-size bx bxl-react'></i>
                                            <p>Activities</p>
                                            <p>{{count($activities)}}</p>

                                        </div>
                                        <div class="card-style-4 col-sm-6 col-md-6 col-lg-6  ">
                                            <i class="icon-size lab la-wpforms"></i>
                                            <p>Forms</p>
                                            <p>{{count($forms)}}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <br>
                        <li class="col-one-second-list">

                        </li>
                        </li>
                    </ul>

                </div>
                {{--Latest form submitions--}}
                <div class="col-sm-12 col-md-8 col-lg-8 col-one">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-two">
                            <ul class="col-two-group-one">
                                <li>
                                    <p>Latest submission forms</p>
                                </li>
                                @foreach($forms as $form)
                                    <li>
                                        <p>{{$form->name}}-------{{@$form->create_at}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-three">
                            <ul class="col-two-group-one">
                                <li>
                                    <p>Latest Users</p>
                                </li>
                                @foreach($users as $user)
                                    <li>
                                        <p>{{$user->name}}----{{@$user->type}}</p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <ul class="form-chart">
                            <li>
                                {!! $formChart->container() !!}
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <br>
            <br>
        </div>
    </div>
    <br>
    {{--Forms table--}}
    <div class="header-section">
        <div class="container">
            <div class="row section-one">
                <div class="col-md-12" style="height: 500px;background-color: #FFF">

                </div>
            </div>
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>
    <script src="{{ $formChart->cdn() }}"></script>
    {{ $chart->script() }}
    {{ $formChart->script() }}
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-app-layout>

