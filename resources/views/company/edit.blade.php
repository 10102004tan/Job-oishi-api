<x-layout>
    <h1>Edit Infomation Company</h1>
    <form action="{{ route('companies.update', $company->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="display_name" class="form-label">Company Name</label>
            <input type="text" class="form-control" id="display_name" name="display_name" value="{{ $company->display_name }}">
            @error('display_name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image_logo" class="form-label">Company Photo</label>
            <textarea class="form-control" id="image_logo" name="image_logo">{{ $company->image_logo }}</textarea>
            @error('image_logo')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $company->description }}">
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website" value="{{ $company->website }}">
            @error('website')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tagline" class="form-label">Tagline</label>
            <input type="text" class="form-control" id="tagline" name="tagline" value="{{ $company->tagline }}">
            @error('tagline')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_size" class="form-label">Company Size</label>
            <input type="text" class="form-control" id="company_size" name="company_size" value="{{ $company->company_size }}">
            @error('company_size')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="address_region_id" class="form-label">Address Region ID</label>
            <input type="text" class="form-control" id="address_region_id" name="address_region_id" value="{{ $company->address_region_id }}">
            @error('address_region_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="num_job_openings" class="form-label">Number Job Openings</label>
            <input type="text" class="form-control" id="num_job_openings" name="num_job_openings" value="{{ $company->num_job_openings }}">
            @error('num_job_openings')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <label class="form-label">Phúc lợi:</label>
        @foreach($benefits as $benefit)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{ $benefit->id }}" name="benefits[]" id="benefits_{{ $benefit->id }}" @if($company->benefits->contains($benefit->id)) checked @endif>
            <label class="form-check-label" for="benefits_{{ $benefit->id }}">
                {{ $benefit->value }}
            </label>
        </div>
        @endforeach

        <div class="mb-3">
            <label for="nationality_id" class="form-label">Nationallity ID</label>
            <input type="text" class="form-control" id="nationality_id" name="nationality_id" value="{{ $company->nationality_id }}">
            @error('nationality_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>