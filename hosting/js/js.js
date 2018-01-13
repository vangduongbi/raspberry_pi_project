

$(document).ready(function() {
    // function to call php file to change status in json file
    $(".control").click(function() {
        // alert('ok')
        var id = $(this).data('id');
        var value = $(this).data('value');
        $.ajax({
            type: "GET",
            url: './controller/change_status.php',
            data: {
                "id": id,
                "value": value
            },
            success: function(html) {
                if (value == 1) {
                    $("#dv-" + id).text("ON");
                    $("#dv-" + id).show();
                } else {
                    $("#dv-" + id).text("OFF");
                    $("#dv-" + id).show();
                }
            }

        })
    });

    // $("#temp_txt").load("modules/read_temp.php");
    var refreshId = setInterval(function() {
        $("#temp_txt").load('controller/read_temp.php');
    //  $("#dv-3").load("check_status/check_status.php");
    //  $("#dv-4").load("check_status/check_status_maylanh.php");
    }, 2000);

    $.ajaxSetup({
        cache: false
    });

    $("#off-btn5").click(function() {
        alert('ok')
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "offauto.php", true);
        xhttp.send();
        $("#dv-5").text("OFF AUTO");
        $("#dv-5").show();
    });

});

