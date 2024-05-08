<x-layout>
    <h1>Edit Information Benefit</h1>
    <form action="{{ route('benefits.update', $benifit->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="value" class="form-label">Benefit Name</label>
            <input type="text" class="form-control" id="value" name="value" value="{{ $benifit->value }}">
            @error('value')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label">Benefit Icon</label>
            <input type="text" class="form-control" id="icon" name="icon" value="{{ $benifit->icon }}">
            @error('icon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>
