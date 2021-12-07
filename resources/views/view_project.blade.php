<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.view_project') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            <div class="row">
                {{--Project details--}}
                <div class="col-md-9">
                    <div class="card shadow">
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
                                        <p class="">
                                            @if($project->status == 1)
                                                <strong id="status-project"
                                                        class=" paragraph-active shadow">{{__('strings.active')}}</strong>
                                            @else
                                                <strong id="status-project"
                                                        class=" paragraph-pended shadow">{{__('strings.pended')}}</strong>
                                            @endif
                                        </p>
                                        {{--<i class="las la-check-double text-primary"></i>--}}
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i
                                                    class="las la-audio-description text-primary"></i>{{__('strings.description')}}
                                            </strong>
                                            <br>
                                            @if ($project->description === '' || $project->description === NULL)
                                                &nbsp &nbsp {{__('strings.no_description')}}
                                            @else
                                                &nbsp &nbsp {{$project->description}}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i
                                                    class="las la-user-tie text-primary"></i>{{__('strings.created_by')}}
                                            </strong>
                                            <br>
                                            <p> &nbsp &nbsp {{$project->createBy->name}}</p>
                                            <div class="">
                                                <strong><i
                                                        class="las la-calendar-check text-primary"></i>{{__('strings.created_at')}}
                                                </strong>
                                                <br>
                                                <p>&nbsp; &nbsp; {{$project->created_at}}</p>
                                            </div>
                                            <div class="">
                                                <strong><i
                                                        class="las la-clock text-primary"></i></i>&nbsp;{{__('strings.update_at')}}
                                                </strong>
                                                <br>
                                                <p>&nbsp; &nbsp; {{$project->updated_at}}</p>
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
                            <p class="hint">{{__('strings.manager')}}</p>
                            <p><strong>{{$project->manageBy->name}}</strong>
                                <a href="{{url('/users/view/'.$project->manageBy->id)}}"><i
                                        class="las la-external-link-square-alt btn-outline-primary sm:rounded-md"></i></a>
                            </p>
                            <p>
                                @if($project->manageBy->status == 1)
                                    <strong id="status-project"
                                            class=" paragraph-active shadow">{{__('strings.active')}}</strong>
                                @else
                                    <strong id="status-project"
                                            class=" paragraph-pended shadow">{{__('strings.pended')}}</strong>
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
                            <strong>{{__('strings.subprojects_list')}}</strong></div>
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
                            <h4><i class="las la-plus-square"></i>{{__('strings.create_new_subproject')}}</h4>
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
                                            <p id="description_error"
                                               class="alert alert-danger"
                                               style="display: none"></p>
                                        </div>
                                    </li>
                                    <li>
                                        <strong>
                                            <i class="las la-hand-pointer text-primary"></i>{{__('strings.description')}}
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
                                                class="las la-toggle-off text-primary"></i>&nbsp;{{__('strings.status')}}</strong>
                                        <br>
                                        <div class="row alert alert-secondary"
                                             style=" margin: 0; padding-left:0; padding-right: 0">
                                            <div class="col-md-11">
                                                <strong id="status-project"
                                                        class=" paragraph-active shadow">{{__('strings.active')}}</strong>
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
