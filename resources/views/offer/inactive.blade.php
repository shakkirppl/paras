@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">In Active Offer</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                 
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
                          <th>Code</th>
                          <th>Title</th>
                          <th>Store</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($offer))
                        @foreach($offer as $key=>$offe)
                        <tr id="{{$offe->id}}">
                            <td>{{1+$key}}</td>
                            <td class="name"> {{$offe->code}} </td>
                            <td class="name"> {{$offe->title}} </td>
                            <td class="name">    {{ optional($offe->adstore)->name }}</td>
                            <td class="name"> {{$offe->start_date}} </td>
                            <td class="name"> {{$offe->end_date}} </td>
                            <td class="name"><img src="{{ url('uploads/offer/' . $offe->image) }}" alt="Image"></td>
                           
                            <td>
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ url('offer-to_active',$offe->id) }}">To Active </a>
                            <a class="btn btn-minier btn-danger btn-edit" href="{{ url('offer-to_delete',$offe->id) }}">Delete </a>
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
