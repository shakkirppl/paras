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
              <h4 class="card-title">Edit Store Classification</h4>
            </div>
            <div class="col-md-6 heading">
              <a href="{{ route('store-classifications.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
            </div>
          </div>

          <div class="row">
            <br>
          </div>

          <div class="col-xl-12 col-md-12 col-sm-12 col-12">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>

          <form class="form-sample" action="{{ route('store-classifications.update', $storeClassification->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Code" name="code" value="{{ old('code', $storeClassification->code) }}" />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name', $storeClassification->name) }}" />
                  </div>
                </div>
              </div>
<!-- 
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Square Feet</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Square Feet" name="square_feet" value="{{ old('square_feet', $storeClassification->square_feet) }}" />
                  </div>
                </div>
              </div> -->

              <!-- <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">No. of Staff</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="No. of Staff" name="no_of_staff" value="{{ old('no_of_staff', $storeClassification->no_of_staff) }}" />
                  </div>
                </div>
              </div> -->

              <!-- <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Minimum Sales</label>
                  <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" placeholder="Minimum Sales" name="minimum_sales" value="{{ old('minimum_sales', $storeClassification->minimum_sales) }}" />
                  </div>
                </div>
              </div> -->

              <!-- <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Maximum Sales</label>
                  <div class="col-sm-9">
                    <input type="number" step="0.01" class="form-control" placeholder="Maximum Sales" name="maximum_sales" value="{{ old('maximum_sales', $storeClassification->maximum_sales) }}" />
                  </div>
                </div>
              </div> -->
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Identity</label>
                  <div class="col-sm-9">
                    <input type="text"  class="form-control" placeholder="Identity" name="Identity" value="{{ old('Identity', $storeClassification->Identity) }}" />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Classic Option</label>
                  <div class="col-sm-9">
                    <input type="text"  class="form-control" placeholder="Classic Option" name="classic_option" value="{{ old('classic_option', $storeClassification->classic_option) }}" />
                  </div>
                </div>
              </div>

            </div>

            <div class="submitbutton">
              <button type="submit" class="btn btn-primary mb-2 submit">Update<i class="fas fa-save"></i></button>
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
