<table class="trash_trash table">
    <thead>
    <tr class=" text-dark">
        <th scope="col">SL No</th>
        <th scope="col">Name</th>
        <th scope="col">Created By</th>
        <th scope="col">Manage By</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
    </tr>

    </thead>
    <tbody>
    @php($count = 1)
    @foreach($trash as $project)
        <tr>
            {{--<th scope="row">{{$count++}}</th>--}}
            {{--not work with paging--}}
            <th scope="row">{{$trash->firstItem()+$loop->index}}</th>
            <td>{{$project->name}}</td>
            {{--<td>{{$project->user_id}}</td>--}}
            {{--Just aarived to user id so we will join two table to arrived--}}
            <td>{{$project->createBy->name}}</td>
            {{--Use this when join table by ROM method--}}
            <td>{{@$project->manageBy->name}}</td>
            {{--<td>{{$project->name}}</td>--}}
            {{--After join With Query builder--}}
            {{--<td>{{$project->created_at}}</td>--}}
            @if($project->created_at == NULL)
                <td><span class="text-danger">No Date Set</span></td>
            @else
                <td>{{\Carbon\Carbon::parse($project->created_at)->diffForHumans()}}</td>
        @endif
        <!--Use this line if you compact users from Auth-->
            <!--Use this line if you compact users from DB to pars the date by carbon library-->
            <td>
                <input value="{{$project->id}}" type="hidden" id="project_id">
                <button
                    class="force_delete btn-outline-danger sm:rounded-md" title="delete"><i class='bx bx-trash'></i>
                </button>
                {{--<a href="{{url('projects/forcedelete/'.$project->id)}}"
                   class="btn btn-outline-danger" title="force delete"><i
                        class="fa fa-trash"></i>FORCE DELETE</a>--}}
                &nbsp
                {{--<a href="{{url('projects/restore/'.$project->id)}}"
                   class="btn btn-outline-dark" title="restore"><i
                        class="las la-trash-restore"></i></a>--}}
                <button
                    class="restore btn-outline-dark sm:rounded-md" title="restore"><i class="las la-trash-restore"></i>
                </button>
                &nbsp
                <a href="{{url('projects/project/id/'.$project->id)}}" class="btn-outline-primary sm:rounded-md"
                   title="view">
                    <i class="las la-external-link-alt"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$trash->links()}}

<script type="text/javascript">
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

            /*$('#add_project').click(function () {
                var project_name = document.getElementById('name').value;
                var manager_id = document.getElementById('manager').value;
                add_project(project_name, manager_id);
            });*/

            Array.from(document.querySelectorAll('.restore')).forEach(bttn => {
                bttn.addEventListener('click', (e) => {
                    e.preventDefault();
                    let project_id = e.target.parentNode.querySelector('#project_id').value;
                    //var project_id = document.getElementById('project_id').value;
                    //console.log(parseInt(project_id))
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
                type: "delete",
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
</script>

