<x-app-layout>
    <x-slot name="header_2">
        <br>
        <div class="row">
            <div class="col-md-11">
                <h1 class="pt-1 home-section font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('strings.forms') }}
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
    <div class="container">
        <div class="row">
        </div>
        <br>
        {{--Section all activity table--}}
        <div class="row">
            <div class="col-md-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--<p><strong class="shadow alert alert-warning text-dark">All activitys table</strong></p>
                    <br>--}}
                    <div class="bg-white overflow-hidden shadow-xl ">
                        <div class="table-responsive" style="padding: 30px">
                            <table id="sub-activities-table" class="text-center table table-bordered table-striped"
                                   style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                                <thead class="text-light hint" style="background-color: #525256;">
                                <tr>
                                <tr>
                                    <th>{{ __('strings.sl_no') }}</th>
                                    <th>{{ __('strings.name') }}</th>
                                    <th>{{ __('strings.created_at') }}</th>
                                    <th>{{ __('strings.type') }}</th>
                                    <th>{{ __('strings.action') }}</th>
                                </tr>
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
        {{--Section create new activity--}}
        {{-- <div class="row">
             <div class="col-md-12">
                 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                     @if(session('success'))
                         <div class="alert alert-success d-flex align-items-center" role="alert">
                             <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                                 <use xlink:href="#check-circle-fill"/>
                             </svg>
                             <strong>{{session('success')}}</strong>
                         </div>
                     @endif
                     <div class="bg-white overflow-hidden shadow-xl">
                         <div class="col-md-12">
                             <div class="card shadow">
                                 <div class="card-header alert alert-secondary">
                                     <h4><i class="las la-plus-square"></i>{{ __('strings.create_new_activity') }}</h4>
                                 </div>
                                 <div class="card-body">
                                     <div class="container">
                                         <ul class="ul-project">
                                             <div class="alert alert-danger print-error-msg" style="display:none">
                                                 <ul></ul>
                                             </div>

                                             <li>
                                                 <div class="">
                                                     <strong><i
                                                             class="las la-signature text-primary"></i>{{ __('strings.name') }}
                                                     </strong>
                                                     &nbsp &nbsp<input
                                                         class="rounded-md col-md-12 alert alert-secondary"
                                                         id="name" name="name" type="text"
                                                         placeholder="{{ __('strings.name') }}">
                                                     <p id="name_error" class="alert alert-danger"
                                                        style="display: none"></p>
                                                 </div>
                                                 <div class="">
                                                     <strong>
                                                         <i class="las la-signature text-primary"></i>{{ __('strings.description') }}
                                                     </strong>
                                                     &nbsp &nbsp<input
                                                         class="rounded-md col-md-12 alert alert-secondary"
                                                         id="description" name="description" type="text"
                                                         placeholder="{{ __('strings.description') }}">
                                                     <p id="description_error" class="alert alert-danger"
                                                        style="display: none"></p>
                                                 </div>
                                             </li>
                                             <li>
                                                 <strong>
                                                     <i class="las la-hand-pointer text-primary"></i>{{ __('strings.select_activity_type') }}
                                                 </strong>

                                                 <div class="row alert alert-secondary"
                                                      style=" margin: 0">
                                                     <div class="form-check form-switch col-md-3" style="padding-left:0">
                                                         <select name="type" id="type"
                                                                 class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                                 value="0">
                                                             --}}{{--<option hidden>activity type</option>--}}{{--
                                                             <option class="alert-light"
                                                                     value="0"> {{ __('strings.form') }}
                                                             </option>
                                                             <option class="alert-light"
                                                                     value="1"> {{ __('strings.subactivity') }}
                                                             </option>
                                                         </select>
                                                     </div>
                                                 </div>
                                             </li>
                                             <br>
                                             <li>
                                                 <strong>
                                                     <i class="las la-hand-pointer text-primary"></i>{{ __('strings.select_worker') }}
                                                 </strong>

                                                 <div class="row alert alert-secondary"
                                                      style=" margin: 0">
                                                     <div class="form-check form-switch col-md-3" style="padding-left:0">
                                                         <select name="worker" id="worker"
                                                                 class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                                 value="0">
                                                             @php
                                                                 $countWorker = 0;
                                                             @endphp
                                                             @if($workers == '[]')
                                                                 <option class="alert-warning"
                                                                         value=""> Empty Workers
                                                                 </option>
                                                             @else
                                                                 @foreach ($workers as $worker)
                                                                     @php
                                                                         $countWorker =+ 1;
                                                                     @endphp
                                                                     <option class="alert-dark"
                                                                             value="{{ $worker->id }}">
                                                                         {{ $worker->name }}
                                                                     </option>
                                                                 @endforeach
                                                                 @if($countWorker==0)
                                                                     <option class="alert-warning"
                                                                             value=""> {{ __('strings.empty_workers') }}
                                                                     </option>
                                                                 @endif
                                                             @endif
                                                         </select>
                                                         {{csrf_field()}}
                                                     </div>
                                                 </div>
                                             </li>
                                             <br>
                                             <li>
                                                 <strong>
                                                     <i class="las la-hand-pointer text-primary"></i>{{ __('strings.select_subproject') }}
                                                 </strong>

                                                 <div class="row alert alert-secondary"
                                                      style=" margin: 0">
                                                     <div class="form-check form-switch col-md-3" style="padding-left:0">
                                                         <select name="subproject" id="subproject"
                                                                 class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                                 value="0">
                                                             --}}{{--<option hidden>Subprojects name</option>--}}{{--
                                                             @php
                                                                 $count = 0;
                                                             @endphp
                                                             @if($subprojects == '[]')
                                                                 <option class="alert-warning"
                                                                         value=""> {{ __('strings.empty_subproject') }}
                                                                 </option>
                                                             @else
                                                                 @foreach ($subprojects as $activity)
                                                                     @php
                                                                         $count =+ 1;
                                                                     @endphp
                                                                     <option class="alert-dark"
                                                                             value="{{ $activity->id }}">{{ $activity->name }}</option>
                                                                 @endforeach
                                                                 @if($count==0)
                                                                     <option class="alert-warning"
                                                                             value=""> {{ __('strings.empty_subproject') }}
                                                                     </option>
                                                                 @endif
                                                             @endif
                                                         </select>
                                                         {{csrf_field()}}
                                                     </div>
                                                 </div>
                                             </li>
                                             <br>
                                             <li>
                                                 <strong><i
                                                         class="las la-toggle-off text-primary"></i>&nbsp;{{ __('strings.status') }}
                                                 </strong>
                                                 <br>
                                                 <div class="row alert alert-secondary"
                                                      style=" margin: 0; padding-left:0; padding-right: 0">
                                                     <div class="col-md-11">
                                                         <strong id="status-project"
                                                                 class=" paragraph-active shadow">{{ __('strings.active') }}</strong>
                                                     </div>
                                                     <div class="col-md-1">
                                                         <div class="form-check form-switch">
                                                             <input class="form-check-input" type="checkbox"
                                                                    id="flexSwitchCheckChecked"
                                                                    name="flexSwitchCheckChecked" value="1" checked>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </li>
                                             <br>
                                             <br>
                                             <li>
                                                 <button id="create_activity" class="btn btn-primary float-right"><i
                                                         class="las la-plus-square"></i> {{ __('strings.create') }}
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
         </div>--}}
        @include('modal_alert')
        @push('js')
            <script src="{{asset('js/forms.js')}}" defer></script> {{--Must add defer to active js file--}}
        @endpush
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
    <br>
    <br>
    <br>
</x-app-layout>
