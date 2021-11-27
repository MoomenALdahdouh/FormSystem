/*$(function () {
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

        /!*$('#add_project').click(function () {
            var project_name = document.getElementById('name').value;
            var manager_id = document.getElementById('manager').value;
            add_project(project_name, manager_id);
        });*!/

        Array.from(document.querySelectorAll('.restore')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                //var project_id = document.getElementById('project_id').value;
                let project_id = e.target.parentNode.querySelector('#project_id').value;
                restore_project(project_id);
            });
        });
        /!*$('.restore').click(function () {
            var project_id = document.getElementById('project_id').value;
            restore_project(project_id);

        });*!/
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
});*/


/*start Project Setting and edit*/
$(function () {
    const table = $('#activities-table');

    $(document).ready(function () {
        get_activities_as();

        $(document).on('click', '#view', function () {
            var id = $(this).data('id');
            location.href = "/activities/view/" + id;
        });

        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            location.href = "/activities/edit/" + id;
        });

        $(document).on('click', '#delete', function () {
            var id = $(this).data('id');
            location.href = "/activity/delete/" + id;
        });

        /*Project settings*/
        var status = 0;
        $('#update-project').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('project-id').value;
            console.log(id, name, description, status)
            edit_project(id, name, description, status);
        });

        const switch_status = document.getElementById('flexSwitchCheckChecked');
        $('#flexSwitchCheckChecked').click(function () {
            status = switch_status.value;
            const isChecked = switch_status.checked;
            const status_input = $('#status-project');
            if (isChecked) {
                status_input.html("Active");
                status_input.css("background-color", "#3fd9cb");
                status = 1;
            } else {
                status_input.html("Pended");
                status_input.css("background-color", "#d93f51");
                status = 0;
            }
            switch_status.value = status;
        })

        var type = 0;
        const spinner_type = document.getElementById('type');
        $('#type').click(function () {
            type = spinner_type.value;
            const type_strong = $('#user_type_strong');
            if (type == 0) {
                type_strong.html("Admin");
                type_strong.css("background-color", "#003198");
            } else if (type == 1) {
                type_strong.html("Manager");
                type_strong.css("background-color", "#00a445");
            } else if (type == 2) {
                type_strong.html("Worker");
                type_strong.css("background-color", "#f89500");
            }
        })

        $('#remove-project').click(function () {
            var project_id = document.getElementById('project-id').value;
            var subproject_size = document.getElementById('subproject-size').value;
            if (subproject_size === 0)
                delete_project(project_id)
            else {
                $('#can-not-remove').modal('show');
            }
        });

        create_activity();


    })

    function get_activities_as() {
        table.DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            sDom: 'lrtip',
            "order": [[0, "desc"]],
            ajax: {
                "url": '/activities',
                "type": 'GET',
                "data": function (d) {
                    //d.user_type = in_user_type.val()
                }
            },
            columns: [
                {
                    name: 'id',
                }, {
                    data: 'name',
                    name: 'name',
                }, {
                    data: 'description',
                    name: 'description',
                }, {
                    data: 'subproject',
                    name: 'subproject',
                }, {
                    data: 'worker',
                    name: 'worker',
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
    }

    function edit_project(id, name, description, status) {
        $.ajax({
            method: "POST",
            url: "/projects/update/" + id,
            data: {
                _token: $("input[name=_token]").val(),
                action: "update",
                name: name,
                description: description,
                status: status
            },
            success: function (response) {
                $('#successfully-save').modal('show');
            }
        });
    }

    function delete_project(id) {
        $.ajax({
            type: "DELETE",
            url: "/projects/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {

            }
        });
    }

    function create_activity() {

        const name_error = $('#name_error');
        const description_error = $('#description_error');
        name_error.css('display', 'none');
        description_error.css('display', 'none');

        $('#create_activity').click(function () {
            const name = $('#name').val();
            const description = $('#description').val();
            const type = $('#type').val();
            const worker = $('#worker').val();
            const subproject = $('#subproject').val();
            const status = $('#flexSwitchCheckChecked').val();
            //console.log(name, phone, email, type, status)
            $.ajax({
                type: "POST",
                url: "/activities/create",
                data: {
                    _token: $("input[name=_token]").val(),
                    action: "create",
                    name: name,
                    description: description,
                    type: type,
                    worker: worker,
                    subproject: subproject,
                    status: status,
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        name_error.css('display', 'none');
                        description_error.css('display', 'none');
                        $('#successfully-creat-activity').modal('show');
                        table.DataTable().ajax.reload();
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

            function printErrorMsg(msg) {
                if (msg['name']) {
                    name_error.html(msg['name']);
                    name_error.css('display', 'block');
                } else {
                    name_error.css('display', 'none');
                }
                if (msg['description']) {
                    $('#description_error').html(msg['description']);
                    description_error.css('display', 'block');
                } else {
                    description_error.css('display', 'none');
                }
            }
        });

    }
});
/*End Project Setting and edit*/

