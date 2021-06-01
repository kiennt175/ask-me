$(document).ready(function () {
    const comments = $('.comments');
    comments.each(function () {
        var comment = $(this);
        comment.keypress(function (event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                if (currentUserId == 0) {
                    window.location.href = 'http://localhost:8000/login';
                } else {
                    if (comment.val().trim()) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: 'http://localhost:8000/questions/answer/' + comment.attr('id').replace('add-comment-answer-', '') + '/addComment',
                            data: {
                                comment: comment.val().trim()
                            },
                            success: function (data) {
                                var newComment = `<li class='comment' id='new-comment'><div class='comment-body clearfix'>`
                                    + `<div class='comment-avatar avatar'><img src='${currentUserAvatar || 'http://localhost:8000/images/default_avatar.png'}`
                                    + `'></div><div class='comment-text'><div class='author comment-info clearfix'><div class='comment-author comment-font-size'><a href='#'>`
                                    + currentUserName
                                    + `</a></div><div class='comment-meta'><div class='date comment-date'><i class='icon-time'></i>`
                                    + data.time
                                    + `</div></div></div><div class='text'><div class='comment-content'>`
                                    + comment.val().trim()
                                    + `</div></div></div></div></li>`
                                ;
                                $('#comment-for-answer-' + comment.attr('id').replace('add-comment-answer-', '')).before(newComment);
                                comment.val('');
                            },
                            error: function (error) {
    
                            }
                        });
                    }
                    else {
                        tata.error('Add Comment', 'The comment is empty!', {
                            duration: 5000,
                            animate: 'slide'
                        });
                    }
                }
            }
        });
    });
});
