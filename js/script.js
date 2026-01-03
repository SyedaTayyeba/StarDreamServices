//this file is for subscription for getting updates on email
$(document).ready(function() {
    $("#sendRequest").click(function(e) {
        e.preventDefault(); // prevent page reload

        var email = $("#userEmail").val();
        if(email === ""){
            alert("Please enter your email!");
            return;
        }

        $.ajax({
            url: "php/subscribe.php", // backend path
            type: "POST",
            data: { email: email },
            dataType: "json",
            success: function(res){
                alert(res.message);
                if(res.status === "success"){
                    $("#userEmail").val(""); // clear input
                }
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText);
                alert("Something went wrong! Check console for error.");
            }
        });
    });
});
