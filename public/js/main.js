$(function () {
    $(document).ready(function () {
        $('body').on('click', '#table-data .pagination a', function () {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_projects(page);
        });

        $('#table_trash').on('click', '.pagination a', function () {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_trash_projects(page);
        });

        $('.delete').click(function () {
            var project_id = document.getElementById('project_id').value;
            delete_project(project_id);

        });
        $('.force_delete').click(function () {
            var project_id = document.getElementById('project_id').value;
            force_delete_project(project_id);

        });

        $('#add_project').click(function () {
            var project_name = document.getElementById('name').value;
            var manager_id = document.getElementById('manager').value;
            add_project(project_name, manager_id);
        });
        Array.from(document.querySelectorAll('.restore')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let project_id = e.target.parentNode.querySelector('#project_id').value;
                restore_project(project_id);
            });
        });
        /*$('.restore').click(function () {
            var project_id = document.getElementById('project_id').value;
            restore_project(project_id);

        });*/
    });

    function fetch_projects(page) {
        $.ajax({
            type: "GET",
            url: "{{ route('projects.all') }}" + "?page=" + page,
            success: function (response) {
                $('#table-data').html(response)
            }
        });
    }

    function fetch_trash_projects(page) {
        $.ajax({
            type: "GET",
            url: "{{ route('projects.trash') }}" + "?page=" + page,
            success: function (response) {
                $('#table_trash').html(response)
            }
        });
    }

    function delete_project(id) {
        $.ajax({
            type: "get",
            url: "/projects/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                fetch_projects(1)
                fetch_trash_projects(1)
            }
        });
    }

    function force_delete_project(id) {
        $.ajax({
            type: "GET",
            url: "/projects/forcedelete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                fetch_trash_projects(1)
            }
        });
    }

    function restore_project(id) {
        $.ajax({
            type: "GET",
            url: "/projects/restore/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {
                fetch_projects(1)
                fetch_trash_projects(1)
            }
        });
    }

    function add_project(project_name, manager_id) {
        $.ajax({
            method: "POST",
            url: "{{route('project.create')}}",
            data: {_token: $("input[name=_token]").val(), name: project_name, manager: manager_id},
            success: function (response) {
                fetch_projects(1)
            }
        });
    }
});
