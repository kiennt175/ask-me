<!DOCTYPE html>
<html lang="en">
<head class="head">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('bower_components/askme-style/images/favicon.png') }}">
    
    @yield('title')

    @section('style')
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/style.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/skins/blue.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/askme-style/css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
        {{-- <link rel="stylesheet" href="{{ asset('bower_components/jBox/dist/jBox.all.min.css') }}"> --}}
    @show
    
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
        <script src="{{ asset('ckeditor5-comment/build/ckeditor.js') }}"></script>
        <script src="{{ asset('js/search.js') }}"></script>
        {{-- <script src="{{ asset('bower_components/jBox/dist/jBox.all.min.js') }}"></script> --}}
    @show
</head>
<body>
    <div class="loader">
        <div class="loader_html"></div>
    </div>
    {{-- <div id="wrap" class="grid_1200"> --}}
        <header id="header">
            <section class="container clearfix">
                <div class="logo"><a href="{{ route('home') }}"><img alt="" src="{{ asset('bower_components/askme-style/images/logo.png') }}"></a></div>
                <nav class="navigation">
                    <ul>
                        <li id="explore" class="current_page_item"><a href="javascript:void(0)">Explore</a>
                            <ul>
                                <li id="questions" class="current_page_item"><a href="{{ route('questions.view') }}">Questions</a></li>
                                <li><a href="">Tags</a></li>
                                <li><a href="">Users</a></li>
                            </ul>
                        </li>
                        <li id="ask_question"><a href="{{ route('user.showAskForm') }}">Ask Question</a></li>
                        <li class="newsfeed">
                            @guest
                                <a href="{{ route('login') }}">Log In</a>
                            @else
                                <a href="javascript:void(0)">
                                    <span class="name">{{ Auth::user()->name }}</span>
                                </a>
                                <ul>
                                    <li class="newsfeed"><a href="{{ route('user.newsfeed') }}">My Newsfeed</a></li>
                                    <li><a href="{{ route('user.pending') }}">My Pending Question</a></li>
                                    <li><a href="{{ route('user.show', Auth::id()) }}">My Profile</a></li>
                                    <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </ul>
                            @endguest
                        </li>
                        <li>
                            <input name="search" id="search" class="search-input" type="text" placeholder="Search here...">
                        </li>
                    </ul>
                </nav>
            </section>
        </header>

        @yield('content')
        
        <div class="clearfix"></div>
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
    {{-- </div> --}}
    <div class="go-up">
        <i class="icon-chevron-up"></i>
    </div>
</body>
</html>
