<x-app-layout>
    @include('modal_alert')
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.project_settings') }}
                </h1>
            </div>
            {{--Select language--}}
            <div class="col-md-1">
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-globe"></i>&nbsp; {{ Config::get('language')[App::getLocale()] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        @foreach (Config::get('language') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
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
                                            class="las la-binoculars btn-outline-primary rounded-2 p-1"></i></a>
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
                                    <strong><i
                                            class="las la-user-tie text-primary"></i>&nbsp; {{ __('strings.created_by') }}
                                    </strong>
                                    <br>
                                    <p> &nbsp &nbsp {{$project->createBy->name}}</p>

                                    <div class="">
                                        <strong><i
                                                class="las la-calendar-check text-primary"></i>&nbsp; {{ __('strings.created_at') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$project->created_at}}
                                    </div>
                                    <br>
                                    <div class="">
                                        <strong><i
                                                class="las la-clock text-primary"></i></i>&nbsp; {{ __('strings.update_at') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$project->updated_at}}
                                    </div>

                                    <br>
                                    <div class="">
                                        <strong><i
                                                class="las la-user-check text-primary"></i>&nbsp {{ __('strings.manage_by') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$project->manageBy->name}}
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
                                <h4><i class="las la-pen-square"></i>{{ __('strings.edit') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="container">
                                    <ul class="ul-project">
                                        <input type="hidden" id="project-id" name="project-id" value="{{$project->id}}">
                                        <input type="hidden" id="subproject-size" name="subproject-size"
                                               value="{{count($subprojects)}}">
                                        <li>
                                            <div class="">
                                                <strong><i class='bx bx-rename'></i>&nbsp; {{ __('strings.name') }}
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
                                                    <i class="las la-audio-description"></i>&nbsp;
                                                    {{ __('strings.description') }}
                                                </strong>
                                                <br>
                                                @php
                                                    $desc =  __('strings.no_description');
                                                 if(!empty($project->description) ){
                                                     $desc = $project->description;
                                                 }
                                                @endphp
                                                <textarea rows="3" placeholder="{{ __('strings.description') }}"
                                                          id="description"
                                                          name="description"
                                                          class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text">{{$desc}}</textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <strong>
                                                <i class="las la-toggle-off"></i>&nbsp; {{ __('strings.status') }}
                                            </strong>
                                            <br>
                                            <div class="row alert alert-secondary"
                                                 style=" margin: 0; padding-left:0; padding-right: 0">
                                                <div class="col-md-11">
                                                    @if($project->status == 1)
                                                        <strong id="status-project"
                                                                class=" paragraph-active shadow">{{ __('strings.active') }}</strong>
                                                    @else
                                                        <strong id="status-project"
                                                                class=" paragraph-pended shadow">{{ __('strings.pended') }}</strong>
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
                                                    class="lar la-save"></i> {{ __('strings.save') }}
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
                                <strong><i class="las la-trash"></i>&nbsp; {{ __('strings.remove_project') }}</strong>
                            </div>
                            <div class="col-md-2">
                                <button id="remove-project"
                                        class="btn btn-danger float-right">{{ __('strings.remove_now') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
    @push('js')
        <script src="{{asset('js/project.js')}}" defer></script> {{--Must add defer to active js file--}}
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

