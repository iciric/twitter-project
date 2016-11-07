document.addEventListener("DOMContentLoaded", function () {

    // JavaScript form validation

    var checkName = function (str) {
        return str.length < 3;
    };

    var checkUsername = function (str) {
        var re = /^\w+.{4,}$/;
        return re.test(str);
    };

    var checkPassword = function (str) {
        var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
        return re.test(str);
    };

    var checkForm = function (e) {

        if (!checkName(this.fname.value)) {
            document.getElementById("firstNameError").innerHTML =
                "First name must have at least 3 characters, which are only letters and numbers!";
            this.fname.focus();
            e.preventDefault();
            return;
        }

        if (!checkName(this.lname.value)) {
            document.getElementById("lastNameError").innerHTML =
                "Last name must have at least 3 characters, which are only letters and numbers!";
            this.lname.focus();
            e.preventDefault();
            return;
        }

        if (!checkUsername(this.username.value)) {
            document.getElementById("usernameError").innerHTML =
                "Username name must have at least 5 characters, which are only letters and numbers!";
            this.username.focus();
            e.preventDefault();
            return;
        }

        if (this.password.value == this.cpassword.value) {
            if (!checkPassword(this.password.value)) {
                document.getElementById("passwordError").innerHTML =
                    "The password must contain at least 6 characters, 1 digit, 1 lowercase letter and 1 uppercase letter!";
                this.password.focus();
                e.preventDefault();
                return;
            }
        } else {
            document.getElementById("passwordError").innerHTML =
                "Error: Please check that entered passwords match!";
            this.password.focus();
            e.preventDefault();
            return;
        }

        if(parseInt(this.security.value) < 1113 || parseInt(this.security.value) > 1207) {
            document.getElementById("securityError").innerHTML =
                "Please re-enter security number.";
            this.security.focus();
            e.preventDefault();
            return;
        }
    };

    var myForm = document.getElementById("register-form");
    myForm.addEventListener("submit", checkForm, true);

}, false);