<li class="d-flex mt-4 mb-4">
    <a class="flex-shrink-0" href="{{ route('users.show', $user->id) }}">
        <img src="{{ $user->gravatar() }}" alt="{{$user->name}}" class="me-1 gravatar">
    </a>
    <div class="flex-grow-1 ms-3">
        <h5 class="mt-0 mt-1">{{ $user->name }} <small> / {{$status->created_at->diffForHumans()}}</small></h5>
        {{$status->content}}
    </div>
    @can('destroy', $user)
        <form action="{{ route('status.destroy', $user->id) }}" method="post" class="float-end">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
        </form>
    @endcan
</li>
