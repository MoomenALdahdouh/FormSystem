<x-app-layout>
    @include('alerts')
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
                    <div class="card">
                        <div class="card-header">All project</div>
                        <div class="card-body">
                            <div id="table-data">
                                @include('pagination_projects')
                            </div>
                        </div>
                    </div>
                </div>
                {{--Section add new project--}}
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

                            @include('add_project')
                            {{--<form action="{{route('project.add')}}" method="POST">
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
                                                @if($users == '[]')
                                                    <option class="alert-warning"
                                                            value=""> Empty All managers are busy...
                                                    </option>
                                                @else
                                                    @foreach ($users as $user)
                                                        @if($user->project_fk_id == 0)
                                                            <option class="alert-warning"
                                                                    value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </select>
                                            {{csrf_field()}}
                                        </div>
                                        @error('manager')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class='bx bx-add-to-queue'></i>&nbsp
                                    Add Project
                                </button>
                            </form>--}}
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            {{--Section get all trash projects--}}
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Trash List</div>
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
</x-app-layout>
<script type="text/javascript" src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script>
    $(function () {
        $(document).ready(function () {
            $('body').on('click', '#table-data .pagination a', function () {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_projects(page);
            });

            $('#table_trash').on('click', '.pagination a', function () {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                fetch_trash_projects(page);
            });

            $('.delete').click(function () {
                var project_id = document.getElementById('project_id').value;
                delete_project(project_id);

            });
            $('.force_delete').click(function () {
                var project_id = document.getElementById('project_id').value;
                force_delete_project(project_id);

            });

            $('#add_project').click(function () {
                var project_name = document.getElementById('name').value;
                var manager_id = document.getElementById('manager').value;
                add_project(project_name, manager_id);
            });
            Array.from(document.querySelectorAll('.restore')).forEach(bttn => {
                bttn.addEventListener('click', (e) => {
                    e.preventDefault();
                    let project_id = e.target.parentNode.querySelector('#project_id').value;
                    restore_project(project_id);
                });
            });
            /*$('.restore').click(function () {
                var project_id = document.getElementById('project_id').value;
                restore_project(project_id);

            });*/
        });

        function fetch_projects(page) {
            $.ajax({
                type: "GET",
                url: "{{ route('projects.all') }}" + "?page=" + page,
                success: function (response) {
                    $('#table-data').html(response)
                }
            });
        }

        function fetch_trash_projects(page) {
            $.ajax({
                type: "GET",
                url: "{{ route('projects.trash') }}" + "?page=" + page,
                success: function (response) {
                    $('#table_trash').html(response)
                }
            });
        }

        function delete_project(id) {
            $.ajax({
                type: "get",
                url: "/projects/delete/" + id,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function (response) {
                    fetch_projects(1)
                    fetch_trash_projects(1)
                }
            });
        }

        function force_delete_project(id) {
            $.ajax({
                type: "GET",
                url: "/projects/forcedelete/" + id,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function (response) {
                    fetch_trash_projects(1)
                }
            });
        }

        function restore_project(id) {
            $.ajax({
                type: "GET",
                url: "/projects/restore/" + id,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function (response) {
                    fetch_projects(1)
                    fetch_trash_projects(1)
                }
            });
        }

        function add_project(project_name, manager_id) {
            $.ajax({
                method: "POST",
                url: "{{route('project.create')}}",
                data: {_token: $("input[name=_token]").val(), name: project_name, manager: manager_id},
                success: function (response) {
                    fetch_projects(1)
                }
            });
        }
    });
</script>
