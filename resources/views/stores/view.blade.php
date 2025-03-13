@extends('layouts.layout')

@section('content')
<style>
  .status-active {
    color: green;
    font-weight: bold;
}
.status-inactive {
    color: red;
    font-weight: bold;
}
.status-pending {
    color: orange;
    font-weight: bold;
}
  </style>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Store View</h4>
            </div>
            <div class="col-md-6 text-right">
             
            </div>
          </div>
        
          <div class="table-responsive">
          <table class="table">
              <thead>
                <tr>
                  <th>Store Status :<lable class="fw-bold text-{{ $store->status == 'active' ? 'success' : ($store->status == 'inactive' ? 'danger' : 'warning') }}">
                  {{ ucfirst($store->status) }}</lable></th>
               
                 
                  <th>Register Status:<lable class="fw-bold text-{{ $store->register_status == 'complete' ? 'success' : ($store->register_status == 'pending' ? 'danger' : 'warning') }}">
                  {{ ucfirst($store->register_status) }} </lable></th>
               
                 
                  <thead>
</table>
            <table class="table">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Store Type</th>
                  <th>Store Classification</th>
                  <th>District</th>
                 
                 
                </tr>
              </thead>
              <tbody>
             

                <tr>
                  <td>{{ $store->code }}</td>
                  <td>{{ $store->name }}</td>
                  <td>{{ $store->storeType->name ?? 'N/A' }}</td>
                  <td>{{ $store->storeClassification->name ?? 'N/A' }}</td>
                  <td>{{ $store->district->name ?? 'N/A' }}</td>

                </tr>
              
              </tbody>
            </table>
            <div class="container">
    <h3>Update Store Details</h3>
    
    <!-- Update Register Status Form -->
    <form action="{{ route('store.updateRegisterStatus') }}" method="POST">
        @csrf
        <input type="hidden" name="store_id" value="{{ $store->id }}">

        <table class="table">
            <thead>
                <tr>
                    <th>Update Register Status :</th>
                    <th>
                        <select class="form-control" name="register_status" required>
                            <option value="pending" {{ $store->register_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="rejected" {{ $store->register_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="complete" {{ $store->register_status == 'complete' ? 'selected' : '' }}>Complete</option>
                            <option value="in_process" {{ $store->register_status == 'in_process' ? 'selected' : '' }}>In Process</option>
                        </select>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-primary">Update Register Status</button>
                    </th>
                </tr>
            </thead>
        </table>
    </form>

    <!-- Update Store Status Form -->
    <form action="{{ route('store.updateStatus') }}" method="POST">
        @csrf
        <input type="hidden" name="store_id" value="{{ $store->id }}">

        <table class="table">
            <thead>
                <tr>
                    <th>Update Store Status :</th>
                    <th>
                        <select class="form-control" name="status" required>
                            <option value="active" {{ $store->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $store->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-success">Update Store Status</button>
                    </th>
                </tr>
            </thead>
        </table>
    </form>
</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
