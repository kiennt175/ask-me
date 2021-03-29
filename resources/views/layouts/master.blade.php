<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASK me</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('bower_components/askme-style/images/favicon.png') }}">
    
    @section('style')
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/skins/blue.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @show	

</head>
<body>
    <div class="loader">
        <div class="loader_html"></div>
    </div>
    <div id="wrap" class="grid_1200">
        <header id="header">
            <section class="container clearfix">
                <div class="logo"><a href="{{ route('home') }}"><img alt="" src="{{ asset('bower_components/askme-style/images/logo.png') }}"></a></div>
                <nav class="navigation">
                    <ul>
                        <li class="ask_question"><a href="cat_question.html">Questions</a>
                            <ul>
                                <li><a href="cat_question.html">Questions Category</a></li>
                                <li><a href="single_question.html">Question Single</a></li>
                                <li><a href="single_question_poll.html">Poll Question Single</a></li>
                            </ul>
                        </li>
                        <li><a href="cat_question.html">Tags</a>
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
                        <li>
                            @guest
                                <a href="{{ route('login') }}">Log In</a>
                            @else
                                <a href="right_sidebar.html">
                                    <span class="name">{{ Auth::user()->name }}</span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('user.show', Auth::id()) }}">My Profile</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            @endguest
                        </li>
                        <li>
                            <input class="search-input" type="text" placeholder="Search here...">
                        </li>
                    </ul>
                </nav>
            </section>
        </header>

        @yield('content')
        
        <footer id="footer">
            <section class="container">
                <div class="copyrights f_left">&copy; 2021 ASK me</div>
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
                </div>
            </section>
        </footer>
    </div>
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
        <script src="{{ asset('bower_components/tata-js/dist/tata.js') }}"></script>
    @show
    
</body>
</html>
