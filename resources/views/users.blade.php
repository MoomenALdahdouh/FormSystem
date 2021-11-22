<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
</x-app-layout>
