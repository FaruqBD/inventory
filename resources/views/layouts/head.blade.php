<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="{{ url('/') }}"><img src = "{{ asset('logo.png') }}" height="70px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ url('products') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Products</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('products') }}"> All Products </a>
          <a class="dropdown-item" href="{{ url('products-import-export') }}"> Excel Import </a>
          <a class="dropdown-item" href="{{ url('file-export') }}"> All Products Export</a>
          <a class="dropdown-item" href="{{ route('create-packlist') }}">Create PickList </a>
          <a class="dropdown-item" href="{{ url('single-product-outward') }}">Single Product Outward </a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ url('shipments') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Shipments</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('shipments') }}">All Shipments</a>
          <a class="dropdown-item" href="{{ url('create-menifest') }}">Create Menifest</a>
          <a class="dropdown-item" href="{{ url('menifest') }}">Print Menifest</a>
          <a class="dropdown-item" href="{{ url('tracking-number-import') }}">Tracking Number Import</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ url('product-names') }}">Product Names </a>
          <a class="dropdown-item" href="{{ url('categories') }}">Categories </a>
          <a class="dropdown-item" href="{{ url('godowns') }}">Godowns </a>
          <a class="dropdown-item" href="{{ url('couriers') }}">Couriers </a>
          <a class="dropdown-item" href="{{ url('shipment-types') }}">Shipment Types </a>
        </div>
      </li>
     
    </ul>
    @if(Auth::user())
      <form method="POST" action="{{ route('logout') }}" class="form-inline my-2 my-lg-0">
      	@csrf
      <button class="btn btn-success my-2 my-sm-0" type="submit"><a onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="ti-power-off"></i> <span>Logout</span>
                                            </a></button>
    </form>
    @else
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><a href="{{ url('login') }}">Login</a></button>
    @endif
  </div>
</nav>

