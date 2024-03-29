<x-app-layout>
    <x-slot name="header_2">
        <br>
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admins') }}
        </h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl ">
                <div class="table-responsive" style="padding: 30px">
                    {{--<div class="card-header alert-secondary">
                        <strong>Project List</strong>
                    </div>--}}
                    <table id="users-table" class="text-center table table-bordered table-striped" style="width: 100%; padding-top: 30px">
                        <thead class="text-light hint" style="background-color: #525256;">
                        <tr>
                            <th>SL No</th>
                            <th>Name</th>
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
                    url: "/users/admin"
                },
                columns: [
                    {
                        name: 'no',
                    }, {
                        data: 'name',
                        name: 'name',
                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false
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
