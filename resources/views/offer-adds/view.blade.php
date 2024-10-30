@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Products List</h4>
                        </div>
                        <div class="col-6 text-end">
                            <!-- You can add other actions or buttons here -->
                        </div>
                    </div>

                    @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif

                    <input type="hidden" name="master_id" id="master_id" value="{{ $offerAdds->id }}" />

                    <!-- Category and Sub-category Dropdowns -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="category">Select Category</label>
                            <select id="category" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="subcategory">Select Sub-Category</label>
                            <select id="subcategory" class="form-control">
                                <option value="">-- Select Sub-Category --</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products List Table -->
                    <div class="table-responsive">
                        <table class="table table-hover" id="value-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($OfferAddsDetails))
    @foreach($OfferAddsDetails as $key => $detail)
        <tr id="{{ $detail->id }}">
            <td>{{ 1 + $key }}</td>
            <td class="name">
                {{ $detail->product->name ?? 'No Product Found' }}
            </td>
            <td>
                <a class="btn btn-warning btn-edit" href="{{ route('offer-adds.remove', $detail->id) }}">Remove</a>
            </td>
        </tr>
    @endforeach
@else
    <tr><td colspan="3">Sorry, No Records found!</td></tr>
@endif
                            </tbody>
                        </table>
                    </div>

                    <!-- Section to Show Products Based on Selection -->
                    <div id="products-container" class="mt-3">
                        <!-- Loaded dynamically based on category & sub-category -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        // $('#value-table').DataTable();

        // Load Sub-Categories based on Category
        $('#category').change(function () {
            var categoryId = $(this).val();
            $('#subcategory').html('<option value="">-- Select Sub-Category --</option>'); // Clear Sub-Category dropdown

            if (categoryId) {
                $.ajax({
                    url: "{{ route('getSubCategories') }}",
                    method: "GET",
                    data: { category_id: categoryId },
                    success: function (response) {
                        $.each(response.subcategories, function (key, subcategory) {
                            $('#subcategory').append(`<option value="${subcategory.id}">${subcategory.name}</option>`);
                        });
                    }
                });
            }
        });

        // Load Products based on Sub-Category
        $('#subcategory').change(function () {
            var subCategoryId = $(this).val();
            var master_id = $('input[name="master_id"]').val(); // Correctly get the value of 'master_id' input field
if (subCategoryId) {
    $.ajax({
        url: "{{ route('getProductsBySubCategory') }}",
        method: "GET",
        data: {
            sub_category_id: subCategoryId,
            master_id: master_id
        },
        success: function (response) {
            $('#products-container').html(response.html);
        }
    });
}
        });
    });
</script>
@endsection
