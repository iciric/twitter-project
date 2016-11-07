$(document).ready(function() {
    $("#editPhotoTags").hide();
    $("#comment-form").hide();

    $("#editTags").click(function() {
        $("#editPhotoTags").show();
        $("#comment-form").hide();
    });
    $("#commentPhoto").click(function() {
        $("#editPhotoTags").hide();
        $("#comment-form").show();
    });
    $("#closeEdit").click(function() {
        $("#editPhotoTags").hide();
        $("#comment-form").hide();
    });
});
