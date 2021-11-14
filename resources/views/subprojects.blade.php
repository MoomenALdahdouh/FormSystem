<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subprojects') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create Project') }}</button>--}}
        </h2>
    </x-slot>
    <br>
    <br>
    <div class="header-section">
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
                        <div class="card-header">All project</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $projects->firstItem()+$loop->index--}}
                                @foreach($projects as $project)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$projects->firstItem()+$loop->index}}</th>
                                        <td>{{$project->name}}</td>
                                        {{--<td>{{$project->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$project->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$project->name}}</td>--}}  {{--After join with Quiry builder --}}
                                        {{--<td>{{$project->created_at}}</td>--}}
                                        @if($project->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('projects/delete/'.$project->id)}}"
                                               class="btn btn-danger"><i class='bx bx-trash'></i>&nbsp DELETE</a>
                                            <a href="{{url('project/edit/'.$project->id)}}" class="btn btn-primary"><i
                                                    class='bx bx-edit'></i>&nbsp EDIT</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$projects->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add project</div>
                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{route('add')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Project Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Project Name"
                                           aria-describedby="nameHelp" required>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary"><i class='bx bx-add-to-queue'></i>&nbsp
                                    Add Project
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
                        <div class="card-header">Trash List</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $projects->firstItem()+$loop->index--}}
                                @foreach($trash as $project)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$projects->firstItem()+$loop->index}}</th>
                                        <td>{{$project->name}}</td>
                                        {{--<td>{{$project->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$project->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$project->name}}</td>--}}  {{--After join With Query builder--}}
                                        {{--<td>{{$project->created_at}}</td>--}}
                                        @if($project->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('projects/forcedelete/'.$project->id)}}"
                                               class="btn btn-danger"><i class="fa fa-trash"></i>FORCE DELETE</a>
                                            <a href="{{url('projects/restore/'.$project->id)}}"
                                               class="btn btn-primary"><i class="fas fa-trash-restore"></i>RESTORE</a>
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
    </div>
    {{--<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                --}}{{--<x-jet-welcome />--}}{{--
            </div>
        </div>
    </div>--}}
</x-app-layout>
