<x-app-layout>
    @include('modal_alert')

    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project Settings') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h1>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            {{--Section get & add projects--}}
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
                {{--Section get all project--}}
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header alert">
                            <div class="row">
                                <div class="col-11">
                                    <h4><i class="lab la-r-project"></i>&nbsp;{{$project->name}}</h4>
                                </div>
                                <div class="col-1 row-3">
                                    <a href="{{url('/projects/view/'.$project->id)}}"><i
                                            class="las la-binoculars btn-outline-primary sm:rounded-md"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="alert alert-secondary">
                                    {{--<div class="row ul-project">
                                        <div class="col-1">
                                            <i class="lab la-r-project " style="font-size: 60px"></i>
                                        </div>
                                        <div class="col-11 row-2">
                                            <h5>{{$project->name}}</h5>
                                        </div>
                                    </div>
                                    <br>--}}
                                    <strong><i class="las la-user-tie text-primary"></i>&nbsp Create By
                                    </strong>
                                    <br>
                                    <p> &nbsp &nbsp {{$project->createBy->name}}</p>

                                    <div class="">
                                        <strong><i class="las la-calendar-check text-primary"></i>&nbsp Created
                                            At
                                        </strong>
                                        <br>
                                        &nbsp &nbsp {{$project->created_at}}
                                    </div>
                                    <br>
                                    <div class="">
                                        <strong><i class="las la-clock text-primary"></i></i>&nbsp Update At
                                        </strong>
                                        <br>
                                        &nbsp &nbsp {{$project->updated_at}}
                                    </div>

                                    <br>
                                    <div class="">
                                        <strong><i class="las la-user-check text-primary"></i>&nbsp Manage By
                                        </strong>
                                        <br>
                                        &nbsp &nbsp {{$project->manageBy->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br id="edit-project">
            <br>
            {{--Section Edit project--}}
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow">
                            <div class="card-header alert alert-secondary">
                                <h4><i class="las la-pen-square"></i>Edit</h4>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <ul class="ul-project">
                                        <input type="hidden" id="project-id" name="project-id" value="{{$project->id}}">
                                        <input type="hidden" id="subproject-size" name="subproject-size"
                                               value="{{$project->id}}">
                                        <li>
                                            <div class="">
                                                <strong><i class='bx bx-rename'></i>&nbsp Name
                                                </strong>
                                                <br>
                                                <input placeholder="name" id="name" name="name"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       value="{{$project->name}}" type="text">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="">
                                                <strong>
                                                    <i class="las la-audio-description"></i>&nbsp
                                                    Description
                                                </strong>
                                                <br>
                                                @php
                                                    $desc = "no description ...";
                                                 if(!empty($project->description) ){
                                                     $desc = $project->description;
                                                 }
                                                @endphp
                                                <textarea placeholder="description" id="description" name="description"
                                                          class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text">{{$desc}}</textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <strong>
                                                <i class="las la-toggle-off"></i>&nbsp Status
                                            </strong>
                                            <br>
                                            <div class="row alert alert-secondary"
                                                 style=" margin: 0; padding-left:0; padding-right: 0">
                                                <div class="col-md-11">
                                                    @if($project->status == 1)
                                                        <strong id="status-project"
                                                                class=" paragraph-active shadow">Active</strong>
                                                    @else
                                                        <strong id="status-project"
                                                                class=" paragraph-pended shadow">Pended</strong>
                                                    @endif
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-switch">
                                                        @if($project->status == 1)
                                                            <input class="form-check-input" type="checkbox"
                                                                   id="flexSwitchCheckChecked" value="1" checked>
                                                        @else
                                                            <input class="form-check-input" type="checkbox"
                                                                   id="flexSwitchCheckChecked" value="0">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <br>
                                        <br>
                                        <li>
                                            <button id="update-project" class="btn btn-primary float-right"><i
                                                    class="lar la-save"></i> Save
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            {{--Section Remove project--}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="row alert alert-danger text-dark"
                             style=" margin: 0; padding-left:0; padding-right: 0">
                            <div class="col-md-10">
                                <strong><i class="las la-trash"></i>&nbsp Remove this project! you
                                    can not restore it.</strong>
                            </div>
                            <div class="col-md-2">
                                <button id="remove-project" class="btn btn-danger float-right">Remove Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            {{--Section get all subprojects--}}
            {{--<div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header alert-secondary">
                            <strong>Subprojects List</strong></div>
                        <div id="table-subprojects" class="card-body">
                            @include('pagination_subproject')
                        </div>
                    </div>
                </div>
            </div>--}}
            <br>
            <br>
            {{--Section create new subproject--}}
            {{--<div class="row">
                <div class="col-md-12">
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
            </div>--}}
            <br>
        </div>
    </div>
    @push('js')
        <script src="{{asset('js/project.js')}}" defer></script> {{--Must add defer to active js file--}}
       {{-- <script src="{{asset('js/view_project.js')}}" defer></script>--}} {{--Must add defer to active js file--}}
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

