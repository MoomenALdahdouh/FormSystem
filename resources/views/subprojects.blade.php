<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subprojects') }}
            {{--<button class="btn btn-danger" style="float: right">{{ __('Create subProject') }}</button>--}}
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
                        <div class="card-header">All subproject</div>
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
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}
                                @foreach($subprojects as $subproject)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$subproject->mainProject->name}}</td>
                                        <td>{{$subproject->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$subproject->name}}</td>--}}  {{--After join with Quiry builder --}}
                                        {{--<td>{{$subproject->created_at}}</td>--}}
                                        @if($subproject->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('subprojects/delete/'.$subproject->id)}}"
                                               class="btn btn-outline-danger" title="delete"><i class='bx bx-trash'></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/edit/'.$subproject->id)}}"
                                               class="btn btn-outline-primary" title="settings">
                                                <i class="las la-cog"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$subprojects->links()}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add subproject</div>
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
                                <button type="submit" class="btn btn-primary"><i class='bx bx-add-to-queue'></i>&nbsp
                                    Add subProject
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
                                    <th scope="col">Main Project</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>

                                </thead>
                                <tbody>
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}
                                @foreach($trash as $subproject)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        <td>{{$subproject->mainProject->name}}</td>
                                        {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{$subproject->user->name}}</td> {{--Use this when join table by ROM method--}}
                                        {{--<td>{{$subproject->name}}</td>--}}  {{--After join With Query builder--}}
                                        {{--<td>{{$subproject->created_at}}</td>--}}
                                        @if($subproject->created_at == NULL)
                                            <td><span class="text-danger">No Date Set</span></td>
                                        @else
                                            <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
                                    @endif
                                    <!--Use this line if you compact users from Auth-->
                                        <!--Use this line if you compact users from DB to pars the date by carbon library-->
                                        <td>
                                            <a href="{{url('subprojects/forcedelete/'.$subproject->id)}}"
                                               class="btn btn-outline-danger" title="force delete"><i class="bx bx-trash"></i></a>
                                            &nbsp
                                            <a href="{{url('subprojects/restore/'.$subproject->id)}}"
                                               class="btn btn-outline-primary" title="restore"><i class="las la-trash-restore"></i></a>
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
