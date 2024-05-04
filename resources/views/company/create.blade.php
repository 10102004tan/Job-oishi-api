<x-layout>
    <h1>Create Infomation Company</h1>
    <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name">
            @error('company_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_photo" class="form-label">Company Photo</label>
            <textarea class="form-control" id="company_photo" name="company_photo"></textarea>
            @error('company_photo')
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
            <label for="address_region_id" class="form-label">Address Region ID</label>
            <input type="text" class="form-control" id="address_region_id" name="address_region_id">
            @error('address_region_id')
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

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>