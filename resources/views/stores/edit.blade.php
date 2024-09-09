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
              <h4 class="card-title">Edit Store</h4>
            </div>
            <div class="col-md-6 heading">
              <a href="{{ route('stores.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
            </div>
          </div>
          <form class="form-sample" action="{{ route('stores.update', $store->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label required">Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="name" value="{{ old('name', $store->name) }}" required />
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
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
                        <option value="{{ $type->id }}" {{ old('store_types_id', $store->store_types_id) == $type->id ? 'selected' : '' }}>
                          {{ $type->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('store_types_id')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                        <option value="{{ $classification->id }}" {{ old('store_classifications_id', $store->store_classifications_id) == $classification->id ? 'selected' : '' }}>
                          {{ $classification->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('store_classifications_id')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                        <option value="{{ $district->id }}" {{ old('district_id', $store->district_id) == $district->id ? 'selected' : '' }}>
                          {{ $district->name }}
                        </option>
                      @endforeach
                    </select>
                    @error('district_id')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Logo</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control" name="logo" />
                    @if($store->logo)
                      <img src="{{ asset('storage/' . $store->logo) }}" alt="Store Logo" style="max-width: 100px; margin-top: 10px;" />
                    @endif
                    @error('logo')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" name="email" value="{{ old('email', $store->email) }}" />
                    @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Contact No</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="contact_no" value="{{ old('contact_no', $store->contact_no) }}" />
                    @error('contact_no')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">WhatsApp No</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="whatsapp_no" value="{{ old('whatsapp_no', $store->whatsapp_no) }}" />
                    @error('whatsapp_no')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="address">{{ old('address', $store->address) }}</textarea>
                    @error('address')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Town</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="town" value="{{ old('town', $store->town) }}" />
                    @error('town')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Landmark</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="landmark" value="{{ old('landmark', $store->landmark) }}" />
                    @error('landmark')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Star Rating</label>
                  <div class="col-sm-8">
                    <input type="number" step="0.1" class="form-control" name="star_rating" value="{{ old('star_rating', $store->star_rating) }}" />
                    @error('star_rating')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Latitude</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="latitude" value="{{ old('latitude', $store->latitude) }}" />
                    @error('latitude')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Longitude</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="longitude" value="{{ old('longitude', $store->longitude) }}" />
                    @error('longitude')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="submitbutton">
                <button type="submit" class="btn btn-primary mb-2">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
