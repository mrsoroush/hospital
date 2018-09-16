

$('#refresh-captcha').on('click', function(e){
    e.preventDefault();
    $('#signup-captcha').yiiCaptcha('refresh');
});
