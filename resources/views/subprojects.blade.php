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
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}
                                @foreach($subprojects as $subproject)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                                        <td>{{@$subproject->mainProject->name}}</td>
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
                {{--create subproject--}}
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
                                @php($count = 1) {{--Here this way to show columen number not work with paging so we use
                                other way $subprojects->firstItem()+$loop->index--}}
                                @foreach($trash as $subproject)
                                    <tr>
                                        {{--<th scope="row">{{$count++}}</th>--}} {{--not work with paging--}}
                                        <th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>
                                        <td>{{$subproject->name}}</td>
                                        <td>{{@$subproject->mainProject->name}}</td>
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
