<x-app-layout>
    @include('modal_alert')

    <x-slot name="header">
        <h2 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h2>
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
                            <h4><i class="lab la-r-project"></i>&nbsp;{{$project->name}}</h4>
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
            <br>
            <br>
            {{--Section Edit project--}}
            <div class="row">
                {{--Alert actions--}}
                {{-- @if(session('successUpdate'))
                     <div class="alert alert-success d-flex align-items-center" role="alert">
                         <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                             <use xlink:href="#check-circle-fill"/>
                         </svg>
                         <strong>{{session('successUpdate')}}</strong>
                     </div>
                 @endif--}}
                {{--Section get all project--}}
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <h4><i class="las la-pen-square"></i>Edit</h4>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <ul class="ul-project">
                                    <input type="hidden" id="project-id" name="project-id" value="{{$project->id}}">
                                    <input type="hidden" id="subproject-size" name="subproject-size" value="{{$project->id}}">
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
                                            <i class="las la-fish"></i>&nbsp Status
                                        </strong>
                                        <br>
                                        <div class="row alert alert-secondary"
                                             style=" margin: 0; padding-left:0; padding-right: 0">
                                            <div class="col-md-11">
                                                @if($project->status == 1)
                                                    <strong id="status-project" class=" paragraph-active shadow">Active</strong>
                                                @else
                                                    <strong id="status-project" class=" paragraph-pended shadow">Pended</strong>
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
            {{--Section get all sub project--}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary">
                            <strong><i class="las la-project-diagram"></i> Subprojects List</strong></div>
                        <div class="card-body">
                            @include('pagination_subproject')
                        </div>
                    </div>
                </div>
                {{--create subproject--}}
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header alert alert-secondary text-dark"><strong>Create new Subproject</strong>
                        </div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('subproject.add')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Subproject Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Sub Project Name"
                                           aria-describedby="nameHelp" required>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div>
                                    <input type="hidden" class="form-control" id="project" name="project"
                                           value="{{$project->id}}" required>
                                    @error('project')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary float-right"><i
                                        class='bx bx-add-to-queue'></i>&nbsp
                                    Create
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <br>
        </div>
    </div>
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
