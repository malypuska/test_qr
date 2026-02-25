$(document).ready(function () {
    $('#ok-btn').on('click', function (e) {
        var form = $('#url-form');
        var body_content = $('#body-content');
        var form_data = new FormData();
        
        e.preventDefault();
        
        form.find('input').each(function(i, e) {
            form_data.append($(e).attr('name'), $(e).val());
        });
        
        $.ajax({
            url: form.attr('action'),
            contentType: false,
            processData: false,            
            method: 'post',
            dataType: 'html',
            data: form_data,
            success: function (html) {
                body_content.html(html);
            }
        });
    });
})

