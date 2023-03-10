$(document).ready(() => {

    let loginCheck = false;
    let passwordCheck = true;
    let passwordReiterationCheck = true;
    let emailCheck = true;

    let loginTemplate = /^[a-zA-Z][a-zA-Z0-9_\-\.]{1,19}$/;
    let passwordTemplate = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[_\-\.])[a-zA-Z][a-zA-Z0-9_\-\.]{1,19}$/;
    let emailTemplate = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;

    $('#login').blur(() => {

        let login = $('#login').val();
        console.log(login);

        if (loginTemplate.test(login)) {

            console.log('strong login');

            $.ajax({
                type: 'POST',
                url: '/mvc/remote-app0/authentication/ajax_check_login',
                data: 'login=' + login,
                success: function (res) {

                    console.log(res);
                    if (res == 'refused') {
                        
                        loginCheck = false;
                        $('#login-error').html('Already in use');
                    } else {
                        
                        loginCheck = true;
                        $('#login-error').html('');
                    }
                }
            })
        } else {

            console.log('weak login');
            $('#login-error').html('Weak login');
        }
    });


    $('#submit').click(() => {
        if (loginCheck && passwordCheck && passwordReiterationCheck && emailCheck) {
            
            $('#signing_up_form').attr('onsubmit', 'return true');
        } else {
            
            alert('Wrong inputs');
        }
    })
})