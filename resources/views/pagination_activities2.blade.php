<table class="table">
    <thead>
    <tr>
        <th scope="col">SL No</th>
        <th scope="col">Name</th>
        <th scope="col">Subproject</th>
        <th scope="col">User</th>
        <th scope="col">Created At</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>

    </thead>
    @if(count($activities) >0)
        <tbody>
        @php($count = 1) {{--Here this way to show columen number not work with paging so we use other way $subprojects->firstItem()+$loop->index--}}
        @foreach($activities as $activity)
            <tr>
                <th scope="row">{{$count++}}</th> {{--not work with paging--}}
                {{--<th scope="row">{{$subproject->subproject->firstItem()+$loop->index}}</th>--}}
                <td>{{$activity->name}}</td>
                {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                <td>{{@$activity->subproject->name}}</td>
                <td>{{$activity->worker->name}}</td> {{--Use this when join table by ROM method--}}
                {{--<td>{{$subproject->name}}</td>--}}  {{--After join with Quiry builder --}}
                {{--<td>{{$subproject->created_at}}</td>--}}
                @if($activity->created_at == NULL)
                    <td><span class="text-danger">No Date Set</span></td>
                @else
                    <td>{{\Carbon\Carbon::parse($activity->created_at)->diffForHumans()}}</td>
                @endif
                @if($activity->status == 0)
                    <td><span class="paragraph-pended shadow">Pended</span></td>
                @else
                    <td><span class="paragraph-active shadow">Active</span></td>
            @endif
            <!--Use this line if you compact users from Auth-->
                <!--Use this line if you compact users from DB to pars the date by carbon library-->
                <td>
                    <button id="delete-activity"
                            class="btn-outline-danger sm:rounded-md" title="delete"><i class='bx bx-trash'><input
                                type="hidden" id="activity-id" name="activity-id" value="{{$activity->id}}"></i>
                    </button>
                    &nbsp
                    <a href="{{url('activities/edit/'.$activity->id .'#edit-activity')}}"
                       class="btn-outline-dark sm:rounded-md" title="settings">
                        <i class="las la-cog"></i></a>
                    &nbsp
                    <a href="{{url('activities/view/'.$activity->id)}}" class="btn-outline-primary sm:rounded-md"
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

{{--{{$subproject->subproject->links()}}--}}