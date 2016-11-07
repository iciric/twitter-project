document.addEventListener("DOMContentLoaded", function () {

    // JavaScript form validation

    var checkString = function (str) {
        var re = /^\w+.{3,}$/;
        return re.test(str);
    };

    var checkForm = function (e) {
        if (!checkString(this.title.value)) {
            document.getElementById("titleError").innerHTML =
                "Title must contain at least 4 characters, which are only letters and numbers!";
            this.title.focus();
            e.preventDefault();
            return;
        }

        if (!checkString(this.tags.value)) {
            document.getElementById("tagError").innerHTML =
                "List of tags must contain at least 4 characters, which are only letters and numbers!";
            this.tags.focus();
            e.preventDefault();
            return;
        }
    };

    var myForm = document.getElementById("upload-photo");
    myForm.addEventListener("submit", checkForm, true);

}, false);