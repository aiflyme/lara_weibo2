<div class="list-group-item">
    {{ $user->id }}
    <img class="mr-3" src="{{ $user->gravatar() }}" alt="{{ $user->name }}" width=32>
    <a href="{{ route('users.show', $user) }}">
        {{ $user->name }}
    </a>
    @can('destroy', $user)
        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="float-end">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger delete-btn">Delete</button>
        </form>
    @endcan
</div>
