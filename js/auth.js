function login(e, form) {
    e.preventDefault(); // Prevent normal form submit

    let formData = $(form).serialize();

    $.ajax({
        type: "POST",
        url: "includes/login_db.php",
        data: formData,
        success: function(response) {
            if(response.trim() === "success") {
                // Redirect on successful login
                window.location.href = "index.php";
            } else {
                // Show error message
                $('#login-error').text(response).removeClass('d-none');
            }
        }
    });
}

function register(e, form) {
    e.preventDefault();

    // Simple client-side password match check
    let password = $(form).find('input[name="password"]').val();
    let rePassword = $(form).find('input[name="rePassword"]').val();

    if(password !== rePassword) {
        $('#register-error').text("Passwords do not match").removeClass('d-none');
        return;
    }

    let formData = $(form).serialize(); // serialize form fields

    $.ajax({
        type: "POST",
        url: "includes/register_db.php",
        data: formData,
        success: function(response) {
            if(response.trim() == "success") { 
                // Redirect on successful register
                window.location.href = "index.php";
            } else {
                // Show error message
                $('#register-error').text(response).removeClass('d-none');
            }
        }
    });
}

$(document).ready(function() {
    $('#login-form').submit(function(e) {
        login(e, this);
    });

    $('#register-form').submit(function(e) {
        register(e, this);
    });
});