@extends('layouts.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                    
                     <div class="row">
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12" >
                             <h4 class="card-title">Offer Adds</h4>
                    </div>
                    <div class="col-6 col-md-6 col-sm-6 col-xs-12  heading" style="text-align:end;">
                    <a href="{{ route('offer-adds.create') }}" class="newicon"><i class="mdi mdi-new-box"></i></a>
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
                          <th>Category</th>
                          <th>Store</th>
                          <th>Section</th>
                          <th>Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @if(count($offerAdds))
                        @foreach($offerAdds as $key=>$offer)
                        <tr id="{{$offer->id}}">
                            <td>{{1+$key}}</td>
                            <td class="name"> @foreach($offer->category as $key=>$cate){{$cate->name}} @endforeach</td>
                            <td class="name"> @foreach($offer->store as $key=>$sto){{$sto->name}} @endforeach</td>
                            <td class="name"> {{$offer->offer_adds_type}}</td>
                            <td class="name"><img src="{{ url('uploads/offer-adds/' . $offer->image) }}" alt="Image"></td>
                            <td>
                            <td>
                            <a class="btn btn-minier btn-warning btn-edit" href="{{ route('offer-adds.view',$offer->id) }}">View </a>
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
