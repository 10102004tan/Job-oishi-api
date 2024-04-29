<x-layout>
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @endif
    <h1>Job </h1>
        <a href="{{ route('jobs.create') }}" class="btn btn-outline-primary my-3"><i class="bi bi-plus-circle"></i></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Experience</th>
                <th>Company ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->id }}</td>
                <td>{{ $job->title }}</td>
                <td>{{ $job->content }}</td>
                <td>{{ $job->experience }}</td>
                <td>{{ $job->company_id }}</td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('jobs.destroy', $job->id) }}" class="d-inline" method="post" onsubmit="return confirm('Xóa không?')">
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