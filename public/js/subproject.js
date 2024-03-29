$(function () {
    const table = $('#subprojects-table');
    let status = 0;
    let removed = false;
    $(document).ready(function () {
        get_subprojects_as();
        /*start Project Setting and edit*/
        $("#name").focus();

        $(document).on('click', '#view', function () {
            var id = $(this).data('id');
            location.href = "/subprojects/view/" + id;
        });

        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            location.href = "/subprojects/edit/" + id;
        });

        $(document).on('click', '#delete', function () {
            var id = $(this).data('id');
            delete_subproject(id);
        });

        $('#update-subproject').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('subproject-id').value;
            status = document.getElementById('flexSwitchCheckChecked').value;
            edit_subproject(id, name, description, status);
        });

        $('#flexSwitchCheckChecked').click(function () {
            status = document.getElementById('flexSwitchCheckChecked').value;
            const isChecked = document.getElementById("flexSwitchCheckChecked").checked;
            const project_status = $('#status-project');
            if (isChecked) {
                project_status.html("Active");
                project_status.css("background-color", "#3fd9cb");
                status = 1;
            } else {
                project_status.html("Pended");
                project_status.css("background-color", "#d93f51");
                status = 0;
            }
        })

        $('#remove-subproject').click(function () {
            removed = false;
            var project_id = document.getElementById('subproject-id').value;
            delete_subproject(project_id)
            setTimeout(function () {
                if (removed)
                    location.href = "/subprojects";
            }, 2000);
        });

        create_subproject();
    });

    function create_subproject() {
        const name_error = $('#name_error');
        const description_error = $('#description_error');
        const project_error = $('#project_error');
        name_error.css('display', 'none');
        description_error.css('display', 'none');
        project_error.css('display', 'none');

        $('#create_subproject').click(function () {
            const name = $('#name').val();
            const description = $('#description').val();
            const project = $('#project').val();
            const status = $('#flexSwitchCheckChecked').val();
            //console.log(name, phone, email, type, status)
            $.ajax({
                type: "POST",
                url: "/subprojects/create",
                data: {
                    _token: $("input[name=_token]").val(),
                    action: "create",
                    name: name,
                    description: description,
                    project: project,
                    status: status,
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        name_error.css('display', 'none');
                        description_error.css('display', 'none');
                        project_error.css('display', 'none');
                        $('#successfully-creat').modal('show');
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
                if (msg['project']) {
                    $('#project_error').html(msg['project']);
                    project_error.css('display', 'block');
                } else {
                    project_error.css('display', 'none');
                }
            }

            /*function fetch_projects(page) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('projects.all') }}" + "?page=" + page,
                    success: function (response) {
                        $('#table-data').html(response)
                    }
                });
            }*/
        });
    }

    function get_subprojects_as() {
        table.DataTable({
            ajax: {
                "url": '/subprojects',
                "type": 'GET',
                "data": function (d) {
                    //TODO: Use this line to filter data in the table
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
                    data: 'user_fk_id',
                    name: 'user_fk_id',
                }, {
                    data: 'project_fk_id',
                    name: 'project_fk_id',
                }, {
                    data: 'created_at',
                    name: 'created_at',
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

    function edit_subproject(id, name, description, status) {
        $.ajax({
            method: "POST",
            url: "/subprojects/update/" + id,
            data: {
                _token: $("input[name=_token]").val(),
                action: "update",
                name: name,
                description: description,
                status: status
            },
            success: function (response) {
                //alert(response['success'])
                $('#successfully-save').modal('show');
            }
        });
    }

    function delete_subproject(id) {
        $.ajax({
            type: "DELETE",
            url: "/subprojects/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                if (response['success']) {
                    $('#successfully-remove').modal('show');
                    table.DataTable().ajax.reload();
                    removed = true;
                } else {
                    $('#can-not-remove-subproject').modal('show');
                }
            }
        });
    }
});
/*End Project Setting and edit*/

/*Start Users*/
/*Admin*/

/*End Users*/

/*End Project Setting and edit*/
/*End Project Setting and edit*/
