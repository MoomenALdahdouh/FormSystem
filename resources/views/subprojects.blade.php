<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subprojects') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create subProject') }}</button>--}}
        </h2>
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
                            <table id="subprojects-table" class="text-center table table-bordered table-striped"
                                   style="width: 100%; padding-top: 30px;margin-bottom: 15px">
                                <thead class="text-light" style="background-color: #11101D">
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Created By</th>
                                    <th>Main Project</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
        {{--Section create new user--}}
        <div class="row">
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
                                    <h4><i class="las la-plus-square"></i>Create new Subproject</h4>
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
                                                        id="email" name="description" type="text"
                                                        placeholder="Description">
                                                    <p id="description_error" class="alert alert-danger"
                                                       style="display: none"></p>
                                                </div>
                                            </li>
                                            <li>
                                                <strong>
                                                    <i class="las la-hand-pointer text-primary"></i>Select Project
                                                </strong>

                                                <div class="row alert alert-secondary"
                                                     style=" margin: 0">
                                                    <div class="form-check form-switch col-md-3" style="padding-left:0">
                                                        <select name="manager" id="manager"
                                                                class="btn-outline-primary manager-dropdown form-control input-group-lg "
                                                                value="0">
                                                            @php
                                                                $count = 0;
                                                            @endphp
                                                            @if($projects == '[]')
                                                                <option class="alert-warning"
                                                                        value=""> Empty All managers are busy...
                                                                </option>
                                                            @else
                                                                @foreach ($projects as $project)
                                                                    @if($project->project_fk_id == 0)
                                                                        @php
                                                                            $count =+ 1;
                                                                        @endphp
                                                                        <option class="alert-dark"
                                                                                value="{{ $project->id }}">{{ $project->name }}</option>
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
                                                <button id="create_subproject" class="btn btn-primary float-right"><i
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
        </div>
        <br>
        <br>


        @include('modal_alert')
        @push('js')
            <script src="{{asset('js/subproject.js')}}" defer></script> {{--Must add defer to active js file--}}
        @endpush
    </div>


    {{--<div class="header-section">
        <div class="container">
            <div class="row">
                @if(session('successUpdate'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('successUpdate')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header alert-secondary"><strong>All subproject</strong></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Main Project</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) --}}{{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}{{--
                                @foreach($subprojects as $subproject)
                                    <tr>
                                        --}}{{--<th scope="row">{{$count++}}</th>--}}{{-- --}}{{--not work with paging--}}{{--
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        --}}{{--<td>{{$subproject->user_id}}</td>--}}{{-- --}}{{--Just aarived to user id so we will join two table to arrived --}}{{--
                                        <td>{{@$subproject->mainProject->name}}</td>
                                        <td>{{$subproject->user->name}}</td> --}}{{--Use this when join table by ROM method--}}{{--
                                        --}}{{--<td>{{$subproject->name}}</td>--}}{{--  --}}{{--After join with Quiry builder --}}{{--
                                        --}}{{--<td>{{$subproject->created_at}}</td>--}}{{--
                                        @if($subproject->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('subprojects/delete/'.$subproject->id)}}"
                                               class="btn-outline-danger sm:rounded-md" title="delete"><i class='bx bx-trash'></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/edit/'.$subproject->id)}}"
                                               class="btn-outline-dark sm:rounded-md" title="settings">
                                                <i class="las la-cog"></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/view'.$subproject->id)}}" class="btn-outline-primary sm:rounded-md"
                                               title="view">
                                                <i class="las la-external-link-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$subprojects->links()}}
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
                                    <p>Select project</p>
                                    <div>
                                        <select name="project" id="project"
                                                class="project-dropdown form-control input-group-lg">
                                            <option hidden>Select project</option>
                                            @foreach ($projects as $project)
                                                <option class="alert-warning"
                                                        value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        {{csrf_field()}}
                                    </div>
                                    @error('project')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <br>
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
            <br>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header alert-secondary"><strong>Trash List</strong></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Main Project</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) --}}{{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}{{--
                                @foreach($trash as $subproject)
                                    <tr>
                                        --}}{{--<th scope="row">{{$count++}}</th>--}}{{-- --}}{{--not work with paging--}}{{--
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        <td>{{@$subproject->mainProject->name}}</td>
                                        --}}{{--<td>{{$subproject->user_id}}</td>--}}{{-- --}}{{--Just aarived to user id so we will join two table to arrived --}}{{--
                                        <td>{{$subproject->user->name}}</td> --}}{{--Use this when join table by ROM method--}}{{--
                                        --}}{{--<td>{{$subproject->name}}</td>--}}{{--  --}}{{--After join With Query builder--}}{{--
                                        --}}{{--<td>{{$subproject->created_at}}</td>--}}{{--
                                        @if($subproject->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('subprojects/forcedelete/'.$subproject->id)}}"
                                               class="btn-outline-danger sm:rounded-md" title="force delete"><i
                                                    class="bx bx-trash"></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/restore/'.$subproject->id)}}"
                                               class="btn-outline-dark sm:rounded-md" title="restore"><i
                                                    class="las la-trash-restore"></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/view'.$subproject->id)}}" class="btn-outline-primary sm:rounded-md"
                                               title="view">
                                                <i class="las la-external-link-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$trash->links()}}
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
