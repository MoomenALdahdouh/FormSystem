<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Project') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            <div class="row">
                {{--Alert actions--}}
                @if(session('successUpdate'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill"/>
                        </svg>
                        <strong>{{session('successUpdate')}}</strong>
                    </div>
                @endif
                <button id="sdf" type="button"></button>
                {{--Project details--}}
                <div class="col-md-9">
                    <div class="card shadow">
                        {{--<div class="card-header alert-secondary">
                            <strong>Project details</strong>
                        </div>--}}
                        <div class="card-body">
                            <div class="container">
                                <ul class="ul-project">
                                    <li>
                                        <div class="row">
                                            <div class="col-1">
                                                <i class="lab la-r-project " style="font-size: 60px"></i>
                                            </div>
                                            <div class="col-10 row-2">
                                                <h5>{{$project->name}}</h5>
                                            </div>
                                            <div class="col-1 row-3">
                                                <a href="{{url('projects/edit/'.$project->id.'#edit-project')}}"><i
                                                        class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="paragraph-active shadow">
                                            @if($project->status == 1)
                                                Active
                                            @else
                                                Pended
                                            @endif
                                        </p>
                                        {{--<i class="las la-check-double text-primary"></i>--}}
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i
                                                    class="las la-audio-description text-primary"></i>Description
                                            </strong>
                                            <br>
                                            @if ($project->description === '' || $project->description === NULL)
                                                &nbsp &nbsp no description ...
                                            @else
                                                &nbsp &nbsp {{$project->description}}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i class="las la-user-tie text-primary"></i>Create By
                                            </strong>
                                            <br>
                                            <p> &nbsp &nbsp {{$project->createBy->name}}</p>
                                            <div class="">
                                                <strong><i class="las la-calendar-check text-primary"></i>Created At
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$project->created_at}}</p>
                                            </div>
                                            <div class="">
                                                <strong><i class="las la-clock text-primary"></i></i>&nbsp Update At
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$project->updated_at}}</p>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Manager details--}}
                <div class="col-md-3">
                    <div class="card shadow">
                        <br>
                        <div class="text-center">
                            <img class="user-image" width="80" src="{{asset('images/user.png')}}">
                            <p class="hint">manager</p>
                            <p><strong>{{$project->manageBy->name}}</strong>
                                <a href="{{url('/users/view/'.$project->manageBy->id)}}"><i
                                        class="las la-external-link-square-alt btn-outline-primary sm:rounded-md"></i></a>
                            </p>
                            <p class="paragraph-active shadow">
                                @if($project->manageBy->status == 1)
                                    Active
                                @else
                                    Pended
                                @endif
                            </p>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <br>
            <br>
            {{--Section get all subprojects--}}
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow">
                        <div class="card-header alert-secondary">
                            <strong>Subprojects List</strong></div>
                        <div id="table-subprojects" class="card-body">
                            @include('pagination_subproject')
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            {{--Section create new subproject--}}
            <div class="row">
                <div class="col-md-9">
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <h4><i class="las la-plus-square"></i>Create new Subproject</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <ul class="ul-project">
                                    <div class="alert alert-danger print-error-msg"
                                         style="display:none">
                                        <ul></ul>
                                    </div>

                                    <li>
                                        <div class="">
                                            <strong><i
                                                    class="las la-signature text-primary"></i>Name
                                            </strong>
                                            &nbsp &nbsp<input
                                                class="rounded-md col-md-12 alert alert-secondary"
                                                id="name" name="name" type="text"
                                                placeholder="Name">
                                            <p id="name_error" class="alert alert-danger"
                                               style="display: none"></p>
                                        </div>
                                        <div class="">
                                            <strong>
                                                <i class="las la-signature text-primary"></i>Description
                                            </strong>
                                            &nbsp &nbsp<input
                                                class="rounded-md col-md-12 alert alert-secondary"
                                                id="description" name="description" type="text"
                                                placeholder="Description">
                                            <p id="description_error"
                                               class="alert alert-danger"
                                               style="display: none"></p>
                                        </div>
                                    </li>
                                    <li>
                                        <strong>
                                            <i class="las la-hand-pointer text-primary"></i>Select
                                            Project
                                        </strong>

                                        <div class="row alert alert-secondary"
                                             style=" margin: 0">
                                            <div class="form-check form-switch col-md-3"
                                                 style="padding-left:0">
                                                <select name="project" id="project"
                                                        class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                        value="0">
                                                    <option class="alert-dark"
                                                            value="{{ $project->id }}">{{ $project->name }}</option>
                                                </select>
                                                {{csrf_field()}}
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
                                        <strong><i
                                                class="las la-toggle-off text-primary"></i>&nbsp;Status</strong>
                                        <br>
                                        <div class="row alert alert-secondary"
                                             style=" margin: 0; padding-left:0; padding-right: 0">
                                            <div class="col-md-11">
                                                <strong id="status-project"
                                                        class=" paragraph-active shadow">Active</strong>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="flexSwitchCheckChecked"
                                                           name="flexSwitchCheckChecked"
                                                           value="1" checked>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <br>
                                    <li>
                                        <button id="create_subproject"
                                                class="btn btn-primary float-right"><i
                                                class="las la-plus-square"></i> Create
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal_alert')
    @push('js')
        <script src="{{asset('js/view_project.js')}}" defer></script> {{--Must add defer to active js file--}}
    @endpush
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
