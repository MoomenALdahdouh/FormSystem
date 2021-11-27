<x-app-layout>
    {{--<script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>--}}
    <x-slot name="header">
        <h2 class="title-header font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
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
                <button id="sdf" type="button"></button>
                {{--Section get all project--}}
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
                {{--Section add new project--}}
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

                            {{-- @include('add_project')--}}
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
            {{--Section get all trash projects--}}
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

