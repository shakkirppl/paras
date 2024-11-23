@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Products</h4>
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
                <th>Name</th>
                <th>Code</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
            
                <td>{{ $product->name }}</td>
                <td>{{ $product->product_code }}</td>
                <td> @foreach($product->category as $cate) {{ $cate->name ?? 'N/A' }}  @endforeach</td>
                <td>@foreach($product->brand as $brn) {{ $brn->name ?? 'N/A' }}  @endforeach </td>
                <td>
                    <a href="{{ url('products.addon', $product->id) }}" class="btn btn-primary btn-sm">Addon</a>
                    <a href="{{ url('products.show', $product->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ url('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
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
