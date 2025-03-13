@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Stores</h4>
            </div>
            <div class="col-md-6 text-right">
             
            </div>
          </div>
        
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Store Type</th>
                  <th>Store Classification</th>
                  <th>District</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($stores as $store)
                <tr>
                  <td>{{ $store->code }}</td>
                  <td>{{ $store->name }}</td>
                  <td>{{ $store->storeType->name ?? 'N/A' }}</td>
                  <td>{{ $store->storeClassification->name ?? 'N/A' }}</td>
                  <td>{{ $store->district->name ?? 'N/A' }}</td>
                  <td>{{ ucfirst($store->status) }}</td>
                  <td>
                    <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="{{ route('stores.view', $store->id) }}" class="btn btn-sm btn-primary">View</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
