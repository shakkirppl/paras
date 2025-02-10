@extends('layouts.layout')
@section('content')
<style>
  .required:after {
    content:" *";
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
                                 <h4 class="card-title">New Adds</h4>
                        </div>
                           <div class="col-md-6 heading">
                             <a href="{{ route('offer-adds.index') }}" class="backicon"><i class="mdi mdi-backburger"></i></a>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    
                    <div class="row">
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
          </div><br />
          @endif
          
        </div>
                  <form class="form-sample"  action="{{ route('offer-adds.store') }}" method="post" enctype="multipart/form-data"  >
                          {{csrf_field()}}
                    <div class="row">



                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Select Offer Type </label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg select2" id="offer_adds_type" name="offer_adds_type" required>
                     
                        <option value="Section_1">Section_1</option>
                        <option value="Section_2">Section_2</option>
                        <option value="Section_3">Section_3</option>
                        <option value="Section_4">Section_4</option>
                        <option value="Section_5">Section_5</option>
                       </select>
                          </div>
                        </div>
                      </div>


                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Category </label>
                          <div class="col-sm-9">
                        <select class="form-control form-control-lg" id="offer_categories_id" name="offer_categories_id" required="true">
                        <option >Select</option>
                        @foreach($category as $cat)
                      <option value="{{$cat->id}}">{{$cat->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required">Store </label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg select2" id="store_id" name="store_id" required>
                        <option >Select</option>
                        @foreach($store as $sto)
                      <option value="{{$sto->id}}">{{$sto->name}}</option>
                   @endforeach
                       </select>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label required"> Description</label>
                          <div class="col-sm-9">
                           <textarea class="form-control" name="description"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label"> Main Image</label>
                          <div class="col-sm-9">
                            <input type="file" class="form-control" name="image"    />
                            
                          </div>
                        </div>
                      </div> 
    
                      <div class="col-md-12">
                <div class="form-group row">
               <label class="col-sm-2 col-form-label">Additional Images</label>
               <div class="col-sm-9">
            <input type="file" class="form-control" name="additional_image[]" multiple />
                </div>
             </div>
          </div> 

             
          
     

                      </div>

                
                <div class="submitbutton">
                    <button type="submit" class="btn btn-primary mb-2 submit">Submit<i class="fas fa-save"></i>


</button>
                    </div>
                    
                    
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
            </div>
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
         
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load Select2 CSS -->

<!-- Load Select2 JS after jQuery -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 on all elements with the class 'select2'
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });
    });
</script>
@endsection