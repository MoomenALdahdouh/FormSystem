<x-app-layout>
    <script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <x-slot name="header">
        <h2 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h2>
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
                <div class="col-md-8">
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
                                                <h5>{{$user->name}}</h5>
                                            </div>
                                            <div class="col-1 row-3">
                                                <a href="{{url('projects/edit/'.$user->id)}}"><i class="lar la-edit btn-outline-primary sm:rounded-md"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="paragraph-active shadow">
                                            @if($user->status == 1)
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
                                            @if ($user->description === '' || $user->description === NULL)
                                                &nbsp &nbsp no description ...
                                            @else
                                                &nbsp &nbsp {{$user->descriotion}}
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="alert alert-secondary">
                                            <strong><i class="las la-user-tie text-primary"></i>Create By
                                            </strong>
                                            <br>
                                            {{--<p> &nbsp &nbsp {{$user->createBy->name}}</p>--}}
                                            <div class="">
                                                <strong><i class="las la-calendar-check text-primary"></i>Created At
                                                </strong>
                                                <br>
                                                {{--<p>&nbsp &nbsp {{$user->created_at}}</p>--}}
                                            </div>
                                            <div class="">
                                                <strong><i class="las la-clock text-primary"></i></i>&nbsp Update At
                                                </strong>
                                                <br>
                                                <p>&nbsp &nbsp {{$user->updated_at}}</p>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Manager details--}}
                <div class="col-md-4">
                    <div class="card shadow">
                        <br>
                        <div class="text-center">
                            <img class="user-image" width="80" src="{{asset('images/user.png')}}">
                            <p class="hint">manager</p>
                            <p>{{--<strong>{{$user->manageBy->name}}</strong>--}}<a href="#"><i
                                        class="las la-external-link-square-alt btn-outline-primary sm:rounded-md"></i></a></p>
                            <p class="paragraph-active shadow">
                                @if($user->status == 1)
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
            {{--Section get all sub project projects--}}
           {{-- <div class="row">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header alert-secondary">
                            <strong>Subprojects List</strong></div>
                        <div class="card-body">
                            @include('pagination_subproject')
                        </div>
                    </div>
                </div>
                --}}{{--create subproject--}}{{--
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header alert-secondary text-dark"><strong>Create new Subproject</strong></div>
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
                                           value="{{$user->id}}" required>
                                    --}}{{--<p>Select project</p>
                                    <div>
                                        <select name="project" id="project"
                                                class="project-dropdown form-control input-group-lg">
                                            <option hidden>Select project</option>
                                            --}}{{----}}{{--@foreach ($users as $user)
                                                <option class="alert-warning"
                                                        value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach--}}{{----}}{{--
                                        </select>
                                        {{csrf_field()}}
                                    </div>--}}{{--
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
            </div>--}}
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
