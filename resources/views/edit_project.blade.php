<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
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
                                            <div class="col-11 row-2">
                                                <h5>{{$project->name}}</h5>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <li>
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
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
                        <div class="card-header">
                            <h2><i class="las la-pen-square"></i>Edit</h2>
                        </div>
                        <div class="card-body">
                            <div class="container">
                                <form>
                                    <ul class="ul-project">
                                        <br>
                                        {{--<li>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2><i class="las la-pen-square text-primary"></i>Edit</h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary float-right"><i
                                                            class="lar la-save"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </li>--}}
                                        {{--<li>
                                            <i class="lab la-r-project " style="font-size: 60px"></i>
                                        </li>--}}
                                        <li>
                                            <div class="">
                                                <strong><i class='bx bx-rename'></i>&nbsp Name
                                                </strong>
                                                <br>
                                                <input placeholder="name" name="name"
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
                                                <textarea placeholder="description" name="description"
                                                          class="rounded-md col-md-12 alert alert-secondary"
                                                          type="text">{{$desc}}</textarea>
                                            </div>
                                        </li>
                                        <li>
                                            <strong>
                                                <i class="las la-fish"></i>&nbsp Status
                                            </strong>
                                            <br>
                                            <div class="alert alert-secondary">
                                                <div class="paragraph-title shadow">
                                                    @if($project->status == 1)
                                                        Active
                                                    @else
                                                        Pended
                                                    @endif
                                                </div>
                                                <div class="form-check form-switch float-right">
                                                    @if($project->status == 1)
                                                        <input class="form-check-input" type="checkbox"
                                                               id="flexSwitchCheckChecked" checked>
                                                    @else
                                                        <input class="form-check-input" type="checkbox"
                                                               id="flexSwitchCheckChecked">
                                                    @endif
                                                </div>
                                            </div>
                                            {{--<i class="las la-check-double text-primary"></i>--}}
                                        </li>
                                        <br>
                                        <li>
                                            <button type="submit" class="btn btn-primary float-right"><i
                                                    class="lar la-save"></i> Save
                                            </button>
                                        </li>
                                    </ul>
                                </form>
                            </div>
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
