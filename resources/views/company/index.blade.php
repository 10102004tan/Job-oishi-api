<x-layout>
    @if($message = Session::get('success'))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @endif
    <h1>Company Managerment </h1>
        <a href="{{ route('companies.create') }}" class="btn btn-outline-primary my-3"><i class="bi bi-plus-circle"></i></a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>
                <th>Logo</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td>{{ $company->id }}</td>
                <td>{{ $company->display_name }}</td>
                <td><img src="{{ $company->image_logo }}" alt="" class="img-fluid" width="100px"></td>
                <td>{!! $company->description !!}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}"><i class="bi bi-pencil-square"></i></a>
                    <form action="{{ route('companies.destroy', $company->id) }}" class="d-inline" method="post" onsubmit="return confirm('Xóa không?')">
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