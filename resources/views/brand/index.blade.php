@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Brand</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('brand.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
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
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($brand))
                        @foreach($brand as $key=>$brand)
                        <tr id="{{$brand->id}}">
                            <td>{{1+$key}}</td>
                            <td class="name">{{$brand->name}}</td>
                            <td class="name"><img src="{{ url('uploads/brand/' . $brand->image) }}" alt="Image"></td>
                            <td>
                            @if($brand->status==0) <label class="btn btn-danger">Deative</label>@else<lable class="btn btn-success">Active</label> @endif</td>
                            <td><form action="{{ route('brand.destroy',$brand->id) }}" method="post">
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ route('brand.edit',$brand->id) }}"><i class="fa fa-edit"></i> </a>
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
