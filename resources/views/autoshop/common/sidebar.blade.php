<ul class="list-group">
 
  <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/dashboard')}}">
           <i class="fas fa-user"></i>
         @lang('website.dashboard')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/profile')}}">
           <i class="fas fa-user"></i>
         @lang('website.Profile')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/wishlist')}}">
           <i class="fas fa-heart"></i>
        @lang('website.Wishlist')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/orders')}}">
           <i class="fas fa-shopping-cart"></i>
         @lang('website.Orders')
       </a>
   </li>
  
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/shipping-address')}}">
           <i class="fas fa-map-marker-alt"></i>
        @lang('website.Shipping Address')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/logout')}}">
           <i class="fas fa-power-off"></i>
         @lang('website.Logout')
       </a>
   </li>
   <br/>

   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/service-request/list')}}">
           <i class="fas fa-home"></i>
         @lang('website.Service Request')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/package-subscription/packages')}}">
           <i class="fas fa-user"></i>
         @lang('website.Package Subscription')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/transactions')}}">
           <i class="fas fa-heart"></i>
        @lang('labels.G2G Web Transaction')
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/vehicles/list')}}">
           <i class="fas fa-shopping-cart"></i>
         @lang('labels.My Vehicles')
       </a>
   </li>
    <li class="list-group-item">
       <a class="nav-link" href="{{ URL::to('/my-address')}}">
           <i class="fas fa-map-marker-alt"></i>
        @lang('website.My Address')
       </a>
   </li>
  <br/>
 </ul>