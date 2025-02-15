@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Store Classifications</h4>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{ route('store-classifications.create') }}" class="btn btn-primary">Add New</a>
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
                      <th>Identity</th>
                      <th>Classic Option</th>
                      <!-- <th>Square Feet</th>
                      <th>No. of Staff</th>
                      <th>Min Sales</th>
                      <th>Max Sales</th> -->
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($storeClassifications as $classification)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $classification->code }}</td>
                        <td>{{ $classification->name }}</td>
                        <td>{{ $classification->Identity }}</td>
                        <td>{{ $classification->classic_option }}</td>
         
                        <td>
                          <a href="{{ route('store-classifications.edit', $classification->id) }}" class="btn btn-sm btn-primary">Edit</a>

                          <form action="{{ route('store-classifications.destroy', $classification->id) }}" method="POST" style="display:inline-block;">
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
              {{ $storeClassifications->links() }} <!-- Pagination Links -->
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
