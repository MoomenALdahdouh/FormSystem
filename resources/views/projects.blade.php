<x-app-layout>
    {{--<script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>--}}
    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.projects') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <br>

    <div class="container">
        <div class="row">
            {{--Section all projects table--}}
            <div class="col-md-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--<p><strong class="shadow alert alert-warning text-dark">All users table</strong></p>
                    <br>--}}
                    <div class="bg-white overflow-hidden shadow-xl ">
                        <div class="table-responsive" style="padding: 30px">
                            <table id="projects-table" class="text-center table table-bordered table-striped"
                                   style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                                <thead class="text-light" style="background-color: #11101D">
                                <tr>
                                    <th>{{ __('strings.sl_no') }}</th>
                                    <th>{{ __('strings.name') }}</th>
                                    <th>{{ __('strings.created_by') }}</th>
                                    <th>{{ __('strings.manage_by') }}</th>
                                    <th>{{ __('strings.created_at') }}</th>
                                    <th>{{ __('strings.status') }}</th>
                                    <th>{{ __('strings.action') }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        {{--Section create new project--}}
        @if(Auth::user())
            @switch(Auth::user()->type)
                @case(0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            @if(session('success'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                         aria-label="Success:">
                                        <use xlink:href="#check-circle-fill"/>
                                    </svg>
                                    <strong>{{session('success')}}</strong>
                                </div>
                            @endif
                            <div class="bg-white overflow-hidden shadow-xl">
                                <div class="col-md-12">
                                    <div class="card shadow">
                                        <div class="card-header alert alert-secondary">
                                            <h4><i class="las la-plus-square"></i>{{__('strings.create_new_project')}}
                                            </h4>
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
                                                                    class="las la-signature text-primary"></i>{{__('strings.name')}}
                                                            </strong>
                                                            &nbsp &nbsp<input
                                                                class="rounded-md col-md-12 alert alert-secondary"
                                                                id="name" name="name" type="text"
                                                                placeholder="{{__('strings.name')}}">
                                                            <p id="name_error" class="alert alert-danger"
                                                               style="display: none"></p>
                                                        </div>
                                                        <div class="">
                                                            <strong>
                                                                <i class="las la-signature text-primary"></i>{{__('strings.description')}}
                                                            </strong>
                                                            &nbsp &nbsp<input
                                                                class="rounded-md col-md-12 alert alert-secondary"
                                                                id="description" name="description" type="text"
                                                                placeholder="{{__('strings.description')}}">
                                                            <p id="description_error" class="alert alert-danger"
                                                               style="display: none"></p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <strong>
                                                            <i class="las la-hand-pointer text-primary"></i>{{__('strings.select_manager')}}
                                                        </strong>

                                                        <div class="row alert alert-secondary"
                                                             style=" margin: 0">
                                                            <div class="form-check form-switch col-md-3"
                                                                 style="padding-left:0">
                                                                <select name="manager" id="manager"
                                                                        class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                                        value="0">
                                                                    @php
                                                                        $count = 0;
                                                                    @endphp
                                                                    @if($users == '[]')
                                                                        <option class="alert-warning"
                                                                                value=""> {{__('strings.empty_all_managers_are_busy')}}
                                                                        </option>
                                                                    @else
                                                                        @foreach ($users as $user)
                                                                            @if($user->project_fk_id == 0)
                                                                                @php
                                                                                    $count =+ 1;
                                                                                @endphp
                                                                                <option class="alert-dark"
                                                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                        @if($count==0)
                                                                            <option class="alert-warning"
                                                                                    value=""> {{__('strings.empty_all_managers_are_busy')}}
                                                                            </option>
                                                                        @endif
                                                                    @endif
                                                                </select>
                                                                {{csrf_field()}}
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <p id="manager_error" class="alert alert-danger"
                                                           style="display: none"></p>
                                                    </li>
                                                    <br>
                                                    <li>
                                                        <strong><i
                                                                class="las la-toggle-off text-primary"></i>&nbsp;{{__('strings.status')}}
                                                        </strong>
                                                        <br>
                                                        <div class="row alert alert-secondary"
                                                             style=" margin: 0; padding-left:0; padding-right: 0">
                                                            <div class="col-md-11">
                                                                <strong id="status-project"
                                                                        class=" paragraph-active shadow">{{__('strings.active')}}</strong>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-check form-switch">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="flexSwitchCheckChecked"
                                                                           name="flexSwitchCheckChecked" value="1"
                                                                           checked>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <br>
                                                    <br>
                                                    <li>
                                                        <button id="create_project" class="btn btn-primary float-right">
                                                            <i
                                                                class="las la-plus-square"></i> {{__('strings.create')}}
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
                </div>
                @break
            @endswitch
        @endif

        <br>
        <br>
        @include('modal_alert')
        @push('js')
            <script src="{{asset('js/project.js')}}" defer></script> {{--Must add defer to active js file--}}
        @endpush
    </div>
    {{--Old--}}
    {{--<div class="header-section">
        <div class="container">
            Section get & add projects
            <div class="row">
                Alert actions
                @if(session('successUpdate'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                            <use xlink:href="#check-circle-fill"/>
                        </svg>
                        <strong>{{session('successUpdate')}}</strong>
                    </div>
                @endif
                <button id="sdf" type="button"></button>
                Section get all project
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header alert-secondary">
                            <strong>Project List</strong>
                        </div>
                        <div class="card-body">
                            <div id="table-data">
                                @include('pagination_projects')
                            </div>
                        </div>
                    </div>
                </div>
               --}}{{-- Section add new project--}}{{--
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header alert-secondary text-dark"><strong>Create new Project</strong></div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif

                             @include('add_project')
                            <form action="{{route('project.add')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Project Name"
                                           aria-describedby="nameHelp" required>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <br>
                                    <div>
                                        <p>Select User manager</p>
                                        <div>
                                            <select name="manager" id="manager"
                                                    class="manager-dropdown form-control input-group-lg">
                                                <option hidden>Select Manager</option>
                                                @php
                                                    $count = 0;
                                                @endphp
                                                @if($users == '[]')
                                                    <option class="alert-warning"
                                                            value=""> Empty All managers are busy...
                                                    </option>
                                                @else
                                                    @foreach ($users as $user)
                                                        @if($user->project_fk_id == 0)
                                                            @php
                                                                $count =+ 1;
                                                            @endphp
                                                            <option class="alert-dark"
                                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                    @if($count==0)
                                                        <option class="alert-warning"
                                                                value=""> Empty All managers are busy...
                                                        </option>
                                                    @endif
                                                @endif
                                            </select>
                                            {{csrf_field()}}
                                        </div>
                                        @error('manager')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right"><i
                                        class="las la-plus-square"></i>&nbsp
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            Section get all trash projects
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header alert-secondary">
                            <strong>Trash List</strong></div>
                        <div class="card-body">
                            <div id="table_trash">
                                @include('pagination_trash_project')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
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

