@extends('layouts.layout')

@section('content')
<style>
  .required:after {
    content: " *";
    color: red;
  }
</style>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin createtable">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Create New Store</h4>
            </div>
            <div class="col-md-6 heading">
              <a href="{{ route('stores.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
            </div>
          </div>

          <div class="row">
            <br>
          </div>

          <!-- Display validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form class="form-sample" action="{{ route('stores.store') }}" method="post">
            @csrf

            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" placeholder="Code" name="code" value="{{ old('code') }}" />
                    @error('code')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" />
                    @error('name')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label required">Store Type</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="store_types_id" required>
                      <option value="">Select Store Type</option>
                      @foreach($storeTypes as $type)
                        <option value="{{ $type->id }}" {{ old('store_types_id') == $type->id ? 'selected' : '' }}>
                          {{ $type->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label required">Store Classification</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="store_classifications_id" required>
                      <option value="">Select Store Classification</option>
                      @foreach($storeClassifications as $classification)
                        <option value="{{ $classification->id }}" {{ old('store_classifications_id') == $classification->id ? 'selected' : '' }}>
                          {{ $classification->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label required">District</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="district_id" required>
                      <option value="">Select District</option>
                      @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ old('district_id') == $district->id ? 'selected' : '' }}>
                          {{ $district->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Square Feet</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('square_feet') is-invalid @enderror" placeholder="Square Feet" name="square_feet" value="{{ old('square_feet') }}" />
                    @error('square_feet')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. of Staff</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control @error('no_of_staff') is-invalid @enderror" placeholder="No. of Staff" name="no_of_staff" value="{{ old('no_of_staff') }}" />
                    @error('no_of_staff')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Minimum Sales</label>
                  <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control @error('minimum_sales') is-invalid @enderror" placeholder="Minimum Sales" name="minimum_sales" value="{{ old('minimum_sales') }}" />
                    @error('minimum_sales')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Maximum Sales</label>
                  <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control @error('maximum_sales') is-invalid @enderror" placeholder="Maximum Sales" name="maximum_sales" value="{{ old('maximum_sales') }}" />
                    @error('maximum_sales')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Status</label>
                  <div class="col-sm-9">
                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                      <option value="" disabled selected>Select Status</option>
                      <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                      <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              
            </div>

            <div class="submitbutton">
              <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i></button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
@endsection
