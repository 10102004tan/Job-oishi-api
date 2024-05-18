<x-layout>
    <h1>Create Infomation Company</h1>
    <form action="{{ route('companies.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="display_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name">
            @error('display_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image_logo" class="form-label">Company Photo</label>
            <textarea class="form-control" id="image_logo" name="image_logo"></textarea>
            @error('image_logo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website">
            @error('website')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" class="form-control" id="tagline" name="tagline">
            @error('tagline')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_size" class="form-label">Company Size</label>
            <input type="text" class="form-control" id="company_size" name="company_size">
            @error('company_size')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
       
        <div class="mb-3">
            <label for="num_job_openings" class="form-label">Number Job Openings</label>
            <input type="text" class="form-control" id="num_job_openings" name="num_job_openings">
            @error('num_job_openings')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <label class="form-label">Phúc lợi:</label>
        @foreach($benefits as $benefit)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $benefit->id }}" name="benefits[]" id="benefit-{{ $benefit->id }}">
            <label class="form-check-label" for="benefit-{{ $benefit->id }}">
                {{ $benefit->value }}
            </label>
        </div>
        @endforeach

        <div class="mb-3">
            <label for="nationality_id" class="form-label">Nationality ID</label>
            <input type="text" class="form-control" id="nationality_id" name="nationality_id">
            @error('nationality_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <span class="btn btn-primary btn-add">Add</span>
        <div class="address">
            <div class="mb-3">
                <label for="address_street" class="form-label">Address Street</label>
                <input type="text" class="form-control" id="address_id" name="addresses[]">
            </div>
           
        </div>
        
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>