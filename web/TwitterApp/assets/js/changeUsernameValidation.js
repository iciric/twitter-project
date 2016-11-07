document.addEventListener("DOMContentLoaded", function () {

    // JavaScript form validation

    var checkUsername = function (str) {
        var re = /^\w+.{4,}$/;
        return re.test(str);
    };

    var checkForm = function (e) {
        if (this.first.value == this.second.value) {
            if (!checkUsername(this.first.value)) {
                document.getElementById("usernameError").innerHTML =
                    "The username must contain at least 5 characters, which are only letters and numbers!";
                this.first.focus();
                e.preventDefault();
                return;
            }
        } else {
            document.getElementById("usernameError").innerHTML =
                "Error: Please check that entered usernames match!";
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

    var myForm = document.getElementById("change-username-form");
    myForm.addEventListener("submit", checkForm, true);

}, false);