<x-layout>
    <h1>Create Infomation Benifit</h1>
    <form action="{{ route('benifits.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="benifit_name" class="form-label">Benifit Name</label>
            <input type="text" class="form-control" id="benifit_name" name="benifit_name">
            @error('benifit_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="benifit_icon" class="form-label">Benifit Icon</label>
            <textarea class="form-control" id="benifit_icon" name="benifit_icon"></textarea>
            @error('benifit_icon')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>