<table class="table">
    <thead>
    <tr>
        <th scope="col">SL No</th>
        <th scope="col">Name</th>
        <th scope="col">Created By</th>
        <th scope="col">Main Project</th>
        <th scope="col">Created At</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>

    </thead>
    @if(count($subprojects) >0)
        <tbody>
        @php($count = 1) {{--Here this way to show columen number not work with paging so we use other way $subprojects->firstItem()+$loop->index--}}
        @foreach($subprojects as $subproject)
            <tr>
                <th scope="row">{{$count++}}</th> {{--not work with paging--}}
                {{--<th scope="row">{{$subprojects->firstItem()+$loop->index}}</th>--}}
                <td>{{$subproject->name}}</td>
                {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                <td>{{$subproject->user->name}}</td> {{--Use this when join table by ROM method--}}
                <td>{{@$subproject->mainProject->name}}</td>
                {{--<td>{{$subproject->name}}</td>--}}  {{--After join with Quiry builder --}}
                {{--<td>{{$subproject->created_at}}</td>--}}
                @if($subproject->created_at == NULL)
                    <td><span class="text-danger">No Date Set</span></td>
                @else
                    <td>{{\Carbon\Carbon::parse($subproject->created_at)->diffForHumans()}}</td>
                @endif
                @if($subproject->status == 0)
                    <td><span class="paragraph-pended shadow">Pended</span></td>
                @else
                    <td><span class="paragraph-active shadow">Active</span></td>
            @endif
            <!--Use this line if you compact users from Auth-->
                <!--Use this line if you compact users from DB to pars the date by carbon library-->
                <td>
                    <button id="delete-subproject"
                            class="btn-outline-danger sm:rounded-md" title="delete"><i class='bx bx-trash'></i>
                        <input type="hidden" id="subproject-id" name="subproject-id" value="{{$subproject->id}}"></button>
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
        <th class="alert alert-light" scope="row"><br>not found any data ...</th>
    @endif
</table>

{{--{{$subprojects->links()}}--}}
