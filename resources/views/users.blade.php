<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            {{--Section nav user types--}}
            <div class="col-md-12">
                <div class="container justify-content-start">
                    <a href="{{ route('users') }}" class="btn btn-outline-success me-2">All</a>
                    <a href="{{ route('users.admin') }}" class="btn btn-sm btn-outline-secondary">Admins</a>
                    <a href="{{ route('users.managers') }}" class="btn btn-sm btn-outline-secondary">Managers</a>
                    <a href="{{ route('users.workers') }}" class="btn btn-sm btn-outline-secondary">Workers</a>
                </div>
            </div>

        </div>
        <br>
        <div class="row">
            {{--Section all user table--}}
            <div class="col-md-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--<p><strong class="shadow alert alert-warning text-dark">All users table</strong></p>
                    <br>--}}
                    <div class="bg-white overflow-hidden shadow-xl ">
                        <div class="table-responsive" style="padding: 30px">
                            <table id="users-table" class="text-center table table-bordered table-striped"
                                   style="width: 100%; padding-top: 30px">
                                <thead class="text-light" style="background-color: #11101D">
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <script>
                    $('#users-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "/users/"
                        },
                        columns: [
                            {
                                name: 'no',
                            }, {
                                data: 'name',
                                name: 'name',
                            }, {
                                data: 'email',
                                name: 'email',
                            }, {
                                data: 'created_at',
                                name: 'created_at',
                            }, {
                                data: 'type',
                                name: 'type',
                            }, {
                                data: 'status',
                                name: 'status',
                            }, {
                                data: 'action',
                                name: 'action',
                                orderable: false,
                                searchable: false
                            },
                        ],
                        "columnDefs": [{
                            "render": function (data, type, full, meta) {
                                return meta.row + 1; // adds id to serial no
                            },
                            "targets": 0
                        }],
                    });

                    $(document).on('click', '#view', function () {
                        var id = $(this).data('id');
                        location.href = "/users/view/" + id;
                    });

                    $(document).on('click', '#edit', function () {
                        var id = $(this).data('id');
                        location.href = "/users/edit/" + id;
                    });

                    $(document).on('click', '#delete', function () {
                        var id = $(this).data('id');
                        location.href = "/users/delete/" + id;
                    });


                </script>
            </div>
        </div>
        <br>
        <br>
        <div class="row">
            {{--Section create new user--}}
            <div class="col-md-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{--<div class="shadow alert alert-light text-dark">
                        <strong>Create new user</strong>
                    </div>--}}
                    <div class="bg-white overflow-hidden shadow-xl">
                        <div class="col-md-12">
                            <div class="card shadow">
                                <div class="card-header alert alert-secondary">
                                    <h4><i class="las la-plus-square"></i>Create new user</h4>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <ul class="ul-project">
                                            <li>
                                                <div class="">
                                                    <strong><i
                                                            class="las la-signature text-primary"></i>Name
                                                    </strong>
                                                    &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                                      id="name" type="text" value="" placeholder="Name">
                                                </div>
                                                <div class="">
                                                    <strong>
                                                        <i class="las la-signature text-primary"></i>Email
                                                    </strong>
                                                    &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                                      type="text" value="" placeholder="Email">
                                                </div>
                                                <div class="">
                                                    <strong>
                                                        <i class="las la-phone text-primary"></i>Phone
                                                    </strong>
                                                    &nbsp &nbsp<input class="rounded-md col-md-12 alert alert-secondary"
                                                                      type="text" value="" placeholder="Phone">
                                                </div>
                                            </li>
                                            <li>
                                                <strong>
                                                    <i class="las la-hand-pointer text-primary"></i>User type
                                                </strong>
                                                <div class="row alert alert-secondary"
                                                     style=" margin: 0; padding-left:0; padding-right: 0">
                                                    <div class="col-md-10">
                                                        <strong class="paragraph-admin shadow">Admin</strong>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check form-switch">
                                                            <select name="manager" id="manager"
                                                                    class="btn-outline-primary manager-dropdown form-control input-group-lg ">
                                                                <option hidden>User type</option>
                                                                <option class="alert-light"
                                                                        value="0"> Admin
                                                                </option>
                                                                <option class="alert-light"
                                                                        value="1"> Manager
                                                                </option>
                                                                <option class="alert-light"
                                                                        value="2"> Worker
                                                                </option>
                                                            </select>
                                                            {{csrf_field()}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <strong><i
                                                        class="las la-toggle-off text-primary"></i>&nbspStatus</strong>
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
                                                                   id="flexSwitchCheckChecked" value="1" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <br>
                                            <br>
                                            <li>
                                                <button id="update-project" class="btn btn-primary float-right"><i
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
        @push('js')
            <script src="{{asset('js/user.js')}}" defer></script> {{--Must add defer to active js file--}}
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
