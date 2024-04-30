<x-layout>
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @endif
    <h1>Benifit Managerment </h1>
        <a href="{{ route('benifits.create') }}" class="btn btn-outline-primary my-3"><i class="bi bi-plus-circle"></i></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Benifit Name</th>
                <th>Benifit Icon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($benifits as $benifit)
            <tr>
                <td>{{ $benifit->id }}</td>
                <td>{{ $benifit->benifit_name }}</td>
                <td>{{ $benifit->benifit_icon }}</td>
                <td>
                    <a href="{{ route('benifits.edit', $benifit->id) }}"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('benifits.destroy', $benifit->id) }}" class="d-inline" method="post" onsubmit="return confirm('Bạn có muốn xóa quyền lợi này không?')">
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