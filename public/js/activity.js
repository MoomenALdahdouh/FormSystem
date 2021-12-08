/*start Project Setting and edit*/
$(function () {
    const table = $('#activities-table');
    const is_activity_page = $('#is_activity_page').val();
    let removed = false;
    $(document).ready(function () {
        $("#name").focus();
        if (is_activity_page != 0)
            get_activities_as();
        $(document).on('click', '#form', function () {
            var id = $(this).data('id');
            location.href = "/form/edit/" + id;
        });

        $(document).on('click', '#apply', function () {
            var id = $(this).data('id');
            location.href = "/form/apply/" + id;
        });

        $(document).on('click', '#view', function () {
            var id = $(this).data('id');
            location.href = "/activities/view/" + id;
        });

        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            location.href = "/activities/edit/" + id;
        });

        $(document).on('click', '#delete', function () {
            var activity_id = $(this).data('id');
            delete_activity(activity_id);
            /* //location.href = "/activities/delete/" + id;
             $.ajax({
                 type: "get",
                 url: "/activities/delete/" + id,
                 success: function (response) {
                     $('#successfully-remove').modal('show');
                     table.DataTable().ajax.reload();
                 }
             });*/
        });

        /*Project settings*/
        var status = 0;
        $('#update-activity').click(function () {
            var name = document.getElementById('name').value;
            var description = document.getElementById('description').value;
            var id = document.getElementById('activity-id').value;
            status = document.getElementById('flexSwitchCheckChecked').value;
            edit_activity(id, name, description, status);
        });

        $('#flexSwitchCheckChecked').click(function () {
            const switch_status = document.getElementById('flexSwitchCheckChecked');
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
            type = spinner_type.value
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

        $('#remove-activity').click(function () {
            var activity_id = document.getElementById('activity-id').value;
            removed = false;
            delete_activity(activity_id);
            setTimeout(function () {
                if (removed)
                    location.href = "/activities";
            }, 2000);
        });
        create_activity();
    })

    function get_activities_as() {
        table.DataTable({
            /*processing: true,
            serverSide: true,
            pageLength: 10,
            sDom: 'lrtip',
            "order": [[0, "desc"]],*/
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

    function edit_activity(id, name, description, status) {
        $.ajax({
            method: "POST",
            url: "/activities/update/" + id,
            data: {
                _token: $("input[name=_token]").val(),
                action: "update",
                name: name,
                description: description,
                status: status
            },
            success: function (response) {
                console.log(response)
                if (response['success']) {
                    $('#successfully-save').modal('show');
                    $('#successfully-save #message').html(response['success']);
                } else if (response['error']) {
                    $('#something-wrong').modal('show');
                    $('#something-wrong #message').html(response['error']);
                }
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
                    $('#successfully-remove #message').html(response['success'])
                    removed = true;
                    table.DataTable().ajax.reload();
                } else if (response['error']) {
                    $('#something-wrong').modal('show');
                    $('#something-wrong #message').html(response['error'])
                }
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
                $('#successfully-creat-activity').modal('show');
                table.DataTable().ajax.reload();
                $('#name').val("");
                $('#description').val("");
            }
        });
    }
});
/*End Project Setting and edit*/

