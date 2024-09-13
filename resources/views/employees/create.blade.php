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
              <h4 class="card-title">New Employees</h4>
            </div>
            <div class="col-md-6 heading">
              <a href="{{ route('employees.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
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

          <form class="form-sample" action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Code" name="code" value="{{ old('code') }}" />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" />
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">User Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="User Name" name="username" value="{{ old('username') }}" />
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Password</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" />
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label required">Districts</label>
                  <div class="col-sm-8">
                    <select class="form-control" name="districts_id" required>
                      <option value="">Select District</option>
                      @foreach($districts as $dist)
                        <option value="{{ $dist->id }}" {{ old('districts_id') == $dist->id ? 'selected' : '' }}>
                          {{ $dist->name }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>

            <div class="submitbutton">
              <button type="submit" class="btn btn-primary mb-2 submit">Submit <i class="fas fa-save"></i></button>
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
