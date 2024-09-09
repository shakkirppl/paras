@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <h4 class="card-title">Lucky Draws</h4>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{ route('lucky-draws.create') }}" class="btn btn-primary">Add New</a>
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
                      <th>Draw Date</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($luckyDraws as $draw)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $draw->code }}</td>
                        <td>{{ $draw->name }}</td>
                        <td>{{ $draw->draw_date }}</td>
                        <td>
                          <a href="{{ route('lucky-draws.edit', $draw->id) }}" class="btn btn-sm btn-primary">Edit</a>

                          <form action="{{ route('lucky-draws.destroy', $draw->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                          </form>
                                   <!-- Manage Gifts -->
                                   <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Manage Gifts
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('lucky_draw_giftes.create', $draw->id) }}">Add Gift</a>
                              <a class="dropdown-item" href="{{ route('lucky_draw_giftes.edit', [$draw->id, $draw->id]) }}">Edit Gift</a>
                              <form action="{{ route('lucky_draw_giftes.destroy', [$draw->id, $draw->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure?')">Delete Gift</button>
                              </form>
                            </div>
                          </div>
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
              {{ $luckyDraws->links() }} <!-- Pagination Links -->
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
