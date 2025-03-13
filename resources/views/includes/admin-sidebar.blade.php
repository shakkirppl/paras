<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{URL::to('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#masters" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Masters </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="masters">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('store-type')}}"> Store Type</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('store-classifications')}}"> Store Classification</a></li>
              <!-- <li class="nav-item"> <a class="nav-link" href="{{URL::to('stores')}}"> Stores</a></li> -->
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('lucky-draws')}}">Lucky Draws</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('category')}}">Category</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('sub-category')}}">Sub Category</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('brand')}}">Brand</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('product-attributes')}}">Product Attributes</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('city')}}">City</a></li>
              </ul>
            </div>
            
     
          </li>

                    <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#products" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Products</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('products/create')}}"> Create</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('products')}}"> List</a></li>

             

              </ul>
            </div>
            
     
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#offer" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Offer </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="offer">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('offer-adds')}}"> Offer Adds</a></li>


             
              </ul>
            </div>
            
     
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">User </span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="user">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('employees')}}"> Employees</a></li>   
              </ul>
            </div>
            
     
          </li>



          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collection_report" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Store</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collection_report">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pending-store')}}"> Pending Store</a></li>  
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('rejected-store')}}"> Rejected Store</a></li>  
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('completed-store')}}"> Completed Store</a></li>  
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('in-progress-store')}}"> In Process Store</a></li>    
              </ul>
            </div>
     
          </li>
    

                 
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#collection_report" aria-expanded="false" aria-controls="charts">
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Report</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="collection_report">
              <ul class="nav flex-column sub-menu">

              </ul>
            </div>
     
          </li>
           

         
        </ul>
      </nav>