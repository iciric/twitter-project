document.addEventListener("DOMContentLoaded", function () {

    // JavaScript form validation

    var checkString = function (str) {
        var re = /^\w+.{3,}$/;
        return re.test(str);
    };

    var checkForm = function (e) {
        if (!checkString(this.galleryTitle.value)) {
            document.getElementById("titleError").innerHTML =
                "Title must contain at least 4 characters, which are only letters and numbers!";
            this.galleryTitle.focus();
            e.preventDefault();
            return;
        }

        if (!checkString(this.galleryTag.value)) {
            document.getElementById("tagError").innerHTML =
                "Gallery tag must contain at least 4 characters, which are only letters and numbers!";
            this.galleryTag.focus();
            e.preventDefault();
            return;
        }
    };

    var myForm = document.getElementById("create-gallery-form");
    myForm.addEventListener("submit", checkForm, true);

}, false);