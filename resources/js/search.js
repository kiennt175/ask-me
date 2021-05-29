$(document).ready(function () {
    $('#search').on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: 'http://localhost:8000/search',
                data: {
                    textSearch: $('#search').val().trim()
                },
                success: function(data){
                    
                },
                error: function(error){
                    
                }
            });
        }
    });
});
