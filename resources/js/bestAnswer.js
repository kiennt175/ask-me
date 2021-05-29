$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const buttons = $('.best-answer');
    buttons.each(function() {
        var button = $(this);
        button.on('click', function(e){
            cuteAlert({
                type: "question",
                title: "Best Answer",
                message: "Choose this for the best answer?",
                confirmText: "Yes",
                cancelText: "Cancel"
            }).then((e)=>{
                if ( e == ("confirm")) {
                    console.log(button)
                    $.ajax({
                        type: "PATCH",
                        url: 'http://localhost:8000/questions/' + questionId + '/bestAnswer',
                        data: {
                            answerId: button.attr('id').replace('best-answer-', '')
                        },
                        success: function(data){
                            window.location.reload()
                        },
                        error: function(error){
                            
                        }
                    });
                } else {
                }
            })
        });
    });
});
