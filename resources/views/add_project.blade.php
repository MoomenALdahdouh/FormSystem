
<div class="mb-3">
    <label for="name" class="form-label">Project Name</label>
    <input type="text" class="form-control" id="name" name="name"
           placeholder="Project Name"
           aria-describedby="nameHelp" required>
    @error('name')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <br>
    <div>
        <p>Select User manager</p>
        <div>
            <select name="manager" id="manager"
                    class="manager-dropdown form-control input-group-lg">
                <option hidden>Select Manager</option>
                @if($users == '[]')
                    <option class="alert-warning"
                            value=""> Empty All managers are busy...
                    </option>
                @else
                    @foreach ($users as $user)
                        @if($user->project_fk_id == 0)
                            <option class="alert-warning"
                                    value="{{ $user->id }}">{{ $user->name }}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            {{csrf_field()}}
        </div>
        @error('manager')
        <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
</div>
<button id="add_project" class="btn btn-primary"><i class="las la-plus-square"></i>&nbsp
    Create Project
</button>
