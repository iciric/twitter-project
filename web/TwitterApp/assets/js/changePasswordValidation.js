document.addEventListener("DOMContentLoaded", function () {

    // JavaScript form validation

    var checkPassword = function (str) {
        var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}$/;
        return re.test(str);
    };

    var checkForm = function (e) {
        if (this.first.value == this.second.value) {
            if (!checkPassword(this.first.value)) {
                document.getElementById("passwordError").innerHTML =
                    "The password must contain at least 6 characters, 1 digit, 1 lowercase letter and 1 uppercase letter!";
                this.first.focus();
                e.preventDefault();
                return;
            }
        } else {
            document.getElementById("passwordError").innerHTML =
                "Error: Please check that entered passwords match!";
            this.first.focus();
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

    var myForm = document.getElementById("change-pwd-form");
    myForm.addEventListener("submit", checkForm, true);

}, false);