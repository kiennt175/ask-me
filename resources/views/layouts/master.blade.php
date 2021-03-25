<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ask me</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- Favicons -->
	<link rel="shortcut icon" href="{{ asset('bower_components/askme-style/images/favicon.png') }}">

    @section('style')
        <!-- Main Style -->
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/style.css') }}">
        <!-- Skins -->
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/skins/blue.css') }}">
        <!-- Responsive Style -->
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/responsive.css') }}">
    @show	

</head>
<body>
    <div class="loader">
        <div class="loader_html"></div>
    </div>
    <div id="wrap" class="grid_1200">
        {{-- <div class="login-panel">
            <section class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="page-content">
                            <h2>Login</h2>
                            <div class="form-style form-style-3">
                                <form>
                                    <div class="form-inputs clearfix">
                                        <p class="login-text">
                                            <input type="text" value="Username" onfocus="if (this.value == 'Username') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Username';}">
                                            <i class="icon-user"></i>
                                        </p>
                                        <p class="login-password">
                                            <input type="password" value="Password" onfocus="if (this.value == 'Password') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Password';}">
                                            <i class="icon-lock"></i>
                                            <a href="#">Forget</a>
                                        </p>
                                    </div>
                                    <p class="form-submit login-submit">
                                        <input type="submit" value="Log in" class="button color small login-submit submit">
                                    </p>
                                    <div class="rememberme">
                                        <label><input type="checkbox" checked="checked"> Remember Me</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="page-content Register">
                            <h2>Register Now</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi adipiscing gravdio, sit amet suscipit risus ultrices eu. Fusce viverra neque at purus laoreet consequa. Vivamus vulputate posuere nisl quis consequat.</p>
                            <a class="button color small signup">Create an account</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="panel-pop" id="signup">
            <h2>Register Now<i class="icon-remove"></i></h2>
            <div class="form-style form-style-3">
                <form>
                    <div class="form-inputs clearfix">
                        <p>
                            <label class="required">Username<span>*</span></label>
                            <input type="text">
                        </p>
                        <p>
                            <label class="required">E-Mail<span>*</span></label>
                            <input type="email">
                        </p>
                        <p>
                            <label class="required">Password<span>*</span></label>
                            <input type="password" value="">
                        </p>
                        <p>
                            <label class="required">Confirm Password<span>*</span></label>
                            <input type="password" value="">
                        </p>
                    </div>
                    <p class="form-submit">
                        <input type="submit" value="Signup" class="button color small submit">
                    </p>
                </form>
            </div>
        </div>
        <div class="panel-pop" id="lost-password">
            <h2>Lost Password<i class="icon-remove"></i></h2>
            <div class="form-style form-style-3">
                <p>Lost your password? Please enter your username and email address. You will receive a link to create a new password via email.</p>
                <form>
                    <div class="form-inputs clearfix">
                        <p>
                            <label class="required">Username<span>*</span></label>
                            <input type="text">
                        </p>
                        <p>
                            <label class="required">E-Mail<span>*</span></label>
                            <input type="email">
                        </p>
                    </div>
                    <p class="form-submit">
                        <input type="submit" value="Reset" class="button color small submit">
                    </p>
                </form>
                <div class="clearfix"></div>
            </div>
        </div> --}}
        {{-- <div id="header-top">
            <section class="container clearfix">
                <nav class="header-top-nav">
                    <ul>
                        <li><a href="contact_us.html"><i class="icon-envelope"></i>Contact</a></li>
                        <li><a href="#"><i class="icon-headphones"></i>Support</a></li>
                        @guest
                            <li><a href="{{ route('login') }}" id=""><i class="icon-user"></i>Login Area</a></li>
                        @else
                            <li><a href="{{ route('login') }}" id=""><i class="icon-user"></i><b>{{ Auth::user()->name }}</b></a></li>
                        @endguest
                    </ul>
                </nav>
                <div class="header-search">
                    <form >
                        <input type="text" value="Search here ..." onfocus="if(this.value=='Search here ...')this.value='';" onblur="if(this.value=='')this.value='Search here ...';">
                        <button type="submit" class="search-submit"></button>
                    </form>
                </div>
            </section>
        </div> --}}
        <header id="header">
            <section class="container clearfix">
                <div class="logo"><a href="index.html"><img alt="" src="{{ asset('bower_components/askme-style/images/logo.png') }}"></a></div>
                <nav class="navigation">
                    <ul>
                        <li class="current_page_item"><a href="index.html">Home</a>
                            <ul>
                                <li class="current_page_item"><a href="index.html">Home</a></li>
                                <li><a href="index_2.html">Home 2</a></li>
                                <li><a href="index_boxed_1.html">Home Boxed 1</a></li>
                                <li><a href="index_boxed_2.html">Home Boxed 2</a></li>
                                <li><a href="index_no_box.html">Home No Box</a></li>
                            </ul>
                        </li>
                        <li class="ask_question"><a href="ask_question.html">Ask Question</a></li>
                        <li><a href="cat_question.html">Questions</a>
                            <ul>
                                <li><a href="cat_question.html">Questions Category</a></li>
                                <li><a href="single_question.html">Question Single</a></li>
                                <li><a href="single_question_poll.html">Poll Question Single</a></li>
                            </ul>
                        </li>
                        <li><a href="user_profile.html">User</a>
                            <ul>
                                <li><a href="user_profile.html">User Profile</a></li>
                                <li><a href="user_questions.html">User Questions</a></li>
                                <li><a href="user_answers.html">User Answers</a></li>
                                <li><a href="user_favorite_questions.html">User Favorite Questions</a></li>
                                <li><a href="user_points.html">User Points</a></li>
                                <li><a href="edit_profile.html">Edit Profile</a></li>
                            </ul>
                        </li>
                        <li><a href="blog_1.html">Blog</a>
                            <ul>
                                <li><a href="blog_1.html">Blog 1</a>
                                    <ul>
                                        <li><a href="blog_1.html">Right sidebar</a></li>
                                        <li><a href="blog_1_l_sidebar.html">Left sidebar</a></li>
                                        <li><a href="blog_1_full_width.html">Full Width</a></li>
                                    </ul>
                                </li>
                                <li><a href="blog_2.html">Blog 2</a>
                                    <ul>
                                        <li><a href="blog_2.html">Right sidebar</a></li>
                                        <li><a href="blog_2_l_sidebar.html">Left sidebar</a></li>
                                        <li><a href="blog_2_full_width.html">Full Width</a></li>
                                    </ul>
                                </li>
                                <li><a href="single_post.html">Post Single</a>
                                    <ul>
                                        <li><a href="single_post.html">Right sidebar</a></li>
                                        <li><a href="single_post_l_sidebar.html">Left sidebar</a></li>
                                        <li><a href="single_post_full_width.html">Full Width</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            @guest
                                <a href="{{ route('login') }}">Log In</a>
                            @else
                                <a href="right_sidebar.html">{{ Auth::user()->name }}</a>
                                <ul>
                                    <li><a href="login.html">My Profile</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            @endguest
                        </li>
                        <li><a href="shortcodes.html">Shortcodes</a></li>
                        <li><a href="contact_us.html">Contact Us</a></li>
                    </ul>
                </nav>
            </section><!-- End container -->
        </header><!-- End header -->

        @yield('content')
        
        <footer id="footer-bottom">
            <section class="container">
                <div class="copyrights f_left">&copy; 2021 Ask me</div>
                <div class="social_icons f_right">
                    <ul>
                        <li class="twitter"><a original-title="Twitter" class="tooltip-n" href="#"><i class="social_icon-twitter font17"></i></a></li>
                        <li class="facebook"><a original-title="Facebook" class="tooltip-n" href="#"><i class="social_icon-facebook font17"></i></a></li>
                        <li class="gplus"><a original-title="Google plus" class="tooltip-n" href="#"><i class="social_icon-gplus font17"></i></a></li>
                        <li class="youtube"><a original-title="Youtube" class="tooltip-n" href="#"><i class="social_icon-youtube font17"></i></a></li>
                        <li class="skype"><a original-title="Skype" class="tooltip-n" href="skype:#?call"><i class="social_icon-skype font17"></i></a></li>
                        <li class="flickr"><a original-title="Flickr" class="tooltip-n" href="#"><i class="social_icon-flickr font17"></i></a></li>
                        <li class="rss"><a original-title="Rss" class="tooltip-n" href="#"><i class="social_icon-rss font17"></i></a></li>
                    </ul>
                </div><!-- End social_icons -->
            </section><!-- End container -->
        </footer><!-- End footer-bottom -->
    </div><!-- End wrap -->
    <div class="go-up">
        <i class="icon-chevron-up"></i>
    </div>

    @section('scripts')
        <script src="{{ asset('bower_components/askme-style/js/jquery.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery-ui-1.10.3.custom.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.easing.1.3.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/html5.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/twitter/jquery.tweet.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jflickrfeed.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.inview.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.tipsy.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/tabs.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.flexslider.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.carouFredSel-6.2.1-packed.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.scrollTo.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.nav.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/tags.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/jquery.bxslider.min.js') }}"></script>
        <script src="{{ asset('bower_components/askme-style/js/custom.js') }}"></script>
    @show
    
</body>
</html>
