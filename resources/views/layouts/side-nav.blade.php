 <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <div class="logo"><a href="{{ url('dashboard') }}"><img src = "{{ asset('logo.png') }}" height="100px"></div>
            <ul>
                <li><a href="{{ url('products') }}"><i class="ti-home"></i> Dashboard</a></li>
                <li><a class="sidebar-sub-toggle"><i class="ti-layout"></i> Products <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                  <ul>
                    <li><a href="{{ url('products') }}"><i class="ti-view-list-alt"></i> All Products </a></li>
                    <li><a href="{{ url('products-import-export') }}"><i class="ti-import"></i> Excel Import </a></li>
                    <li><a href="{{ route('create-packlist') }}"><i class="ti-receipt"></i> Create PickList </a></li>
                  </ul>
                </li>
                <li><a class="sidebar-sub-toggle"><i class="ti-car"></i> Shipments <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                  <ul>
                    <li><a href="{{ url('shipments') }}"><i class="ti-car"></i> All Shipments </a></li>
                    <li><a href="{{ url('tracking-number-import') }}"><i class="ti-import"></i> Tracking Number Import </a></li>
                  </ul>
                </li>
                
                <li><a class="sidebar-sub-toggle"><i class="ti-settings"></i> Settings <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                  <ul>
                    
                    <li><a href="{{ url('product-names') }}"><i class="ti-view-list-alt"></i> Product Names </a></li>
                    <li><a href="{{ url('categories') }}"><i class="ti-view-list-alt"></i> Categories </a></li>
                    <li><a href="{{ url('godowns') }}"><i class="ti-view-list-alt"></i> Godowns </a></li>
                    <li><a href="{{ url('couriers') }}"><i class="ti-view-list-alt"></i> Couriers </a></li>
                    <li><a href="{{ url('shipment-types') }}"><i class="ti-view-list-alt"></i> Shipment Types </a></li>
                  </ul>



                </li>


                
            </ul>
        </div>
    </div>
</div>