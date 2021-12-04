$(function () {
    let status = 0;
    let removed = false;
    $(document).ready(function () {
        /*start Project Setting and edit*/
        //$("#name").focus();

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
        });

        $('#delete-subproject').click(function () {
            var subproject_id = document.getElementById('subproject-id').value;
            delete_subproject(subproject_id)
        });

        create_subproject();
    })

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
                        fetch_subprojects(project);
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

    function fetch_subprojects(project_id) {
        $.ajax({
            type: "GET",
            url: "/subprojects/all",
            data: {
                _token: $("input[name=_token]").val(),
                project_id: project_id,
            },
            success: function (response) {
                $('#name').val("");
                $('#description').val("");
                $('#table-subprojects').html(response)
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
                    fetch_subprojects($('#project').val());
                } else {
                    $('#can-not-remove-subproject').modal('show');
                }
            }
        });
    }


});
/*End Project Setting and edit*/
