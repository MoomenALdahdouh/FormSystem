<table class="table">
    <thead>
    <tr>
        <th scope="col">SL No</th>
        <th scope="col">Name</th>
        <th scope="col">Main Project</th>
        <th scope="col">User</th>
        <th scope="col">Created At</th>
        <th scope="col">Action</th>
    </tr>

    </thead>
    @if(count($project->subproject) >0)
        <tbody>
        @php($count = 1) {{--Here this way to show columen number not work with paging so we use other way $subprojects->firstItem()+$loop->index--}}
        @foreach($project->subproject as $subproject)
            <tr>
                <th scope="row">{{$count++}}</th> {{--not work with paging--}}
                {{--<th scope="row">{{$project->subproject->firstItem()+$loop->index}}</th>--}}
                <td>{{$subproject->name}}</td>
                {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                <td>{{@$subproject->mainProject->name}}</td>
                <td>{{$subproject->user->name}}</td> {{--Use this when join table by ROM method--}}
                {{--<td>{{$subproject->name}}</td>--}}  {{--After join with Quiry builder --}}
                {{--<td>{{$subproject->created_at}}</td>--}}
                @if($subproject->created_at == NULL)
                    <td><span class="text-danger">No Date Set</span></td>
                @else
                    <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
            @endif
            <!--Use this line if you compact users from Auth-->
                <!--Use this line if you compact users from DB to pars the date by carbon library-->
                <td>
                    <a href="{{url('subprojects/delete/'.$subproject->id)}}"
                       class="btn-outline-danger sm:rounded-md" title="delete"><i class='bx bx-trash'></i></a>
                    &nbsp
                    <a href="{{url('subprojects/edit/'.$subproject->id .'#edit-subproject')}}"
                       class="btn-outline-dark sm:rounded-md" title="settings">
                        <i class="las la-cog"></i></a>
                    &nbsp
                    <a href="{{url('subprojects/view/'.$subproject->id)}}" class="btn-outline-primary sm:rounded-md"
                       title="view">
                        <i class="las la-external-link-alt"></i></a>
                </td>
            </tr>
            <input type="hidden" id="subproject-size" name="subproject-size"
                   value="{{$count}}">
        @endforeach
        </tbody>
    @else
        <th class="alert alert-light" scope="row"><br>this project not have any subproject ...</th>
    @endif
</table>

{{--{{$project->subproject->links()}}--}}
