@extends('layouts.admin')

@section('title', 'Add New Car')

@section('actions')
<a href="{{ route('admin.cars') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left"></i> Back to List
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header bg-white">
        <h5 class="mb-0">Car Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="brand" class="form-label">Brand <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('brand') is-invalid @enderror" id="brand" name="brand" value="{{ old('brand') }}" required>
                    @error('brand')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
                    @error('model')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select Car Type</option>
                        <option value="sedan" {{ old('type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ old('type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="hatchback" {{ old('type') == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                        <option value="MPV" {{ old('type') == 'MPV' ? 'selected' : '' }}>MPV</option>
                        <option value="pickup" {{ old('type') == 'pickup' ? 'selected' : '' }}>Pickup</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="transmission" class="form-label">Transmission <span class="text-danger">*</span></label>
                    <select class="form-select @error('transmission') is-invalid @enderror" id="transmission" name="transmission" required>
                        <option value="">Select Transmission</option>
                        <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                        <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                    </select>
                    @error('transmission')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="color" class="form-label">Color</label>
                    <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color') }}">
                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', date('Y')) }}" min="1900" max="{{ date('Y') + 1 }}">
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="plate_number" class="form-label">Plate Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('plate_number') is-invalid @enderror" id="plate_number" name="plate_number" value="{{ old('plate_number') }}" required>
                    @error('plate_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4">
                    <label for="daily_rate" class="form-label">Daily Rate (RM) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('daily_rate') is-invalid @enderror" id="daily_rate" name="daily_rate" value="{{ old('daily_rate') }}" min="0" step="0.01" required>
                    @error('daily_rate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
                    <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id" required {{ isset($userBranchId) ? 'disabled' : '' }}>
                        <option value="">Select Branch</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" 
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}
                                {{ isset($userBranchId) && $userBranchId == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }} ({{ $branch->location }})
                            </option>
                        @endforeach
                    </select>
                    @if(isset($userBranchId))
                        <input type="hidden" name="branch_id" value="{{ $userBranchId }}">
                    @endif
                    @error('branch_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <label for="image" class="form-label">Car Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                    <div class="form-text">Recommended size: 800x600px. Max file size: 2MB.</div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('admin.cars') }}" class="btn btn-secondary me-md-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Add Car</button>
            </div>
        </form>
    </div>
</div>
@endsection