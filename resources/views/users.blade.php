<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admins') }}
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
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <script>
            var count = 1;
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
        </script>
    </div>
</x-app-layout>
