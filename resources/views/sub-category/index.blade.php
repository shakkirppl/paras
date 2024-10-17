@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Sub Category</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('sub-category.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
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
                    <table class="table table-hover" id="value-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($subCategory))
                        @foreach($subCategory as $key=>$subCategory)
                        <tr id="{{$subCategory->id}}">
                            <td>{{1+$key}}</td>
                            <td class="name">{{$subCategory->name}}</td>
                            <td class="name"><img src="{{ url('uploads/subcategory/' . $subCategory->image) }}" alt="Image"></td>
                            <td class="name">@foreach($subCategory->category as $category){{$category->name}} @endforeach</td>
                            <td>
                            @if($subCategory->status==0) <label class="btn btn-danger">Deative</label>@else<lable class="btn btn-success">Active</label> @endif</td>
                            <td><form action="{{ route('sub-category.destroy',$subCategory->id) }}" method="post">
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ route('sub-category.edit',$subCategory->id) }}"><i class="fa fa-edit"></i> </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                              </form>
                            </td>
                      </tr>
                        @endforeach
                        @else
                        <tr><td colspan="2">Sorry, No Records found!</td></tr>
                        @endif
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
