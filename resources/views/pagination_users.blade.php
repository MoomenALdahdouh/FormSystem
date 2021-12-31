<table class="table">
    <thead>
    <tr>
        <th scope="col">{{__('strings.sl_no')}}</th>
        <th scope="col">{{__('strings.name')}}</th>
        <th scope="col">{{__('strings.email')}}</th>
        <th scope="col">{{__('strings.created_at')}}</th>
        <th scope="col">{{__('strings.type')}}</th>
        <th scope="col">{{__('strings.status')}}</th>
        <th scope="col">{{__('strings.action')}}</th>
    </tr>

    </thead>
    @if(count($users) >0)
        <tbody>
        @php($count = 1) {{--Here this way to show columen number not work with paging so we use other way $subprojects->firstItem()+$loop->index--}}
        @foreach($users as $user)
            <tr>
                <th scope="row">{{$count++}}</th> {{--not work with paging--}}
                {{--<th scope="row">{{$subproject->subproject->firstItem()+$loop->index}}</th>--}}
                <td>{{$user->name}}</td>
                {{--<td>{{$subproject->user_id}}</td>--}} {{--Just aarived to user id so we will join two table to arrived --}}
                <td>{{$user->email}}</td>
                @if($user->created_at == NULL)
                    <td><span class="text-danger">No Date Set</span></td>
                @else
                    <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                @endif
                @switch($user->type)
                    @case(0)
                    <td><span class="paragraph-admin shadow">{{__('strings.admin')}}</span></td>
                    @break
                    @case (1)
                    <td><span class="paragraph-manager shadow">{{__('strings.manager')}}</span></td>
                    @break
                    @case (2)
                    <td><span class="paragraph-worker shadow">{{__('strings.worker')}}</span></td>
                    @break
                @endswitch
                @if($user->status == 0)
                    <td><span class="paragraph-pended shadow">{{__('strings.pended')}}</span></td>
                @else
                    <td><span class="paragraph-active shadow">{{__('strings.active')}}</span></td>
            @endif
            <!--Use this line if you compact users from Auth-->
                <!--Use this line if you compact users from DB to pars the date by carbon library-->
                <td>
                    <button id="delete-activity"
                            class="btn-outline-danger rounded-2 p-1" title="delete"><i class='bx bx-trash'><input
                                type="hidden" id="activity-id" name="activity-id" value="{{$user->id}}"></i>
                    </button>
                    &nbsp
                    <a href="{{url('activities/edit/'.$user->id .'#edit-activity')}}"
                       class="btn-outline-dark rounded-2 p-1" title="settings">
                        <i class="las la-cog"></i></a>
                    &nbsp
                    <a href="{{url('activities/view/'.$user->id)}}" class="btn-outline-primary rounded-2 p-1"
                       title="view">
                        <i class="las la-external-link-alt"></i></a>
                </td>
            </tr>
            <input type="hidden" id="subproject-size" name="subproject-size"
                   value="{{$count}}">
        @endforeach
        </tbody>
    @else
        <th class="alert alert-light" scope="row"><br>{{__('strings.no_subprojects')}}</th>
    @endif
</table>

{{--{{$subproject->subproject->links()}}--}}
