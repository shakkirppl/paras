@extends('layouts.layout')

@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <h4 class="card-title">Lucky Draw Gifts</h4>
            </div>
            <div class="col-md-6 text-right">
              <a href="{{ route('lucky_draw_giftes.create', $luckyDraw->id) }}" class="btn btn-primary">Add New Gift</a>
            </div>
          </div>
          
          <!-- Gifts Form -->
          <div class="container mb-5">
            <form action="{{ route('lucky_draw_giftes.store', $luckyDraw->id) }}" method="POST">
              @csrf

              <div class="row">

              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Gift Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}" />
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Short Description</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Short Description" name="short_description" value="{{ old('short_description') }}" />
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label required">Description</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Description" name="description" value="{{ old('description') }}" />
                  </div>
                </div>
              </div>

            </div>
           
            
              <button type="submit" class="btn btn-primary">Add Gift</button>
            </form>
          </div>

          <!-- Gifts Table -->
          <div class="container">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Short Description</th>
                    <th>Description</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($luckyDrawGiftes as $gift)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $gift->name }}</td>
                      <td>{{ $gift->short_description }}</td>
                      <td>{{ $gift->description }}</td>
                      <td>
                      <!-- <a href="{{ route('lucky_draw_giftes.edit', ['lucky_draw' => $luckyDraw->id, 'gift' => $gift->id]) }}" class="btn btn-sm btn-primary">Edit</a> -->

<form action="{{ route('lucky_draw_giftes.destroy', ['lucky_draw' => $luckyDraw->id, 'gift' => $gift->id]) }}" method="POST" style="display:inline-block;">
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
      </div>
    </div>

    <!-- Images Section -->
    <div class="col-12 grid-margin mt-4">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-6">
              <h4 class="card-title">Lucky Draw Images</h4>
            </div>
           
          </div>
          
          <!-- Images Form -->
          <div class="container mb-5">
            <form action="{{ route('lucky_draw_images.store', $luckyDraw->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
              </div>
              <button type="submit" class="btn btn-primary">Add Image</button>
            </form>
          </div>

          <!-- Images Table -->
          <div class="container">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($luckyDrawImages as $image)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>
                        <img src="{{ asset('storage/lucky_draw_images/' . $image->file_name) }}" alt="{{ $image->file_name }}" style="width: 100px; height: auto;">
                      </td>
                      <td>
                        <form action="{{ route('lucky-draw-images.destroy', ['lucky_draw' => $luckyDraw->id, 'image' => $image->id]) }}" method="POST" style="display:inline-block;">
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
      </div>
    </div>
  </div>
</div>
@endsection
