<x-layout>
    <h1>Edit Infomation Job</h1>
    <form action="{{ route('jobs.update', $job->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Job title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $job->title }}">
            @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Job content</label>
            <textarea class="form-control" id="content" name="content">{{ $job->content }}</textarea>
            @error('content')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            Danh sách công ty hiện có:
            @foreach($companies as $company)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="company_id" id="company_{{ $company->id }}" value="{{ $company->id }}" {{ $job->company_id == $company->id ? 'checked' : '' }}>
                <label class="form-check-label" for="company_{{ $company->id }}">
                    {{ $company->company_name }}
                </label>
            </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label for="experience" class="form-label">Job Experience</label>
            <input type="text" class="form-control" id="experience" name="experience" value="{{ $job->experience }}">
            @error('experience')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="job_type_str" class="form-label">Job Type</label>
            <input type="text" class="form-control" id="job_type_str" name="job_type_str" value="{{ $job->job_type_str }}">
            @error('job_type_str')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-check d-flex">
            <div class="col-4">
                <label for="is_edit" class="form-check-label">Is Edit</label>
                <input type="hidden" name="is_edit" value="{{ $job->is_edit }}">
                <input type="checkbox" class="form-check-input" id="is_edit" name="is_edit" value="{{ $job->is_edit }}" {{ $job->is_edit == 1 ? 'checked' : '' }}>
            </div>
            <div class="col-4">
                <label for="is_salary_value" class="form-check-label">Is Salary Value</label>
                <input type="hidden" name="is_salary_value" value="{{ $job->is_salary_value }}">
                <input type="checkbox" class="form-check-input" id="is_salary_value" name="is_salary_value" value="{{ $job->is_salary_value }}" {{ $job->is_salary_value == 1 ? 'checked' : '' }}>
            </div>
            <div class="col-4">
                <label for="is_applied" class="form-check-label">Is Applied</label>
                <input type="hidden" name="is_applied" value="0">
                <input type="checkbox" class="form-check-input" id="is_applied" name="{{ $job->is_applied }}" value="{{ $job->is_applied }}" {{ $job->is_applied == 1 ? 'checked' : '' }}>
            </div>
        </div>


        <div class="mb-3">
            <label for="job_level" class="form-label">Job Level</label>
            <input type="text" class="form-control" id="job_level" name="job_level" value="{{ $job->job_level }}">
            @error('job_level')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-layout>