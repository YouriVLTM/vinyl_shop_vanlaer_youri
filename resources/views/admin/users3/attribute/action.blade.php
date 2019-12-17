@if(auth()->id() == $user->id)
    <div class="btn-group btn-group-sm">
        <a href="#" class="btn btn-outline-info btn-key" data-id="{{$user->id}}">
            <i class="fas fa-key"></i>
        </a>
        <a href="#" class="btn btn-outline-success btn-edit" data-id="{{$user->id}}">
            <i class="fas fa-edit" ></i>
        </a>
    </div>

@else

    <div class="btn-group btn-group-sm">
        <a href="#" class="btn btn-outline-info btn-key" data-id="{{$user->id}}">
            <i class="fas fa-key"></i>
        </a>
        <a href="#" class="btn btn-outline-success btn-edit" data-id="{{$user->id}}">
            <i class="fas fa-edit"></i>
        </a>
        <a href="#" class="btn btn-outline-danger btn-delete" data-id="{{$user->id}}">
            <i class="fas fa-trash-alt"></i>
        </a>
    </div>

@endif