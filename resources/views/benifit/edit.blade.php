<x-layout>
    <h1>Edit Information Benefit</h1>
    <form action="{{ route('benifits.update', $benifit->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="benifit_name" class="form-label">Benefit Name</label>
            <input type="text" class="form-control" id="benifit_name" name="benifit_name" value="{{ $benifit->benifit_name }}">
            @error('benifit_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="benifit_icon" class="form-label">Benefit Icon</label>
            <input type="text" class="form-control" id="benifit_icon" name="benifit_icon" value="{{ $benifit->benifit_icon }}">
            @error('benifit_icon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>
