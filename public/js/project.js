$(function () {
    const table = $('#projects-table');
    let status = 0;
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
            location.href = "/projects/delete/" + id;
        });

        $('#update-project').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('project-id').value;
            console.log(id, name, description, status)
            edit_project(id, name, description, status);
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

        $('#remove-project').click(function () {
            var project_id = document.getElementById('project-id').value;
            var subproject_size = document.getElementById('subproject-size').value;
            if (subproject_size === 0)
                delete_project(project_id)
            else {
                $('#can-not-remove').modal('show');
            }
        });
        create_project();
        create_subproject();
    })

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

        const name_error = $('#name_error');
        const description_error = $('#description_error');
        const manager_error = $('#manager_error');
        name_error.css('display', 'none');
        description_error.css('display', 'none');
        manager_error.css('display', 'none');

        $('#create_project').click(function () {
            const name = $('#name').val();
            const description = $('#description').val();
            const manager = $('#manager').val();
            console.log(manager);
            const status = $('#flexSwitchCheckChecked').val();
            //console.log(name, phone, email, type, status)
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
                        $('#successfully-creat').modal('show');
                        //in_user_type.val(4);
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
                if (msg['manager']) {
                    $('#manager_error').html(msg['manager']);
                    manager_error.css('display', 'block');
                } else {
                    manager_error.css('display', 'none');
                }
            }
        });

    }

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
            console.log(project);
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
                        //in_user_type.val(4);
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
