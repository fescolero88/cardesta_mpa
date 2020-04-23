<footer id="footer">

    <div id="footer-copyright" style="background-color:#153e4d">

        <div class="stm-listing-layout-footer">
            <div class="container">
                <div class="clearfix">

                    <div class="stm-footer-menu">
                        <ul class="stm-listing-footer-menu clearfix">
                            <li id="menu-item-2090" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2090">
                                <a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                            <li id="menu-item-2092" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2092">
                                <a href="{{route('aboutus')}}">About Us</a></li>
                            <li id="menu-item-2091" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2091">
                                <a href="{{route('contactus')}}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container footer-copyright">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="clearfix">
                        <div class="copyright-text">© @php echo date('Y'); @endphp <a href="{{route('home')}}">CarDesta</a>
                            <span class="divider"></span>Trademarks and brands are the property of their respective owners.</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="clearfix">
                        <div class="pull-right xs-pull-left">
                            <!-- Header top bar Socials -->
                            <div class="pull-right">
                                <div class="copyright-socials">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="https://www.facebook.com/cardestacorp/" target="_blank">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://twitter.com/CarDestaCorp" target="_blank">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/cardesta/" target="_blank">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="global-alerts"></div>				<!-- Searchform -->
    <div class="modal" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body heading_font">
                    <div class="search-title">Search</div>
                    <form method="get" id="searchform" action="">
                        <div class="search-wrapper">
                            <input placeholder="Start typing here..." type="text" class="form-control search-input" value="" name="s" id="s">
                            <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</footer>