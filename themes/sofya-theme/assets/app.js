var ppp = 5; // Post per page
var pageNumber = 1;

function load_posts() {
    pageNumber++;
    var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
    jQuery.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {
            var $data = data;
            if ($data.length) {
                jQuery("#ajax-posts").append($data);
                //$("#more_posts").attr("disabled",false); // Uncomment this if you want to disable the button once all posts are loaded
                //jQuery("#more_posts").hide(); // This will hide the button once all posts have been loaded
            } else {
                //jQuery("#more_posts").attr("disabled",true);
                jQuery("#more_posts").hide(); // This will hide the button once all posts have been loaded
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error");
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

jQuery("#more_posts").on("click", function () { // When btn is pressed.
    //jQuery("#more_posts").attr("disabled",true); // Disable the button, temp.
    load_posts();
    jQuery("#more_posts").insertAfter('#ajax-posts'); // Move the 'Load More' button to the end of the the newly added posts.
});

