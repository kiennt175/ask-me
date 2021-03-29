$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var form = $('#update-profile');
    form.on('submit', function(e){
        e.preventDefault();
        var formData = new FormData($("#update-profile")[0]);
        formData.append('_method', 'PATCH'),
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formData,
            processData: false, // for multipart/form-data
            contentType: false, // for multipart/form-data
            success: function(data){
                $('#website-link').val(data.website_link);
                $(".name").html(data.name);
                tata.success('Profile', 'Update profile successfully!');
            },
            error: function(error){
                tata.error('Profile', 'Failed to update profile!');
            }
        });
    });
});
