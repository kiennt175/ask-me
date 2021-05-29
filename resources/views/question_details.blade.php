@extends('layouts.master')

@section('style')
	@parent
    {{-- <link rel="stylesheet" href="{{ asset('css/editor.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/ipa.css') }}">
    <link rel="stylesheet" href="{{ asset('css/recorder.css') }}">
    <link rel="stylesheet" href="{{ asset('css/questionDetailsPage.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/cute-alert/style.css') }}">
    <script>
        if (!document.addEventListener) {
            parent.location.href = 'ie8/type.html';
        }
        //--------------------------------------------------------------------
        if (parent.location.href != window.location.href) {
            parent.location.href = window.location.href;
        }
        //--------------------------------------------------------------------
        var f = 0;
        var left = "pete";
        var right = "e-lang.co.uk";
        //--------------------------------------------------------------------
        var report = 'typefb.php';
        var about = 'typehelp.html';
        var home = 'http://mackichan.e-lang.co.uk/javascript-call-activities/';
        var again = 'type.html';
        var selectedString = "";
        var ipaCode = new Array();
        ipaCode[0] = new Array("", "105,720", "618", "650", "117,720", "618,601", "101,618", "712", "716");
        ipaCode[1] = new Array("", "101", "601", "604,720", "596,720", "650,601", "596,618", "601,650");
        ipaCode[2] = new Array("", "230", "652", "593,720", "594", "101,601", "097,618", "097,650");
        ipaCode[3] = new Array("", "112", "98", "116", "100", "679", "676", "107", "103");
        ipaCode[4] = new Array("", "102", "118", "952", "240", "115", "122", "643", "658");
        ipaCode[5] = new Array("", "109", "110", "331", "104", "108", "114", "119", "106");
        //I changed this to specify a zero array length to overcome problems in IE 5.5
        var myAnswer = new Array(0);
        var help = '';
        var webNav = new Array("webIE", "webNot");
        var wordNav = new Array("wordIE", "wordNot");
        //--------------------------------------------------------------------
        browser = navigator.appName;
        var IE = false;
        if (browser == "Microsoft Internet Explorer") {
            IE = true;
        }
        //--------------------------------------------------------------------
        function doAnswer() {
            var answerString = "";
            var oldString = "";
            var oldStringLong = "";
            var partOne = "";
            var partTwo = "";
            var finalAnswer = "";
            var finalAnswerWord = "";
            var finalAnswerWeb = "";
            for (i = 0; i < myAnswer.length; i++) {
                oldString = myAnswer[i];
                if (oldString.length > 3) {
                    partOne = oldString.substr(0, 3)
                    partTwo = oldString.substr(4, 7)
                    answerString = answerString + String.fromCharCode(partOne);
                    answerString = answerString + String.fromCharCode(partTwo);
                    oldStringLong = oldStringLong + '&#' + partOne + ';';
                    oldStringLong = oldStringLong + '&#' + partTwo + ';';
                    partOne = partOne.replace('058', '720')
                    partTwo = partTwo.replace('058', '720')
                    finalAnswerWord = finalAnswerWord + String.fromCharCode(partOne);
                    finalAnswerWord = finalAnswerWord + String.fromCharCode(partTwo);
                } else {
                    answerString = answerString + String.fromCharCode(myAnswer[i]);
                    oldStringLong = oldStringLong + '&#' + oldString + ';';
                    tempString = myAnswer[i];
                    tempString = tempString.replace('058', '720');
                    finalAnswerWord = finalAnswerWord + String.fromCharCode(tempString);
                }
            }
            if (answerString.length > 0) {
                finalAnswer = "/" + answerString + "/";
            } else {
                finalAnswer = answerString;
            }
            if (!'{{ Auth::check() }}') {
                document.forms[1].resultview.value = finalAnswer;
                document.forms[1].result.value = '/' + finalAnswerWord + '/';
                finalAnswerWeb = oldStringLong;
                document.forms[1].resultweb.value = '/' + finalAnswerWeb + '/';
            } else {
                document.forms[2].resultview.value = finalAnswer;
                document.forms[2].result.value = '/' + finalAnswerWord + '/';
                finalAnswerWeb = oldStringLong;
                document.forms[2].resultweb.value = '/' + finalAnswerWeb + '/';
            }
            
        }
        //--------------------------------------------------------------------
        function chooseMe(foo) {
            cx = foo % 10;
            rx = Math.floor(foo / 10);
            b = myAnswer.length;
            myAnswer[b] = ipaCode[rx][cx];
            doAnswer();
        }
        //--------------------------------------------------------------------
        function addSpace() {
            b = myAnswer.length;
            myAnswer[b] = "032";
            doAnswer();
        }
        //--------------------------------------------------------------------
        function clearOne() {
            if (myAnswer.length > 0) {
                myAnswer.length = myAnswer.length - 1;
            }
            doAnswer();
        }
        //--------------------------------------------------------------------
        function clearAll() {
            myAnswer.length = 0;
            //there is a problem here with some IE5.5 - not an object. Why?
            doAnswer();
        }
        //--------------------------------------------------------------------
        function buttonCaption(foo) {
            var keyString = "";
            if (foo.length > 3) {
                keyString = keyString + '&#' + foo.substr(0, 3) + ';' + '&#' + foo.substr(4, 7) + ';';
            } else {
                keyString = keyString + '&#' + foo + ';';
            }
            return (keyString);
        }
    </script>
@endsection

@section('scripts')
	@parent
    <script>
        var checkLogin = '{{ Auth::check() }}';
        var content = '{!! $question->content->content !!}';
        // var editorNumber = '{{ $question->answers->count() }}';
        var currentUserId = "{{ Auth::id() ?? 0 }}";
        var currentUserName = "{{ Auth::user()->name ?? '' }}";
        var currentUserAvatar = '{{ Auth::user()->avatar ?? ''  }}'.replace('amp;', '');
        var questionUserId = "{{ $question->user->id }}"; 
        var questionUserAvatar = "{{ $question->user->avatar }}".replace('amp;', ''); 
        var questionId = "{{ $question->id }}";
        var questionUserName = '{{ $question->user->name }}';
        var answerUserIds = @json($answerUserIds);
        var answerUserNames = @json($answerUserNames);
        var answerUserAvatars = @json($answerUserAvatars);
        var answerContents = @json($answerContents);
        var answerConversations = @json($answerConversations);
        var answerIds = @json($answerIds);
    </script>
    <script src="{{ asset('js/recorder.js') }}"></script>
    {{-- <script src="{{ asset('js/postQuestion.js') }}"></script> --}}
    {{-- <script src="{{ asset('js/askQuestionPage.js') }}"></script> --}}
    <script src="{{ asset('js/questionDetailsPage.js') }}"></script>
    <script src="{{ asset('js/voteQuestion.js') }}"></script>
    <script src="{{ asset('js/postAnswer.js') }}"></script>
    <script src="{{ asset('js/voteAnswer.js') }}"></script>
    <script src="{{ asset('js/redirectLogin.js') }}"></script>
    <script src="{{ asset('js/bestAnswer.js') }}"></script>
    <script src="{{ asset('bower_components/cute-alert/cute-alert.js') }}"></script>
    <script src="{{ asset('js/addComment.js') }}"></script>
@endsection

@section('content')
    <div class="breadcrumbs">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Questions</h1>
                </div>
            </div>
        </section>
    </div>
    <section class="container main-content">
        <div class="row">
            <div class="col-md-8">
                <div class="about-author clearfix">
                    <div class="author-image">
                        <a href="#" original-title="author" class="tooltip-n"><img alt="" src="{{ $question->user->avatar ? $question->user->avatar : asset('images/default_avatar.png') }}"></a>
                    </div>
                    <div class="author-bio">
                        <a href="{{ route('user.show', $question->user->id) }}"><h3>{{ $question->user->name }}</h3></a>
                        <button class="follow-user">Follow This User</button>
                        <span>{{ '@' . $question->user->username }}</span>
                    </div>
                </div>
                <article class="question single-question question-type-normal">
                    <h2 class="question-title">
                        <a href="{{ route('questions.show', $question->id) }}">{{ $question->title }}</a>
                    </h2>
                    @if ($question->best_answer_id)
                        <span class="question-answered question-answered-done solved"><i class="icon-ok"></i>solved</span>
                    @else     
                        <span class="question-answered progress"><i class="icon-ok"></i>in progress</span>
                    @endif
                    {{-- <div class="question-type-main"><i class="icon-question-sign"></i>Question</div> --}}
                    <div class="question-inner">
                        <div class="clearfix"></div>
                        <div class="question-desc">
                            <div id="ckeditor-container">
                                <div id="editor"></div>
                                <div id="sidebar" class="ckeditor-sidebar"></div>
                            </div> 
                            <br>
                            @if ($question->images->count()) 
                                <div class="bxslider" sty>
                                    @php 
                                        $imageNumber = $question->images->count()
                                    @endphp
                                    @foreach ($question->images as $key => $image)
                                        <div class="slide" >
                                            <div class="grid-bxslider">
                                                <div class="bxslider-overlay t_center">
                                                    <a href="#" class="bxslider-title">
                                                        <br>
                                                        <h4>{{ ++$key }}/{{ $imageNumber }}</h4>
                                                    </a>
                                                    <a href="{{ $image->url }}" class="prettyPhoto" rel="prettyPhoto">
                                                        <span class="overlay-lightbox">
                                                            <i class="icon-search"></i>
                                                        </span>
                                                    </a>
                                                </div>  
                                                <div style="width:154.5px; height:96.297px"><img style="height: 100%; width: 100%; object-fit: contain" src="{{ $image->url }}" alt=""></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            @if ($question->medias->count())
                                <div>
                                    @foreach ($question->medias as $key => $media)
                                        <audio controls controlsList="nodownload">
                                            <source src="{{ $media->url }}" type="audio/ogg">
                                            <source src="{{ $media->url }}" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                        <span>&nbsp;</span>
                                    @endforeach
                                </div>
                                <br>
                            @endif
                            <div class="tags-block">
                                @foreach ($question->tags as $tag)
									<button class="tags">{{ $tag->tag }}</button>
								@endforeach
                            </div>
                            <br>
                        </div>
                        <div class="question-details">
                            <span class="question-answered question-answered-done vote-number">
                                <a class="vote-question" href="{{ route('questions.vote', $question->id) }}">
                                    @if (!$votedCheck)
                                        <i class="icon-heart heart-icon-unvote"></i>
                                    @else
                                        <i class="icon-heart heart-icon-vote"></i>
                                    @endif
                                </a>
                                <span id="vote-number">{{ $question->vote_number }}</span> votes
                            </span>
                            {{-- <span class="question-favorite"><i class="icon-star"></i>5</span> --}}
                        </div>
                        {{-- <span class="question-category"><a href="#"><i class="icon-folder-close"></i>wordpress</a></span> --}}
                        <span class="question-date"><i class="icon-time"></i>{{ Carbon\Carbon::parse($question->created_at)->diffForHumans() }}</span>
                        <span class="question-comment"><a href="#"><i class="icon-comments"></i>{{ $question->answers->count() }} answers</a></span>
                        <span class="question-view"><i class="icon-eye-open"></i>{{ $question->view_number }} views</span>
                        @if ($question->updated)
                            <span class="question-view question-edited"><i class="icon-pencil"></i>edited {{ Carbon\Carbon::parse($question->updated_at)->diffForHumans() }}</span>
                        @endif
                        @if (Auth::id() == $question->user->id)
                            <span class="single-question-vote-result"><button class="question-options" id="delete-question">Delete</button></span>
                            <a href="{{ route('questions.edit', $question->id) }}"><span class="single-question-vote-result"><button class="question-options" id="edit-question">Edit</button></span></a>
                        @endif
                        {{-- <ul class="single-question-vote">
                            <li><a href="#" class="single-question-vote-down" title="Dislike"><i class="icon-thumbs-down"></i></a></li>
                            <li><a class="question-report single-question-vote-up" href="#">Report</a></li>
                        </ul> --}}
                        <div class="clearfix"></div>
                    </div>
                </article>
                <div class="share-tags page-content">
                    <div class="question-tags">
                        <button id="follow-this-question">Follow This Question</button>
                        {{-- <span>&nbsp;</span> --}}
                        {{-- <button id="report">Report</button> --}}
                    </div>
                    <div class="share-inside-warp">
                        <ul>
                            <li>
                                <a href="#" original-title="Facebook">
                                    <span class="icon_i">
                                        <span class="icon_square" icon_size="20" span_bg="#3b5997" span_hover="#666">
                                            <i i_color="#FFF" class="social_icon-facebook"></i>
                                        </span>
                                    </span>
                                </a>
                                <a href="#" target="_blank">Facebook</a>
                            </li>
                        </ul>
                        <span class="share-inside-f-arrow"></span>
                        <span class="share-inside-l-arrow"></span>
                    </div>
                    <div class="share-inside"><i class="icon-share-alt"></i>Share</div>
                    <div class="clearfix"></div>
                </div>
                <div id="commentlist" class="page-content">
                    <div class="boxedtitle page-title"  id="tab-top">
                        <h2>
                            Answers ( <span class="color" id="answer-number">{{ $question->answers->count() }}</span> )  
                            <div id="sort-answers">
                                @if ($sortBy == 'oldest')
                                    <a href="{{ route('questions.showBy', ['questionId' => $question->id, 'sortBy' => 'vote_number']) }}#tab-top">
                                        <button class="sort-answers-button sort-answers-first-button">
                                            Votes
                                        </button> 
                                    </a>
                                    <button class="sorted-by sort-answers-end-button">Oldest</button> 
                                @elseif ($sortBy == 'vote_number')
                                    <button class="sorted-by sort-answers-first-button">
                                        Votes
                                    </button> 
                                    <a href="{{ route('questions.show', $question->id) }}#tab-top">
                                        <button class="sort-answers-button sort-answers-end-button">Oldest</button> 
                                    </a>
                                @endif
                            </div>
                        </h2>
                        <div>
                            {{ $answers->links() }}
                        </div>
                    </div>
                    <ol class="commentlist clearfix">
                        <script>
                            class CommentsIntegrationFactory {
                                constructor(appData) {
                                    this.appData = appData
                                }
                                genCommentsIntegration() {
                                    const self = this;
                                    return class CommentsIntegration {
                                        constructor(editor) {
                                            this.editor = editor;
                                        }
                                        init() {
                                            const usersPlugin = this.editor.plugins.get('Users');
                                            const commentsRepositoryPlugin = this.editor.plugins.get('CommentsRepository');
                                            // Load the users data.
                                            for (const user of self.appData.users) {
                                                usersPlugin.addUser(user);
                                            }
                                            // Set the current user.
                                            usersPlugin.defineMe(self.appData.userId);
                                            // Load the comment threads data.
                                            for (const commentThread of self.appData.commentThreads) {
                                                commentsRepositoryPlugin.addCommentThread(commentThread);
                                            }
                                            commentsRepositoryPlugin.adapter = {
                                                addComment(data) {
                                                    const commentThreadsData = commentsRepositoryPlugin.getCommentThreads( {
                                                        skipNotAttached: true,
                                                        skipEmpty: true,
                                                        toJSON: true
                                                    } );
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'http://localhost:8000/questions/answer/' + self.appData.answerId + '/updateConversation',
                                                        data: {
                                                            conversation: JSON.stringify(commentThreadsData),
                                                        },
                                                        success: function(data){
                                                            
                                                        },
                                                        error: function(error){
                                                        
                                                        }
                                                    });
                                                    // Write a request to your database here. The returned `Promise`
                                                    // should be resolved when the request has finished.
                                                    // When the promise resolves with the comment data object, it
                                                    // will update the editor comment using the provided data.
                                                    return Promise.resolve({
                                                        createdAt: new Date() // Should be set on the server side.
                                                    })
                                                },
                                                updateComment(data) {
                                                    console.log('Comment updated', data)
                                                    const commentThreadsData = commentsRepositoryPlugin.getCommentThreads( {
                                                        skipNotAttached: true,
                                                        skipEmpty: true,
                                                        toJSON: true
                                                    } );
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'http://localhost:8000/questions/answer/' + self.appData.answerId + '/updateConversation',
                                                        data: {
                                                            conversation: JSON.stringify(commentThreadsData) 
                                                        },
                                                        success: function(data){
                                                            
                                                        },
                                                        error: function(error){
                                                        
                                                        }
                                                    });
                                                    // Write a request to your database here. The returned `Promise`
                                                    // should be resolved when the request has finished.
                                                    return Promise.resolve()
                                                },
                                                removeComment( data ) {
                                                    console.log( 'Comment removed', data );
                                                    const commentThreadsData = commentsRepositoryPlugin.getCommentThreads( {
                                                        skipNotAttached: true,
                                                        skipEmpty: true,
                                                        toJSON: true
                                                    } );
                                                    $.ajaxSetup({
                                                        headers: {
                                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                        }
                                                    });
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'http://localhost:8000/questions/answer/' + self.appData.answerId + '/updateConversation',
                                                        data: {
                                                            conversation: JSON.stringify(commentThreadsData) 
                                                        },
                                                        success: function(data){
                                                            
                                                        },
                                                        error: function(error){

                                                        }
                                                    });
                                                    // Write a request to your database here. The returned `Promise`
                                                    // should be resolved when the request has finished.
                                                    return Promise.resolve();
                                                },
                                                
                                            }
                                        }
                                    }
                                }
                            }
                        </script>
                        <div class="infinite-scroll">
                            
                            @foreach ($answers as $key => $answer)
                                <script>
                                    var i = '{{ $answers->firstItem() + $key - 1 }}';
                                    
                                </script>
                                
                                <li class="comment" id="answer-{{ $answer->id }}">
                                    <div class="comment-body comment-body-answered clearfix"> 
                                        <div class="avatar"><img alt="" src="{{ $answer->user->avatar ? $answer->user->avatar : asset('images/default_avatar.png') }}"></div>
                                        <div class="comment-text">
                                            <div class="author clearfix">
                                                <div class="comment-author"><a href="{{ route('user.show', $answer->user_id) }}">{{ $answer->user->name }}</a></div>
                                                {{-- <div class="comment-vote"> --}}
                                                    {{-- <ul class="question-vote"> --}}
                                                        {{-- <li><a href="#" class="question-vote-up" title="Like"></a></li>
                                                        <li><a href="#" class="question-vote-down" title="Dislike"></a></li> --}}
                                                        {{-- <div class="ul_list ul_list-icon-ok ul_list_circle" list_background="#3498db" list_background_hover="#2f3239" list_color="#FFF">
                                                            <ul>
                                                                <a href="javacript:void(0)"><li><i l_background="#e74c3c" l_background_hover="red" class="icon-heart ul_l_circle"></i></li></a>
                                                            </ul>
                                                        </div> --}}
                                                    {{-- </ul> --}}
                                                {{-- </div> --}}
                                                {{-- <span class="question-vote-result">1 votes</span> --}}
                                                <div class="comment-meta">
                                                    <div class="date"><i class="icon-time"></i>{{ Carbon\Carbon::parse($answer->created_at)->diffForHumans() }}</div> 
                                                </div>
                                                @if ($question->best_answer_id == $answer->id)
                                                    <div class="question-answered question-answered-done" id="best-answer">
                                                        <i id="best-{{ $answer->id }}" class="icon-ok"></i>Best Answer
                                                    </div>
                                                @elseif (Auth::id() == $question->user->id)
                                                    <button id="best-answer-{{ $answer->id }}" class="best-answer">Best Answer</button> 
                                                @endif
                                            </div>
                                            <div class="text">
                                                <div class="ckeditor-container">
                                                    <div id="editor{{ $answer->id }}"></div>
                                                    <div id="sidebar{{ $answer->id }}" class="ckeditor-sidebar"></div>
                                                </div> 
                                                <div style="width: 567px">
                                                    <br>
                                                    @if ($answer->images->count()) 
                                                        <div class="bxslider">
                                                            @php 
                                                                $imageAnswerNumber = $answer->images->count()
                                                            @endphp
                                                            @foreach ($answer->images as $answerImageKey => $answerImage)
                                                                <div class="slide">
                                                                    <div class="grid-bxslider">
                                                                        <div class="bxslider-overlay t_center">
                                                                            <a href="#" class="bxslider-title">
                                                                                <br>
                                                                                <h4 style="margin-top: -3px">{{ ++$answerImageKey }}/{{ $imageAnswerNumber }}</h4>
                                                                            </a>
                                                                            <a href="{{ $answerImage->url }}" class="prettyPhoto" rel="prettyPhoto"><span class="overlay-lightbox overlay-lightbox-for-answer"><i class="icon-search"></i></span></a>
                                                                        </div>
                                                                        <div style="width:119.25px; height:74.325px">
                                                                            <img style="max-width: 100%; max-height: 100%;" src="{{ $answerImage->url }}" alt="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    @if ($answer->medias->count())
                                                        <div>
                                                            @foreach ($answer->medias as $answerMediaKey => $media)
                                                                <audio controls controlsList="nodownload" style="width: 240px;">
                                                                    <source src="{{ $media->url }}" type="audio/ogg">
                                                                    <source src="{{ $media->url }}" type="audio/mpeg">
                                                                    Your browser does not support the audio element.
                                                                </audio>
                                                                <span>&nbsp;</span>
                                                            @endforeach
                                                        </div>
                                                        <br>
                                                    @endif
                                                </div>
                                            </div>
                                            {{-- <i class="vote-answer" l_background="#e74c3c" l_background_hover="#2f3239" class="icon-star ul_l_circle"></i> --}}
                                            {{-- <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a>  --}}
                                            <a class="vote-answer" href="{{ route('answers.vote', $answer->id) }}">
                                                @if ($answerVotedCheck[$answers->firstItem() + $key - 1] == 0) 
                                                    <i class="icon-heart heart-icon-answer-unvote" id="vote-answer-{{$answer->id}}"></i>
                                                @else
                                                    <i class="icon-heart heart-icon-answer-vote answer-vote" id="vote-answer-{{$answer->id}}"></i>
                                                @endif
                                            </a>   
                                            <span class="answer-vote-number" id="answer-{{ $answer->id }}-vote-number">{{ $answer->vote_number }}</span> <b style="font-size: 13px">votes</b> 
                                            {{-- @if ($question->best_answer_id != $answer->id)
                                                <button class="best-answer">Edit</button>
                                            @endif  --}}
                                        </div>
                                    </div>
                                    <ul class="children">
                                        @foreach ($answer->comments as $comment)
                                            <li class="comment">
                                                <div class="comment-body clearfix"> 
                                                    <div class="comment-avatar avatar"><img alt="" src="{{ $comment->user->avatar ?? asset('images/default_avatar.png') }}"></div>
                                                    <div class="comment-text">
                                                        <div class="author comment-info clearfix">
                                                            <div class="comment-author comment-font-size"><a href="#">{{ $comment->user->name }}</a></div>
                                                            {{-- <div class="comment-vote">
                                                                <ul class="question-vote">
                                                                    <li><a href="#" class="question-vote-up" title="Like"></a></li>
                                                                    <li><a href="#" class="question-vote-down" title="Dislike"></a></li>
                                                                </ul>
                                                            </div> --}}
                                                            {{-- <span class="question-vote-result">+1</span> --}}
                                                            <div class="comment-meta">
                                                                <div class="date comment-date"><i class="icon-time"></i>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans() }}</div> 
                                                            </div>
                                                            {{-- <a class="comment-reply" href="#"><i class="icon-reply"></i>Reply</a>  --}}
                                                        </div>
                                                        <div class="text"><div class="comment-content">{{ $comment->comment }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        <li class="comment" id="comment-for-answer-{{ $answer->id }}">
                                            <div class="comment-body clearfix"> 
                                                <div>
                                                    <div class="avatar comment-avatar"><img alt="" src="{{ Auth::user()->avatar ?? asset('images/default_avatar.png') }}"></div>
                                                    <input id="add-comment-answer-{{ $answer->id }}" class="comments" type="text" name="comment" placeholder="Add a comment...">
                                                </div> 
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <script>
                                    if (currentUserId != questionUserId && currentUserId != answerUserIds[i]) {
                                        var appData = {
                                            answerId: answerIds[i],
                                            users: [
                                                {
                                                    id: 'user-' + questionUserId,
                                                    name: questionUserName,
                                                    avatar: questionUserAvatar || 'http://localhost:8000/images/default_avatar.png'
                                                },
                                                {
                                                    id: 'user-' + answerUserIds[i],
                                                    name: answerUserNames[i],
                                                    avatar: answerUserAvatars[i] || 'http://localhost:8000/images/default_avatar.png'
                                                }
                                            ],
                                            // The ID of the current user.
                                            userId: 'user-' + currentUserId,
                                            // CommentThreads
                                            commentThreads: JSON.parse(answerConversations[i]),
                                            // Editor initial data.
                                            initialData: answerContents[i].replace(/<comment-start[^>]*>/g, '').replace(/<\/?comment-start[^>]*>/g, '').replace(/<comment-end[^>]*>/g, '').replace(/<\/?comment-end[^>]*>/g, '')
                                        }
                                        ClassicEditor
                                            .create(document.querySelector('#editor' + answerIds[i]), {
                                                initialData: appData.initialData,
                                                licenseKey: 'NA/p3cJE+GCKGiea4vxkQ9/D/W+5t7xlqTtGJx86N6ELM50d2zNNQQPi',
                                                sidebar: {
                                                    container: document.querySelector('#sidebar' + answerIds[i])
                                                },
                                                link: {
                                                    addTargetToExternalLinks: true
                                                },
                                            })
                                            .then(editor => {
                                                editor.plugins.get('AnnotationsUIs').switchTo('narrowSidebar');
                                                editor.isReadOnly = true
                                                
                                                
                                                
                                            })
                                            .catch(error => console.error(error));
                                    } else if (currentUserId == questionUserId && currentUserId == answerUserIds[i]) {
                                        var appData = {
                                            answerId: answerIds[i],
                                            // Users data.
                                            users: [
                                                // {
                                                //     id: 'user-' + questionUserId,
                                                //     name: questionUserName,
                                                //     avatar: questionUserAvatar || 'http://localhost:8000/images/default_avatar.png'
                                                // },
                                                {
                                                    id: 'user-' + answerUserIds[i],
                                                    name: answerUserNames[i],
                                                    avatar: answerUserAvatars[i] || 'http://localhost:8000/images/default_avatar.png'
                                                }
                                            ],
                                            // The ID of the current user.
                                            userId: 'user-' + currentUserId,
                                            // CommentThreads
                                            commentThreads: JSON.parse(answerConversations[i]),
                                            // Editor initial data.
                                            initialData: answerContents[i]
                                        }
                                        ClassicEditor
                                            .create(document.querySelector('#editor' + answerIds[i]), {
                                                
                                                initialData: appData.initialData,
                                                extraPlugins: [new CommentsIntegrationFactory(appData).genCommentsIntegration()],
                                                licenseKey: 'NA/p3cJE+GCKGiea4vxkQ9/D/W+5t7xlqTtGJx86N6ELM50d2zNNQQPi',
                                                sidebar: {
                                                    container: document.querySelector('#sidebar' + answerIds[i])
                                                },
                                                link: {
                                                    addTargetToExternalLinks: true
                                                },
                                                commentsOnly: true,
                                            })
                                            .then(editor => {
                                                editor.plugins.get('AnnotationsUIs').switchTo('narrowSidebar');
                                                // if (currentUserId == answerUserIds[i]) {
                                                //     editor.isReadOnly = true
                                                // }
                                                // if (currentUserId == questionUserId) {
                                                //     editor.plugins.get('CommentsOnly').isEnabled = true;
                                                // }
                                                editor.model.markers.on( 'update:comment', ( evt, marker, oldRange, newRange ) => {
                                                    if ( !newRange ) {
                                                        const threadId = marker.name.split( ':' ).pop();
                                                        const editorData = editor.data.get();
                                                        const commentsRepository = editor.plugins.get('CommentsRepository');
                                                        const commentThreadsData = commentsRepository.getCommentThreads( {
                                                            skipNotAttached: true,
                                                            skipEmpty: true,
                                                            toJSON: true
                                                        } );
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'http://localhost:8000/questions/answer/' + editor.sourceElement.id.substr(6) + '/deleteConversationThread',
                                                            data: {
                                                                conversation: JSON.stringify(commentThreadsData),
                                                                answerContent: editorData
                                                            },
                                                            success: function(data){
                                                                
                                                            },
                                                            error: function(error){

                                                            }
                                                        });
                                                        console.log( `The comment thread with ID ${ threadId } has been removed.` );
                                                    }
                                                } );
                                                
                                            })
                                            .catch(error => console.error(error));
                                    } else {
                                        var appData = {
                                            answerId: answerIds[i],
                                            // Users data.
                                            users: [
                                                {
                                                    id: 'user-' + questionUserId,
                                                    name: questionUserName,
                                                    avatar: questionUserAvatar || 'http://localhost:8000/images/default_avatar.png'
                                                },
                                                {
                                                    id: 'user-' + answerUserIds[i],
                                                    name: answerUserNames[i],
                                                    avatar: answerUserAvatars[i] || 'http://localhost:8000/images/default_avatar.png'
                                                }
                                            ],
                                            // The ID of the current user.
                                            userId: 'user-' + currentUserId,
                                            // CommentThreads
                                            commentThreads: JSON.parse(answerConversations[i]),
                                            // Editor initial data.
                                            initialData: answerContents[i]
                                        }
                                        ClassicEditor
                                            .create(document.querySelector('#editor' + answerIds[i]), {
                                                commentsOnly: true,
                                                initialData: appData.initialData,
                                                extraPlugins: [new CommentsIntegrationFactory(appData).genCommentsIntegration()],
                                                licenseKey: 'NA/p3cJE+GCKGiea4vxkQ9/D/W+5t7xlqTtGJx86N6ELM50d2zNNQQPi',
                                                sidebar: {
                                                    container: document.querySelector('#sidebar' + answerIds[i])
                                                },
                                                link: {
                                                    addTargetToExternalLinks: true
                                                },
                                            })
                                            .then(editor => {
                                                editor.plugins.get('AnnotationsUIs').switchTo('narrowSidebar');
                                                // if (currentUserId == answerUserIds[i]) {
                                                //     editor.isReadOnly = true
                                                // }
                                                // if (currentUserId == questionUserId) {
                                                //     editor.plugins.get('CommentsOnly').isEnabled = true;
                                                // }
                                                // const commentsRepository = editor.plugins.get('CommentsRepository');
                                                // Get the data on demand.
                                                editor.model.markers.on( 'update:comment', ( evt, marker, oldRange, newRange ) => {
                                                    const commentsRepository = editor.plugins.get('CommentsRepository');
                                                    const commentThreadsData = commentsRepository.getCommentThreads( {
                                                            skipNotAttached: true,
                                                            skipEmpty: true,
                                                            toJSON: true
                                                        } );
                                                    if ( !newRange ) {
                                                        const threadId = marker.name.split( ':' ).pop();
                                                        const editorData = editor.data.get();
                                                        const commentsRepository = editor.plugins.get('CommentsRepository');
                                                        const commentThreadsData = commentsRepository.getCommentThreads( {
                                                            skipNotAttached: true,
                                                            skipEmpty: true,
                                                            toJSON: true
                                                        } );
                                                        $.ajaxSetup({
                                                            headers: {
                                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: 'POST',
                                                            url: 'http://localhost:8000/questions/answer/' + editor.sourceElement.id.substr(6) + '/deleteConversationThread',
                                                            data: {
                                                                conversation: JSON.stringify(commentThreadsData),
                                                                answerContent: editorData
                                                            },
                                                            success: function(data){
                                                                //
                                                            },
                                                            error: function(error){
                                                                //
                                                            }
                                                        });
                                                        console.log( `The comment thread with ID ${ threadId } has been removed.` );
                                                    }
                                                } );
                                            })
                                            .catch(error => console.error(error));
                                    }
                                </script>
                            @endforeach
                        </div>
                    </ol>
                    {{ $answers->links() }}   
                </div>
                <div id="related-posts">
                    <h2>Related questions</h2>
                    <ul class="related-posts">
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This Is My Second Poll Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my third Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my fourth Question</a></h3></li>
                        <li class="related-item"><h3><a href="#"><i class="icon-double-angle-right"></i>This is my fifth Question</a></h3></li>
                    </ul>
                </div>
                <div id="respond" class="comment-respond page-content clearfix">
                    <div class="boxedtitle page-title"><h2>Leave an answer</h2></div>
                    <form action="{{ route('answers.store', $question->id) }}" method="post" id="post-answer" class="comment-form" enctype="multipart/form-data">
                        @csrf
                        <div id="respond-textarea">
                            <p>
                                <label class="required" for="comment"><i class="icon-double-angle-right"></i> Body<span>*</span></label>
                                <div class="ckeditor-container">
                                    <div id="answer-editor"></div>
                                    <div id="answer-sidebar" class="ckeditor-sidebar"></div>
                                </div> 
                            </p>
                            <br>
                            <div>
                                <p>
                                    <label class="required"><i class="icon-double-angle-right"></i> Images</label>
                                    <br>
                                    <input type="file" name="images[]" accept="image/x-png,image/gif,image/jpeg,image/jpg" multiple>
                                </p>
                                <p>
                                    <label class="required"><i class="icon-double-angle-right"></i> Audios</label>
                                    <br>
                                    <input type="file" name="medias[]" accept="audio/mp3,audio/ogg,audio/wav" multiple>
                                </p>
                            </div>
                        </div>
                        <br>
                        <p class="form-submit">
                            @if (Auth::check())
                                <input id="post-answer-button" type="submit" value="Post your answer" class="button small color">
                            @else
                                <input type="submit" value="Post your answer" class="button small color" onclick="event.preventDefault(); window.location.href='http://localhost:8000/login'">
                            @endif   
                        </p>
                    </form>
                </div>
            </div>
            <aside class="col-md-4 sidebar">
                <div class="widget">
                    <h3 class="widget_title">IPA Tool</h3>
                    <form method="post" enctype="application/x-www-form-urlencoded" action="#">
                        <input type="text" name="resultview" class="resvew" style="font-size: 16px">
                        <div id="formcontent">
                            <input type="text" id="result" class="res"/>
                            <input type="text" id="resultweb" class="res"/>
                        </div>
                        <div class="typewriter">
                            <script type="text/javascript">
                                for(j = 0, z = 1; j < 1; j++, z = z + 10) {
                                    for (i = 1, k = z; i < 5; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"vowel\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    for (i = 5; i < 7; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"dipth\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    for (i = 7; i < 9; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"stress\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    document.write('<br/>');
                                }
                                for (j = 1, z = 11; j < 3; j++, z = z + 10) {
                                    for (i = 1, k = z; i < 5; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"vowel\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    for (i = 5; i < 8; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"dipth\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    document.write('<br/>');
                                }
                                for (j = 3, z = 31; j < 6; j++, z = z + 10) {
                                    for (i = 1, k = z; i < 9; i++, k++) {
                                        p = k % 10;
                                        document.write('<input type=\"button\" class=\"vowel\" onclick=\"javascript:chooseMe(' + k + ');\" value=\"' + buttonCaption(ipaCode[j][p]) + '\"/> ');
                                    }
                                    document.write('<br/>');
                                }
                            </script>
                            <br/>
                            <input type="button" onclick="clearOne();" class="buact" value="Delete"/>
                            <input type="button" onclick="addSpace();" class="buact" value="Space"/>
                            <input type="button" onclick="clearAll();;" class="buact" value="Reset"/>
                            <br/><br/>
                        </div>
                    </form>
                </div>
                <div class="widget">
                    <h3 class="widget_title">Voice Recorder Tool</h3>
                    <div id='gUMArea'>
                        <button class="btn btn-default" id='gUMbtn'>Request Voice Recorder</button>
                    </div>
                    <div id="record">
                        <div id='btns'>
                            <button class="btn btn-default" id='start'>Start</button>
                            <button class="btn btn-default" id='stop'>Stop</button>
                        </div>
                        <div id="img-block">
                            <img id="gif" src="{{ asset('images/recording.gif') }}" alt="">
                        </div>
                    </div>
                    <div id="save">
                        <ul class="list-unstyled" id='ul'></ul>
                    </div>
                </div>
                <div class="widget widget_tag_cloud">
                    <h3 class="widget_title">Hottest Tags</h3>
                    <a href="#">projects</a>
                    <a href="#">Portfolio</a>
                    <a href="#">Wordpress</a>
                    <a href="#">Html</a>
                    <a href="#">Css</a>
                    <a href="#">jQuery</a>
                    <a href="#">2code</a>
                    <a href="#">vbegy</a>
                </div>
            </aside>
        </div>
    </section>
    <script src="{{ asset('js/editorInQuestionDetailsPage.js') }}"></script>
    <script>
        document.querySelectorAll('.ck-label').forEach(function (a) {
            a.remove();
        })
    </script>
@endsection
