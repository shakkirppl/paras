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
              <a href="{{ route('stores.create') }}" class="btn btn-primary">Add New Store</a>
            </div>
          </div>
          @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
          <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
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
                    <a href="{{ route('stores.edit', $store->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('stores.destroy', $store->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
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
