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
            <label for="company_image" class="form-label">Company Photo</label>
            <textarea class="form-control" id="company_image" name="company_image"></textarea>
            @error('company_image')
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
            <label for="number_job_opening" class="form-label">Number Job Openings</label>
            <input type="text" class="form-control" id="number_job_opening" name="number_job_opening">
            @error('number_job_opening')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="benifits_id" class="form-label">Benifits ID</label>
            <input type="text" class="form-control" id="benifits_id" name="benifits_id">
            @error('benifits_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="nationallity_id" class="form-label">Nationallity ID</label>
            <input type="text" class="form-control" id="nationallity_id" name="nationallity_id">
            @error('nationallity_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>