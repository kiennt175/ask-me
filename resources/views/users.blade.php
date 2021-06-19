@extends('layouts.master')

@section('style')
	@parent
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endsection

@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Users</h1>
                </div>
            </div>
        </section>
    </div>
	{{-- <section class="container main-content"> --}}
		{{-- <div class="row"> --}}
			<div id="tab-top" class="col-md-8" style="margin-left: 53px">
                {{-- <form id="question-search-form" action="" method="get"> --}}
                <input id="user-search" value="{{ $searchText ?? '' }}" name="searchText" type="text" placeholder="Search users by username or name...">
                {{-- </form> --}}
				<br>
				<div class="question-tab">
					@if ($tab == 'points')
                    	<button class="view-tab clicked">Points</button>
					@elseif (!isset($searchText)) 
						<a href="{{ route('users.view', 'points') }}#tab-top"><button class="view-tab">Points</button></a>
					@else
						<a href="{{ route('users.search', [$searchText, 'points']) }}#tab-top"><button class="view-tab">Points</button></a>
					@endif

					@if ($tab == 'name')
                    	<button class="view-tab clicked">Name</button>
					@elseif (!isset($searchText))
                    	<a href="{{ route('users.view', 'name') }}#tab-top"><button class="view-tab">Name</button></a>
					@else
						<a href="{{ route('users.search', [$searchText, 'name']) }}#tab-top"><button class="view-tab">Name</button></a>
					@endif

					@if ($tab == 'newest')
                    	<button class="view-tab clicked">Newest</button>
					@elseif (!isset($searchText))
                    	<a href="{{ route('users.view', 'newest') }}#tab-top"><button class="view-tab">Newest</button></a>
					@else 
						<a href="{{ route('users.search', [$searchText, 'newest']) }}#tab-top"><button class="view-tab">Newest</button></a>
					@endif
                    <br><br>
					<div class="tags-block">
						<div class="">
							<div class="clearfix pagination-user">
								{{ $users->links() }}
								<br>
							</div>
							<br><br>
                            @foreach ($users as $user)
                                <li class="col-md-4 user-block">
                                    <div class="author-img">
                                        <a href="{{ route('user.show', $user->id) }}">
                                            <img width="60" height="60" src="{{ $user->avatar ?? asset('images/default_avatar.png') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="user-info">
                                        <h6 class="name"><a href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a></h6>
                                        <span class="username"><i>{{ $user->username ?? '' }}</i></span>
                                        <div class="after-username"></div>
                                        @if ($tab == 'points')
                                            <span class="points"><b>{{ $user->points }} points</b></span>
                                        @else
                                            <span class="points">{{ $user->points }} points</span>
                                        @endif
                                        <div></div>
                                        @if ($tab == 'newest')
                                            <span class="created-at"><b>{{ 'joined at ' . $user->created_at->format('d/m/Y') }}</b></span>
                                        @else 
                                            <span class="created-at">{{ 'joined at ' . $user->created_at->format('d/m/Y') }}</span>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                            
							{{-- @foreach ($tags as $tag)
								<div class="col-md-2 tag">
									<button class="tag-button">{{ $tag->tag }}</button>
									@if ($tag->questions_count > 1)
										<p class="question-count">{{ $tag->questions_count }} questions</p>
									@else 
										<p class="question-count">{{ $tag->questions_count }} question</p>
									@endif 
								</div>
							@endforeach --}}
						</div>
					</div>
					<div class="clearfix" style="margin-bottom: 30px"></div>
					<div class="clearfix">
						{{ $users->links() }}
					</div>
					<div class="clearfix" style="margin-bottom: 30px"></div>
				</div>
			</div>
		{{-- </div>
	</section> --}}
	<aside class="col-md-3 sidebar" style="position: sticky; top: 0; margin-bottom: 86px;">
		{{-- <div class="widget widget_stats">
			<h3 class="widget_title">Stats</h3>
			<div class="ul_list ul_list-icon-ok">
				<ul>
					<li><i class="icon-question-sign"></i>Questions ( <span>20</span> )</li>
					<li><i class="icon-comment"></i>Answers ( <span>50</span> )</li>
				</ul>
			</div>
		</div> --}}
		<div class="widget widget_social">
			<h3 class="widget_title">Find Us</h3>
			<ul>
				<li class="rss-subscribers">
					<a href="#" target="_blank">
						<strong>
							<i class="icon-rss"></i>
							<span>Subscribe</span><br>
							<small>To RSS Feed</small>
						</strong>
					</a>
				</li>
				<li class="facebook-fans">
					<a href="#" target="_blank">
						<strong>
							<i class="social_icon-facebook"></i>
							<span>5,000</span><br>
							<small>People like it</small>
						</strong>
					</a>
				</li>
				<li class="twitter-followers">
					<a href="#" target="_blank">
						<strong>
							<i class="social_icon-twitter"></i>
							<span>3,000</span><br>
							<small>Followers</small>
						</strong>
					</a>
				</li>
				<li class="youtube-subs">
					<a href="#" target="_blank">
						<strong>
							<i class="icon-play"></i>
							<span>1,000</span><br>
							<small>Subscribers</small>
						</strong>
					</a>
				</li>
			</ul>
		</div>
		{{-- <div class="widget widget_login">
			<h3 class="widget_title">Login</h3>
			<div class="form-style form-style-2">
				<form>
					<div class="form-inputs clearfix">
						<p class="login-text">
							<input type="text" value="Username"
								onfocus="if (this.value == 'Username') {this.value = '';}"
								onblur="if (this.value == '') {this.value = 'Username';}">
							<i class="icon-user"></i>
						</p>
						<p class="login-password">
							<input type="password" value="Password"
								onfocus="if (this.value == 'Password') {this.value = '';}"
								onblur="if (this.value == '') {this.value = 'Password';}">
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
				<ul class="login-links login-links-r">
					<li><a href="#">Register</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div> --}}

		<div class="widget widget_highest_points">
			<h3 class="widget_title">Highest points</h3>
			<ul>
				<li>
					<div class="author-img">
						<a href="#"><img width="60" height="60"
								src="https://2code.info/demo/html/ask-me/images/demo/admin.jpeg" alt=""></a>
					</div>
					<h6><a href="#">admin</a></h6>
					<span class="comment">12 Points</span>
				</li>
				<li>
					<div class="author-img">
						<a href="#"><img width="60" height="60"
								src="https://2code.info/demo/html/ask-me/images/demo/avatar.png" alt=""></a>
					</div>
					<h6><a href="#">vbegy</a></h6>
					<span class="comment">10 Points</span>
				</li>
				<li>
					<div class="author-img">
						<a href="#"><img width="60" height="60"
								src="https://2code.info/demo/html/ask-me/images/demo/avatar.png" alt=""></a>
					</div>
					<h6><a href="#">ahmed</a></h6>
					<span class="comment">5 Points</span>
				</li>
			</ul>
		</div>

		<div class="widget widget_tag_cloud">
			<h3 class="widget_title">Tags</h3>
			<a href="#">projects</a>
			<a href="#">Portfolio</a>
			<a href="#">Wordpress</a>
			<a href="#">Html</a>
			<a href="#">Css</a>
			<a href="#">jQuery</a>
			<a href="#">2code</a>
			<a href="#">vbegy</a>
		</div>

		{{-- <div class="widget">
			<h3 class="widget_title">Recent Questions</h3>
			<ul class="related-posts">
				<li class="related-item">
					<h3><a href="#">This is my first Question</a></h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<div class="clear"></div><span>Feb 22, 2014</span>
				</li>
				<li class="related-item">
					<h3><a href="#">This Is My Second Poll Question</a></h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
					<div class="clear"></div><span>Feb 22, 2014</span>
				</li>
			</ul>
		</div> --}}

	</aside>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('js/searchUser.js') }}"></script>
@endsection
