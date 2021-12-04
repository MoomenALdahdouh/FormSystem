$(function () {
    const table = $('#subprojects-table');
    let status = 0;
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
            location.href = "/subprojects/delete/" + id;
        });

        $('#update-subproject').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('subproject-id').value;
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

        $('#remove-project').click(function () {
            var project_id = document.getElementById('project-id').value;
            var subproject_size = document.getElementById('subproject-size').value;
            if (subproject_size === 0)
                delete_project(project_id)
            else {
                $('#can-not-remove').modal('show');
            }
        });
    })

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

    function delete_project(id) {
        $.ajax({
            type: "DELETE",
            url: "/subprojects/delete/" + id,
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
