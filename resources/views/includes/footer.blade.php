<script type="text/javascript">
var APP_URL = {!! json_encode(url('/')) !!};
</script>
<footer>
    <div class="footer-bottom black-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-md-0 mb-3">
                    <div class="copyright text-white ">
                        © {{ date('Y') }}
                        <a href="{{route('home')}}">
                            CarDesta
                        </a>
                            Trademarks and brands are the property of their respective owners.
                    </div>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/cardestacorp/" target="_blank">
                                <i aria-hidden="true" class="fa fa-facebook">
                                </i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/CarDestaCorp" target="_blank">
                                <i aria-hidden="true" class="fa fa-twitter">
                                </i>
                            </a>
                        </li>
                        
                        <li>
                            <a href="https://www.instagram.com/cardesta/" target="_blank">
                                <i aria-hidden="true" class="fa fa-instagram">
                                </i>
                            </a>
                        </li>
                       
                    </ul>
                </div>
                <div class="col-md-3">
                    <ul class="d-flex justify-content-md-end row">
                        <li>
                            <a href="{{route('privacypolicy')}}">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{route('aboutus')}}">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{route('contactus')}}">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>