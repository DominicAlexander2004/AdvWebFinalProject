@extends('layouts.admin')

@section('title', 'Add New Staff')

@section('actions')
<a href="{{ route('admin.staff') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Back to List
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">New Staff Account</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.staff.store') }}" method="POST">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    <div class="form-text">Password must be at least 8 characters long.</div>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="staff" {{ old('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="branch_id" class="form-label">Branch Assignment</label>
                    <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id">
                        <option value="">Not Assigned to Any Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} ({{ $branch->location }})
                            </option>
                        @endforeach
                    </select>
                    <div class="form-text">Staff will only be able to manage cars and bookings from their assigned branch.</div>
                    @error('branch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('admin.staff') }}" class="btn btn-secondary me-md-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create Staff Account</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('role');
    const branchSelect = document.getElementById('branch_id');
    const branchField = branchSelect.closest('.col-md-6');
    
    // Function to toggle branch field visibility based on role
    function toggleBranchField() {
        if (roleSelect.value === 'admin') {
            branchField.style.opacity = '0.5';
            branchSelect.value = '';
        } else {
            branchField.style.opacity = '1';
        }
    }
    
    // Initial check
    toggleBranchField();
    
    // Add event listener for role changes
    roleSelect.addEventListener('change', toggleBranchField);
});
</script>
@endsection