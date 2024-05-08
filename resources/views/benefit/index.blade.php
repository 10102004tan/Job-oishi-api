<x-layout>
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @endif
    <h1>Benefit Managerment </h1>
        <a href="{{ route('benefits.create') }}" class="btn btn-outline-primary my-3"><i class="bi bi-plus-circle"></i></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Benefit Name</th>
                <th>Benefit Icon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($benefits as $benefit)
            <tr>
                <td>{{ $benefit->id }}</td>
                <td>{{ $benefit->value }}</td>
                <td>{{ $benefit->icon }}</td>
                <td>
                    <a href="{{ route('benefits.edit', $benefit->id) }}"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('benefits.destroy', $benefit->id) }}" class="d-inline" method="post" onsubmit="return confirm('Bạn có muốn xóa quyền lợi này không?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn text-danger"><i class="bi bi-trash"></i></button>
                    </form>

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</x-layout>