$(function () {
    let status = 0;
    let removed = false;
    $(document).ready(function () {
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

        Array.from(document.querySelectorAll('#delete-activity')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let activity_id = e.target.parentNode.querySelector('#activity-id').value;
                delete_activity(activity_id)
            });
        });

        /*$('#delete-activity').click(function () {
            var activity_id = document.getElementById('activity-id').value;
            console.log(activity_id);
            delete_activity(activity_id)
        });*/

        create_activity();
    })

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
                        createForm(data.activity_fk_id, worker, subproject);
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

    function createForm(activity, worker, subproject) {
        $.ajax({
            type: "POST",
            url: "/form/create",
            data: {
                _token: $("input[name=_token]").val(),
                action: "create",
                activity_fk_id: activity,
                worker_fk_id: worker,
                subproject_fk_id: subproject,
            },
            success: function (data) {
                console.log(data)
                $('#name').val("");
                $('#description').val("");
                $('#successfully-creat-activity').modal('show');
                fetch_activities(subproject);
            }
        });
    }

    function fetch_activities(subproject_id) {
        $.ajax({
            type: "GET",
            url: "/activities/all",
            data: {
                _token: $("input[name=_token]").val(),
                subproject_id: subproject_id,
            },
            success: function (response) {
                $('#name').val("");
                $('#description').val("");
                $('#table-activities').html(response)
                Array.from(document.querySelectorAll('#delete-activity')).forEach(bttn => {
                    bttn.addEventListener('click', (e) => {
                        e.preventDefault();
                        let activity_id = e.target.parentNode.querySelector('#activity-id').value;
                        delete_activity(activity_id)
                    });
                });
            }
        });
    }

    function delete_activity(id) {
        $.ajax({
            type: "DELETE",
            url: "/activities/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                if (response['success']) {
                    $('#successfully-remove').modal('show');
                    fetch_activities($('#subproject').val());
                } else {
                    $('#can-not-remove-subproject').modal('show');
                }
            }
        });
    }


});
/*End Project Setting and edit*/
