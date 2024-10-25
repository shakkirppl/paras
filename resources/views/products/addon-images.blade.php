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
              <h4 class="card-title">Image List</h4>
            </div>
          </div>

          <div class="row">
          <div class="col-md-6 heading">
                             <a href="{{ url('products') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
                        </div>
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

          <form class="form-sample" action="{{ route('products-image.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
            <input type="hidden" class="form-control" placeholder="Product Id" name="product_id"  required="true"  value="{{$productSku->id}}" />
            <div class="col-md-12">
    <div class="form-group row">
        <label class="col-sm-2 col-form-label ">Main Image</label>
        <div class="col-sm-9">
       
        <img src="{{ url('uploads/products/' . $productSku->image) }}" alt="Image">
        </div>
    </div>
</div>
<div class="col-md-12">
<div class="form-group row">
        <label class="col-sm-2 col-form-label ">Addition Images</label>
        <div class="col-sm-9">
       
        </div>
    </div>
</div>
@foreach($productImage as $productSku)
<div class="col-md-12">
<div class="form-group row">
<a href="{{ url('delete.image', $productSku->id) }}" class="col-sm-2 col-form-label">Delete</a>
        <label class="col-sm-2 col-form-label "></label>
        <div class="col-sm-9">
        <img src="{{ url('uploads/products/' . $productSku->image) }}" alt="Image">
        </div>
    </div>
</div>
</div>
<hr>
@endforeach
<div class="col-md-12">
    <hr> <!-- Horizontal line to visually separate sections -->
    <h5 class="mb-4">Add Image</h5> <!-- Section Heading with margin bottom -->
  </div>




                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label "> Main Image</label>
                          <div class="col-sm-9">
                          <input type="file" name="single_image" class="form-control-file" required>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label "> Additional Images</label>
                          <div class="col-sm-9">
                          <input type="file" name="multiple_images[]" class="form-control-file" multiple>
                          </div>
                        </div>
                      </div>

                      <div class="submitbutton">
              <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i></button>
            </div>

          </form>

</div>


        
        
        </div>
           
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
  // Load SubCategories when a Category is selected
  $('#category_id').on('change', function() {
    var categoryId = $(this).val();

    $.ajax({
      url: "{{ route('categories.getSubCategories') }}",
      type: 'GET',
      data: { category_id: categoryId },
      success: function(response) {
        $('#subcategory_id').empty();
        $('#subcategory_id').append('<option value="" disabled selected>Select SubCategory</option>');

        $.each(response.subcategories, function(key, subcategory) {
          $('#subcategory_id').append('<option value="' + subcategory.id + '">' + subcategory.name + '</option>');
        });
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#description').summernote({
      height: 150 // Set the height of the editor
    });
    $('#summary').summernote({
      height: 150 // Set the height of the editor
    });
  });
</script>
@endsection
