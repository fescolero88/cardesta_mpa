<div class="mh-head">
        <span class="mh-btns-left">
          <a href="#menu" class="fa fa-bars"></a>
        </span>
    
      <nav id="menu">
        <ul id="panel-menu">
<!--          <li class="menu-divider"><a href="#">Shop</a></li>
          <li><a href="#"><span class="navTitle">Used Cars</span>
          <p class="navDetail">Find the best deals near you</p></a></li>
-->
          <li><a href="{{ route('list') }}"><span class="navTitle">Inventory</span>
          <p class="navDetail">Find the best deals near you</p></a></li>
          <li><a href="{{route('dealerlist')}}"><span class="navTitle">Dealers</span>
          <p class="navDetail">Search dealers near you</p></a></li>

<!--          <li class="menu-divider"><a href="#">Settings</a></li>-->
<!--          <li><a href="signup.html"><span class="navTitle">Sign Up</span>-->
          <li><a href="{{route('contactus')}}"><span class="navTitle">Contact Us</span>
          <li><a href="{{route('aboutus')}}"><span class="navTitle">About Us</span>
          <li><a href="{{route('privacypolicy')}}"><span class="navTitle">Privacy Policy</span>
<!--          <li><a href="{{route('home')}}"><span class="navTitle">View Full site</span>  -->
        </ul>
        
      </nav>

</div>