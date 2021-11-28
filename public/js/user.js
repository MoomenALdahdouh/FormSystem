/*start Project Setting and edit*/
$(function () {
    const table = $('#users-table');
    const in_user_type = $('#user_type');
    $(document).ready(function () {
        get_users_as();
        $(document).on('click', '#users-all', function () {
            in_user_type.val(4);
            table.DataTable().ajax.reload();
        });
        $(document).on('click', '#users-admins', function () {
            in_user_type.val(0);
            table.DataTable().ajax.reload();
        });
        $(document).on('click', '#users-managers', function () {
            in_user_type.val(1);
            table.DataTable().ajax.reload();
            // get_users_as(user_type);
        });
        $(document).on('click', '#users-workers', function () {
            in_user_type.val(2);
            table.DataTable().ajax.reload();
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
        create_user();


    })

    function get_users_as() {
        table.DataTable({
            processing: true,
            serverSide: true,
            pageLength: 10,
            sDom: 'lrtip',
            "order": [[0, "desc"]],
            ajax: {
                "url": '/users',
                "type": 'GET',
                "data": function (d) {
                    d.user_type = in_user_type.val()
                }
            },
            columns: [
                {
                    name: 'id',
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

    function create_user() {

        const name_error = $('#name_error');
        const email_error = $('#email_error');
        const phone_error = $('#phone_error');
        name_error.css('display', 'none');
        email_error.css('display', 'none');
        phone_error.css('display', 'none');

        $('#create_user').click(function () {
            const name = $('#name').val();
            const phone = $('#phone').val();
            const email = $('#email').val();
            const type = $('#type').val();
            const status = $('#flexSwitchCheckChecked').val();
            //console.log(name, phone, email, type, status)
            $.ajax({
                type: "POST",
                url: "/users/create",
                data: {
                    _token: $("input[name=_token]").val(),
                    action: "create",
                    name: name,
                    email: email,
                    phone: phone,
                    type: type,
                    status: status,
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        name_error.css('display', 'none');
                        email_error.css('display', 'none');
                        phone_error.css('display', 'none');
                        $('#successfully-creat').modal('show');
                        in_user_type.val(4);
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
                if (msg['email']) {
                    $('#email_error').html(msg['email']);
                    email_error.css('display', 'block');
                } else {
                    email_error.css('display', 'none');
                }
                if (msg['phone']) {
                    $('#phone_error').html(msg['phone']);
                    phone_error.css('display', 'block');
                } else {
                    phone_error.css('display', 'none');
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
