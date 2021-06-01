$(document).ready(function () {
    $('#question-search').on('keyup', function (e) {
        e.preventDefault()
        if ((e.key === 'Enter' || e.keyCode === 13)) {
            if ($('#question-search').val().trim()) {
                window.location.href = 'http://localhost:8000/questions/view/' + $('#question-search').val().trim() + '/newest#question-search';
            } else {
                window.location.href = 'http://localhost:8000/questions/view'
            } 
        }
    });
});
