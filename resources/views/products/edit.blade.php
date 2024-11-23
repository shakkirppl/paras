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
              <h4 class="card-title">Edit Product</h4>
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
          <form class="form-sample" action="{{ route('products.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    
    <input type="hidden" class="form-control"  name="product_id" required value="{{$products->id}}" />
    <div class="row">
        <!-- Brand Dropdown -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">Brand</label>
                <div class="col-sm-9">
                    <select name="brand_id" id="brand_id" class="form-control" required>
                        <option value="" disabled>Select Brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" 
                                {{ old('brand_id', $products->brand_id) == $brand->id ? 'selected' : '' }}>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Category Dropdown -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">Category</label>
                <div class="col-sm-9">
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" disabled>Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- SubCategory Dropdown (loaded dynamically) -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">SubCategory</label>
                <div class="col-sm-9">
                    <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                        <option value="" disabled>Select SubCategory</option>
                        <!-- Options will be populated via JavaScript based on selected category -->
                        @foreach($subCategories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('subcategory_id', $products->sub_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>

        <!-- Product Name -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required"> Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Product Name" name="name" required value="{{ old('name', $products->name) }}" />
                </div>
            </div>
        </div>

        <!-- Product Model -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required"> Model</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Model" name="model"  value="{{ old('model', $products->model) }}" />
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">Description</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="description" name="description" required>{{ old('description', $products->description) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="col-md-12">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label required">Summary</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="summary" name="summary" >{{ old('summary', $products->summary) }}</textarea>
                </div>
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
