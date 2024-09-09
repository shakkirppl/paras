@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Store Types</h4>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{ route('store-type.create') }}" class="btn btn-primary">Add New</a>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($storeTypes as $storeType)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $storeType->code }}</td>
                        <td>{{ $storeType->name }}</td>
                        <td>
                          <a href="{{ route('store-type.edit', $storeType->id) }}" class="btn btn-sm btn-primary">Edit</a>

                          <form action="{{ route('store-type.destroy', $storeType->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12">
              {{ $storeTypes->links() }} <!-- Pagination Links -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
@endsection
