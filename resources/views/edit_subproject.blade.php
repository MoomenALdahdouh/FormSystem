<x-app-layout>
    <x-slot name="header">
        <br>
        <h1 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('strings.subproject_settings') }}
        </h1>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
        <div class="container">
            {{--Section get & add projects--}}
            <div class="row">
                {{--Section subproject details--}}
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header alert">
                            <div class="row">
                                <div class="col-11">
                                    <h4><i class="lab la-r-project"></i>&nbsp;{{$subproject->name}}</h4>
                                </div>
                                <div class="col-1 row-3">
                                    <a href="{{url('/subprojects/view/'.$subproject->id)}}"><i
                                            class="las la-binoculars btn-outline-primary sm:rounded-md"></i></a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="container">
                                <div class="alert alert-secondary">
                                    <strong><i
                                            class="las la-user-tie text-primary"></i>&nbsp; {{ __('strings.created_by') }}
                                    </strong>
                                    <br>
                                    <p> &nbsp; &nbsp; {{$subproject->user->name}}</p>

                                    <div class="">
                                        <strong><i
                                                class="las la-calendar-check text-primary"></i>&nbsp; {{ __('strings.created_at') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$subproject->created_at}}
                                    </div>
                                    <br>
                                    <div class="">
                                        <strong><i
                                                class="las la-clock text-primary"></i></i>&nbsp; {{ __('strings.update_at') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$subproject->updated_at}}
                                    </div>

                                    <br>
                                    <div class="">
                                        <strong><i
                                                class="las la-user-check text-primary"></i>&nbsp; {{ __('strings.manage_by') }}
                                        </strong>
                                        <br>
                                        &nbsp; &nbsp; {{$subproject->mainProject->name}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br id="edit-subproject">
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
                                        <input type="hidden" id="subproject-id" name="subproject-id"
                                               value="{{$subproject->id}}">
                                        <input type="hidden" id="subproject-size" name="subproject-size"
                                               value="{{$subproject->id}}">
                                        <li>
                                            <div class="">
                                                <strong><i class='bx bx-rename'></i>&nbsp; {{ __('strings.name') }}
                                                </strong>
                                                <br>
                                                <input placeholder="{{ __('strings.name') }}" id="name" name="name"
                                                       class="rounded-md col-md-12 alert alert-secondary"
                                                       value="{{$subproject->name}}" type="text">
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
                                                    $desc = __('strings.description') ;
                                                 if(!empty($subproject->description) ){
                                                     $desc = $subproject->description;
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
                                                    @if($subproject->status == 1)
                                                        <strong id="status-project"
                                                                class=" paragraph-active shadow">{{ __('strings.active') }}</strong>
                                                    @else
                                                        <strong id="status-project"
                                                                class=" paragraph-pended shadow">{{ __('strings.pended') }}</strong>
                                                    @endif
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-check form-switch">
                                                        @if($subproject->status == 1)
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
                                            <button id="update-subproject" class="btn btn-primary float-right"><i
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
                                <strong><i class="las la-trash"></i>&nbsp; {{ __('strings.remove_subproject') }}
                                </strong>
                            </div>
                            <div class="col-md-2">
                                <button id="remove-subproject"
                                        class="btn btn-danger float-right">{{ __('strings.remove_now') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
        </div>
    </div>
    @include('modal_alert')
    @push('js')
        <script src="{{asset('js/subproject.js')}}" defer></script> {{--Must add defer to active js file--}}
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

