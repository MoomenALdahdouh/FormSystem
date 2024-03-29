/*start Project Setting and edit*/
$(function () {
    const table = $('#activities-table');
    const is_activity_page = $('#is_activity_page').val();
    let removed = false;
    let workers_list = [];
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
            var type = $(this).data('type');
            if (type === 0)
                location.href = "/activities/view/" + id;
            else
                location.href = "/subactivities/view/" + id;
        });

        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            var type = $(this).data('type');
            if (type === 0)
                location.href = "/activities/edit/" + id;
            else
                location.href = "/subactivities/edit/" + id;
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
        $('#type').on('change', function () {
            type = $('#type').val();
            if (type == 0) {
                console.log("0")
                $('#worker_part').removeClass("d-none")
            } else if (type == 1) {
                console.log("1")
                $('#worker_part').addClass("d-none")
            }
        });

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
        select_workers();
        delete_worker();
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
                    subproject: subproject,
                    status: status,
                },
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        name_error.css('display', 'none');
                        description_error.css('display', 'none');
                        if (type == 0)
                            createForm(data.activity_fk_id, worker, subproject);
                        else
                            createSubActivity(data.activity_fk_id, subproject);

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
                if (msg['user_fk_id']) {
                    worker_selected_error.html(msg['user_fk_id']);
                    worker_selected_error.css('display', 'block');
                } else {
                    worker_selected_error.css('display', 'none');
                }
            }


        });
    }

    let worker_selector = $('#worker');
    let worker_selected_list = $('#worker_selected');

    function delete_worker() {
        $(document).on('click', '#delete_worker', function () {
            var id = $(this).data('id');
            let item_list = $('#' + id);
            item_list.remove();
            for (let i = 0; i < workers_list.length; i++) {
                console.log(workers_list[i].toString() + "::" + id.toString());
                if (workers_list[i].toString() == id.toString()) {
                    workers_list.splice(i);
                    console.log("Ssss");
                }
            }
            //delete from database
        });
    }

    function select_workers() {
        workers_list.push(worker_selector.val());
        worker_selector.on('change', function () {
            var worker_id = worker_selector.val();
            var worker_name = $('#worker option:selected').text();
            console.log(workers_list.indexOf(worker_id));
            if (workers_list.indexOf(worker_id) === -1) {
                workers_list.push(worker_id);
                var body_worker = $('#worker_selected').html();
                $('#worker_selected').html(body_worker + worker_item(worker_id, worker_name));
                //add on database
            }
            console.log(workers_list.length);
        });
    }

    function createForm(activity, worker, subproject) {
        const worker_selected_error = $('#worker_selected_error');
        worker_selected_error.css('display', 'none');
        console.log(activity);
        $.ajax({
            type: "POST",
            url: "/form/create",
            data: {
                _token: $("input[name=_token]").val(),
                action: "create",
                activity_fk_id: activity,
                workers_list: workers_list,
                subproject_fk_id: subproject,
                user_fk_id: worker,
            },
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    $('#successfully-creat-activity').modal('show');
                    table.DataTable().ajax.reload();
                    worker_selected_error.css('display', 'none');
                    $('#name').val("");
                    $('#description').val("");
                } else {
                    printErrorMsg(data.error);
                }

            }
        });

        function printErrorMsg(msg) {
            if (msg['user_fk_id']) {
                worker_selected_error.html(msg['user_fk_id']);
                worker_selected_error.css('display', 'block');
            } else {
                worker_selected_error.css('display', 'none');
            }
        }
    }

    function worker_item(worker_id, worker_name) {
        return "<div class=\"btn btn-primary mr-2\" id=" + worker_id + ">\n" +
            "                                                            <span>" + worker_name + "</span>&nbsp;\n" +
            "                                                            <i class='las la-times' id=\"delete_worker\" data-id=" + worker_id + " ></i>\n" +
            "                                                        </div>";

    }

    function createSubActivity(activity, worker, subproject) {
        $.ajax({
            type: "POST",
            url: "/subactivities/create",
            data: {
                _token: $("input[name=_token]").val(),
                action: "create",
                activity_fk_id: activity,
                subproject_fk_id: subproject,
            },
            success: function (data) {
                if ($.isEmptyObject(data.error)) {
                    $('#successfully-creat-activity').modal('show');
                    table.DataTable().ajax.reload();
                    $('#name').val("");
                    $('#description').val("");
                    // createForm(data.subactivity_fk_id, worker, subproject);
                }
            }
        });
    }
});
/*End Project Setting and edit*/

