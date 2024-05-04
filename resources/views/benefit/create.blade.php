<x-layout>
    <h1>Create Infomation Benefit</h1>
    <form action="{{ route('benefits.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="value" class="form-label">Benefit Name</label>
            <input type="text" class="form-control" id="value" name="value">
            @error('value')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Benefit Icon</label>
            <textarea class="form-control" id="icon" name="icon"></textarea>
            @error('icon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>