@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Products Sku</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('products.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
                    </div>
                       
                   
                </div>
                    
@if($message = Session::get('success'))
<div class="alert alert-sucess">
  <p>{{$message}}</p>
</div>
@endif
 
                 
                  <p class="card-description">
                
                  </p>
                  <div class="table-responsive">
              
                    <table class="table table-hover"id="value-table">
        <thead>
            <tr>
                <th>Size</th>
                <th>Color</th>
                <th>Sku</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productSku as $product)
            <tr>
            <td>{{ optional($product->size)->value }}</td>
            <td>{{ optional($product->color)->value }}</td>
            <td>{{ $product->sku }}</td>
            <td class="name"><img src="{{ url('uploads/products/' . $product->image) }}" alt="Image"></td>
        
           
                <td>
                <form action="{{ route('product-sku.destroy', $product->id) }}" method="post">
                <a href="{{ url('products.image', $product->id) }}" class="btn btn-primary btn-sm">Change Image</a>
                @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash"></i>
    </button>
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
@section('script')
<script>
    $(document).ready( function () {
    $('#value-table').DataTable();
} );
</script>
@endsection
