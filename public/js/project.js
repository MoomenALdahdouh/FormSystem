$(function () {
    const table = $('#projects-table');
    let status = 0;
    let removed = false;
    $(document).ready(function () {
        get_projects_as();
        /*start Project Setting and edit*/
        $("#name").focus();

        $(document).on('click', '#view', function () {
            var id = $(this).data('id');
            location.href = "/projects/view/" + id;
        });

        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            location.href = "/projects/edit/" + id;
        });

        $(document).on('click', '#delete', function () {
            var id = $(this).data('id');
            delete_project(id);
            //location.href = "/projects/delete/" + id;
        });

        $('#update-project').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('project-id').value;
            status = document.getElementById('flexSwitchCheckChecked').value;
            edit_project(id, name, description, status);
        });
        status = document.getElementById('flexSwitchCheckChecked').value;
        $('#flexSwitchCheckChecked').click(function () {
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

        $('#remove-project').click(function () {
            removed = false;
            var project_id = document.getElementById('project-id').value;
            delete_project(project_id)
            setTimeout(function () {
                if (removed)
                    location.href = "/projects";
            }, 2000);
        });
        create_project();
    });

    function get_projects_as() {
        table.DataTable({
            ajax: {
                "url": '/projects',
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
                    data: 'manager_fk_id',
                    name: 'manager_fk_id',
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

    function create_project() {
        $('#create_project').click(function () {
            const name_error = $('#name_error');
            const description_error = $('#description_error');
            const manager_error = $('#manager_error');
            name_error.css('display', 'none');
            description_error.css('display', 'none');
            manager_error.css('display', 'none');
            const name = $('#name').val();
            const description = $('#description').val();
            const manager = $('#manager').val();
            //console.log(name, description, manager, status)
            $.ajax({
                type: "POST",
                url: "/projects/create",
                data: {
                    _token: $("input[name=_token]").val(),
                    action: "create",
                    name: name,
                    description: description,
                    manager: manager,
                    status: status,
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        name_error.css('display', 'none');
                        description_error.css('display', 'none');
                        manager_error.css('display', 'none');
                        $('#name').val("");
                        $('#description').val("");
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
                    description_error.html(msg['description']);
                    description_error.css('display', 'block');
                } else {
                    description_error.css('display', 'none');
                }
                if (msg['manager']) {
                    description_error.html(msg['manager']);
                    manager_error.css('display', 'block');
                } else {
                    manager_error.css('display', 'none');
                }
            }
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
                //alert(response['success'])
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
                if (response['success']) {
                    $('#successfully-remove').modal('show');
                    table.DataTable().ajax.reload();
                    removed = true;
                } else {
                    $('#can-not-remove').modal('show');
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
