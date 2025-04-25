@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->username }}</td>
    <td>
        @if($user->role !== 'super_admin') <!-- Super admin tidak bisa diubah -->
            <form action="{{ route('users.toggleRole', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-sm {{ $user->role === 'admin' ? 'btn-success' : 'btn-secondary' }}">
                    {{ $user->role === 'admin' ? 'Admin' : 'User' }}
                </button>
            </form>
        @else
            Super Admin
        @endif
    </td>
</tr>
@endforeach
