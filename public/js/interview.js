/*start Project Setting and edit*/
$(function () {
    const table = $('#interviews-table');
    let removed = false;
    $(document).ready(function () {
        get_interview_as();

        $(document).on('click', '#view', function () {
            var id = $(this).data('id');
            location.href = "/interviews/view/" + id;
        });

        $(document).on('click', '#delete', function () {
            var interview_id = $(this).data('id');
            delete_interview(interview_id);
        });

        $('#remove-interview').click(function () {
            var interview_id = document.getElementById('interview-id').value;
            removed = false;
            delete_interview(interview_id);
            setTimeout(function () {
                if (removed)
                    location.href = "/interview";
            }, 2000);
        });
    })

    function get_interview_as() {
        table.DataTable({
            ajax: {
                "url": '/interviews',
                "type": 'GET',
                "data": function (d) {
                    //d.user_type = in_user_type.val()
                }
            },
            columns: [
                {
                    name: 'id',
                }, {
                    data: 'title',
                    name: 'title',
                }, {
                    data: 'created_at',
                    name: 'created_at',
                }, {
                    data: 'customer_location',
                    name: 'customer_location',
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

    function edit_interview(id, name, description, status) {
        $.ajax({
            method: "POST",
            url: "/interview/update/" + id,
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

    function delete_interview(id) {
        $.ajax({
            type: "DELETE",
            url: "/interviews/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                if (response['success']) {
                    $('#successfully-remove').modal('show');
                    $('#successfully-remove #message').html(response['success'])
                    table.DataTable().ajax.reload();
                } else if (response['error']) {
                    $('#something-wrong').modal('show');
                    $('#something-wrong #message').html(response['error'])
                }
            }
        });
    }
});
/*End Project Setting and edit*/

