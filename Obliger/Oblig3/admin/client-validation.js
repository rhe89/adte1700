var firstPassword, lastPassword;

var nameInput = $('#name');
var usernameInput = $("#username");
var passwordInput = $("#password");
var repeatPasswordInput = $("#passwordRepeat");


nameInput.change(function() {
    checkName();
});

usernameInput.change(function() {
    checkUsername();
});

passwordInput.change(function() {
    checkPassword();
});

repeatPasswordInput.change(function() {
    checkRepeatedPassword();
});


function checkName() {
    var name = document.form.name.value;

    var regEx = /^[A-Za-z ]{5,30}$/;

    var nameOk = regEx.test(name);

    if (name.length != 0) $(".name-message-empty").css("display", "none");

    if (!nameOk) {
        $(".name-message-length").css("display", "inline-block")
        return false;
    }
    else {
        $(".name-message-length").css("display", "none")
        return true;
    }

}
function checkUsername() {
    var username = document.form.username.value;

    var regEx = /^[A-Za-z0-9]{5,30}$/;

    var usernameOk = regEx.test(username);

    if (username.length != 0) $(".username-message-empty").css("display", "none");

    if (!usernameOk) {
        $(".username-message-length").css("display", "inline-block");
        return false;
    }
    else {
        $(".username-message-length").css("display", "none");
        return true;
    }
}

function checkPassword() {
    var password = document.form.password.value;

    if (lastPassword != null) {
        if (password != lastPassword) {
            $(".password-message-no-match").css("display", "inline-block");
            return false;
        }
        else $(".password-message-no-match").css("display", "none");
    }

    var regEx = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;

    var passwordOk = regEx.test(password);

    if (password.length != 0) $(".password-message-empty").css("display", "none");

    if (!passwordOk) {
        $(".password-message-length").css("display", "inline-block");
        return false;
    }
    else {
        $(".password-message-length").css("display", "none");
        firstPassword = password;
        return true;
    }
}

function checkRepeatedPassword() {
    var password = document.form.passwordRepeat.value;

    if (firstPassword != null) {
        if (password != firstPassword) {
            $(".password-message-no-match").css("display", "inline-block");
            return false;
        }
        else $(".password-message-no-match").css("display", "none");
    }

    var regEx = /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;

    var passwordOk = regEx.test(password);

    if (password.length != 0) $(".repeat-password-message-empty").css("display", "none");

    if (!passwordOk) $(".repeat-password-message-length").css("display", "inline-block");
    else {
        lastPassword = password;
        $(".repeat-password-message-length").css("display", "none");
        return true;
    }
}

function validateInput() {
    var name = document.form.name.value;
    var username = document.form.username.value;
    var password = document.form.password.value;
    var repeatPassword = document.form.passwordRepeat.value;

    if (name.length == 0) {
        $(".name-message-empty").css("display", "inline-block");
        return false;
    } else {
        $(".name-message-empty").css("display", "none");
    }

    if (username.length == 0) {
        $(".username-message-empty").css("display", "inline-block");
        return false;
    } else {
        $(".username-message-empty").css("display", "none");
    }

    if (password.length == 0) {
        $(".password-message-empty").css("display", "inline-block");
        return false;
    } else {
        $(".password-message-empty").css("display", "none");
    }

    if (repeatPassword.length == 0) {
        $(".repeat-password-message-empty").css("display", "inline-block");
        return false;
    } else {
        $(".repeat-password-message-empty").css("display", "none");
    }

    return (checkName() && checkUsername() && checkPassword() && checkRepeatedPassword());

}