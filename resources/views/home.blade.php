@extends('layouts.master')

@section('style')
	@parent
@endsection

@section('content')
	<div class="section-warp ask-me">
		<div class="container clearfix">
			<div class="box_icon box_warp box_no_border box_no_background" box_border="transparent"
				box_background="transparent" box_color="#FFF">
				<div class="row">
					<div class="col-md-3">
						<h2>Welcome to ASK me</h2>
						<p>Find the best answer to your question about English, help others answer theirs</p>
						<div class="clearfix"></div>
						<a class="color button dark_button medium" href="#">About Us</a>
						<a class="color button dark_button medium" href="#">Join Now</a>
					</div>
					<div class="col-md-9">
						<form class="form-style form-style-2">
							<p>
								<textarea rows="4" id="question_title"
									onfocus="if(this.value=='Ask any question about English and you be sure find your answer ?')this.value='';"
									onblur="if(this.value=='')this.value='Ask any question about English and you be sure find your answer ?';">Ask any question about English and you be sure find your answer ?</textarea>
								<i class="icon-pencil"></i>
								<span class="color button small publish-question">Ask Now</span>
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- <section class="container main-content"> --}}
		{{-- <div class="row"> --}}
			<div class="col-md-8" style="margin-left: 53px">
				<h3>Search for question</h3>
				<input id="question-search" type="text" placeholder="Search question here...">
				<br>
				<div class="tabs-warp question-tab">
					<ul class="tabs">
						<li class="tab"><a href="#" class="current">Newest</a></li>
						<li class="tab"><a href="#">Unanswered</a></li>
						<li class="tab"><a href="#">Votes</a></li>
					</ul>
					<div class="tab-inner-warp">
						<div class="tab-inner">
							@foreach ($questions as $question)
								<article class="question question-type-normal" style="margin-bottom: 5px;">
									<h2>
										<a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
									</h2>
									<div class="question-author">
										<a href="#" original-title="ahmed" class="question-author-img tooltip-n">
											<span></span>
											<img alt="" src="{{ $question->user->avatar }}">
										</a>
									</div>
									<div class="question-inner">
										<div class="clearfix"></div>
										<p class="question-desc">{{ substr(html_entity_decode(strip_tags($question->content->content)),0,255) . '...' }}</p>
										<div class="question-details">
											@if ($question->best_answer_id)
												<span class="question-answered question-answered-done"><i class="icon-ok"></i>solved</span>
											@else 
												<span class="question-answered"><i class="icon-ok"></i>in progress</span>
											@endif
										</div>
										@if ($question->vote_number && $question->vote_number >=2)
											<span class="question-category" style="color: black"><i class="icon-heart-empty"></i>{{ $question->vote_number }} votes</span>
										@else 	
											<span class="question-category" style="color: black"><i class="icon-heart-empty"></i>{{ $question->vote_number }} vote</span>
										@endif
										<span class="question-date"><i class="icon-time"></i>{{ $question->created_at->diffForHumans(Carbon\Carbon::now()) }}</span>
										<span class="question-comment">
											<a href="#"><i class="icon-comments-alt"></i>{{ $question->answers->count() }} Answers</a>
										</span>
										<span class="question-view"><i class="icon-eye-open"></i>70 views</span>
										<div class="clearfix"></div>
									</div>
								</article>
							@endforeach
							<div style="margin-bottom: 30px"></div>
							<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
						</div>
					</div>
					<div class="tab-inner-warp">
						<div class="tab-inner">
							<article class="question question-type-normal">
								<h2>
									<a href="">This is my first Question</a>
								</h2>
								<a class="question-report" href="#">Report</a>
								<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
								<div class="question-author">
									<a href="#" original-title="ahmed"
										class="question-author-img tooltip-n"><span></span><img alt=""
											src="https://2code.info/demo/html/ask-me/images/demo/avatar.png"></a>
								</div>
								<div class="question-inner">
									<div class="clearfix"></div>
									<p class="question-desc">Duis dapibus aliquam mi, eget euismod sem scelerisque
										ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in
										neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi
										tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur
										vitae velit in neque dictum blandit.</p>
									<div class="question-details">
										<span class="question-answered question-answered-done"><i
												class="icon-ok"></i>solved</span>
										<span class="question-favorite"><i class="icon-star"></i>5</span>
									</div>
									<span class="question-category"><a href="#"><i
												class="icon-folder-close"></i>wordpress</a></span>
									<span class="question-date"><i class="icon-time"></i>4 mins ago</span>
									<span class="question-comment"><a href="#"><i class="icon-comment"></i>5
											Answer</a></span>
									<span class="question-view"><i class="icon-user"></i>70 views</span>
									<div class="clearfix"></div>
								</div>
							</article>
							
							<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
						</div>
					</div>
					<div class="tab-inner-warp">
						<div class="tab-inner">
							<article class="question question-type-normal">
								<h2>
									<a href="">This is my first Question</a>
								</h2>
								<a class="question-report" href="#">Report</a>
								<div class="question-type-main"><i class="icon-question-sign"></i>Question</div>
								<div class="question-author">
									<a href="#" original-title="ahmed"
										class="question-author-img tooltip-n"><span></span><img alt=""
											src="https://2code.info/demo/html/ask-me/images/demo/avatar.png"></a>
								</div>
								<div class="question-inner">
									<div class="clearfix"></div>
									<p class="question-desc">Duis dapibus aliquam mi, eget euismod sem scelerisque
										ut. Vivamus at elit quis urna adipiscing iaculis. Curabitur vitae velit in
										neque dictum blandit. Proin in iaculis neque. Pellentesque habitant morbi
										tristique senectus et netus et malesuada fames ac turpis egestas. Curabitur
										vitae velit in neque dictum blandit.</p>
									<div class="question-details">
										<span class="question-answered question-answered-done"><i
												class="icon-ok"></i>solved</span>
										<span class="question-favorite"><i class="icon-star"></i>5</span>
									</div>
									<span class="question-category"><a href="#"><i
												class="icon-folder-close"></i>wordpress</a></span>
									<span class="question-date"><i class="icon-time"></i>4 mins ago</span>
									<span class="question-comment"><a href="#"><i class="icon-comment"></i>5
											Answer</a></span>
									<span class="question-view"><i class="icon-user"></i>70 views</span>
									<div class="clearfix"></div>
								</div>
							</article>
							
							<a href="#" class="load-questions"><i class="icon-refresh"></i>Load More Questions</a>
						</div>
					</div>
				</div><!-- End page-content -->
			</div><!-- End main -->
			
		{{-- </div>
	</section> --}}
	<aside class="col-md-3 sidebar" style="position: sticky; top: 0; margin-bottom: 86px;">
		<div class="widget widget_stats">
			<h3 class="widget_title">Stats</h3>
			<div class="ul_list ul_list-icon-ok">
				<ul>
					<li><i class="icon-question-sign"></i>Questions ( <span>20</span> )</li>
					<li><i class="icon-comment"></i>Answers ( <span>50</span> )</li>
				</ul>
			</div>
		</div>
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
		<div class="widget widget_login">
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
		</div>

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

		<div class="widget">
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
		</div>

	</aside>
@endsection

@section('scripts')
	@parent
	<script src="{{ asset('js/searchQuestion.js') }}"></script>
@endsection
