<ul class="list-group">
 
  <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/dashboard')); ?>">
           <i class="fas fa-user"></i>
         <?php echo app('translator')->get('website.dashboard'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/profile')); ?>">
           <i class="fas fa-user"></i>
         <?php echo app('translator')->get('website.Profile'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/wishlist')); ?>">
           <i class="fas fa-heart"></i>
        <?php echo app('translator')->get('website.Wishlist'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/orders')); ?>">
           <i class="fas fa-shopping-cart"></i>
         <?php echo app('translator')->get('website.Orders'); ?>
       </a>
   </li>
  
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/shipping-address')); ?>">
           <i class="fas fa-map-marker-alt"></i>
        <?php echo app('translator')->get('website.Shipping Address'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/logout')); ?>">
           <i class="fas fa-power-off"></i>
         <?php echo app('translator')->get('website.Logout'); ?>
       </a>
   </li>
   <br/>

   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/service-request/list')); ?>">
           <i class="fas fa-home"></i>
         <?php echo app('translator')->get('website.Service Request'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/package-subscription/packages')); ?>">
           <i class="fas fa-user"></i>
         <?php echo app('translator')->get('website.Package Subscription'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/transactions')); ?>">
           <i class="fas fa-heart"></i>
        <?php echo app('translator')->get('labels.G2G Web Transaction'); ?>
       </a>
   </li>
   <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/vehicles/list')); ?>">
           <i class="fas fa-shopping-cart"></i>
         <?php echo app('translator')->get('labels.My Vehicles'); ?>
       </a>
   </li>
    <li class="list-group-item">
       <a class="nav-link" href="<?php echo e(URL::to('/my-address')); ?>">
           <i class="fas fa-map-marker-alt"></i>
        <?php echo app('translator')->get('website.My Address'); ?>
       </a>
   </li>
  <br/>
 </ul><?php /**PATH D:\xampp74\htdocs\g2g\resources\views/autoshop/common/sidebar.blade.php ENDPATH**/ ?>