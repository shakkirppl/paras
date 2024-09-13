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
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('stores')}}"> Stores</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('lucky-draws')}}">Lucky Draws</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('sub-category')}}">Sub Category</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('brand')}}">Brand</a></li>
           
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('unit')}}">Unit</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('tax')}}">Tax</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('return-type')}}">Return Type</a></li>
         
                 <li class="nav-item"> <a class="nav-link" href="{{URL::to('expense-master')}}">Expense Master</a></li>
                 <li class="nav-item"> <a class="nav-link" href="{{URL::to('visit-reason')}}">Visit Reason</a></li>

                 <li class="nav-item"> <a class="nav-link" href="{{URL::to('process-pending-data')}}">Process</a></li>
                 
             
              </ul>
            </div>
            
     
          </li>

                    <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#transaction" aria-expanded="false" aria-controls="charts">
            <i class="mdi mdi-group menu-icon"></i> 
              <span class="menu-title">Transaction</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaction">
              <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pending-expense')}}"> Expense</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pending-return')}}"> Return</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('sales-change')}}"> Sales Change</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pending-offload-request')}}">Offload Request</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pending-dayclose-aprovel')}}">Day Close </a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('van-transfar-pending')}}">Van Transfar</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('payment-voucher')}}">Payment Voucher</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('sales-order-pending')}}">Sales Order</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('sales-schedule-pending')}}">Pending Schedule</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('pick-list-pending')}}">Pick List</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('picklist-report')}}">Pick List Report</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('delivery-loading-pending')}}"> Delivery Loading</a></li>
             

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
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('department')}}">Department</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('designation')}}">Designation</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('van')}}">Van</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('route-assign')}}">Route Assign</a></li>
              <li class="nav-item"> <a class="nav-link" href="{{URL::to('schedule')}}">Schedule</a></li>

             
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
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('vansale-report')}}">Sales</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('payment-collection-report')}}">Collection Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('van-salesorder-report')}}">Sales Order</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('van-salesreturn-report')}}">Sales Return</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('expense-report')}}">Expense Report</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('day-close-report')}}">Day Close</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('payment-voucher-report')}}">Payment Voucher</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('vanstock-request-report')}}">Van Stock  Request </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{URL::to('offload-request-report')}}">Offload  Request </a></li>
              </ul>
            </div>
     
          </li>
           

         
        </ul>
      </nav>