$('.login-btn').click(function (e) {
    e.preventDefault();

    let login = $('input[name="login"]').val(),
        password = $('input[name="password"]').val();

    $.ajax({
        url: 'appAjax/registryAjax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
        },

        success(data) {
            if (data.status) {
                if (data.user === 'admin') {
                    document.location.href = 'admin/admin.php';
                } else if (data.user === 'student') {
                    document.location.href = 'user/user.php';
                } else if (data.user === 'admin') {
                    document.location.href = 'teacher/teacher.php';
                }
            } else {
                $('.error_msg').text(data.message);
            }
        }
    });

});
