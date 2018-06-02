$(document).ready(function () {

    $('button').on('click',function(event){

        event.preventDefault();

        var tr1 = $(this).parent().parent();
        var idBid = tr1.attr("id");

        var driverBid = tr1.children().children('select[name="driver"]').val();
        var statusBid = tr1.children().children('select[name="status_new"]').val();


        $.ajax({
            type: "POST",
            url: $('form').attr('action'),
            data: {id:idBid,driver:driverBid,status:statusBid},
            success: function(data) {
                var obj = jQuery.parseJSON(data);

                if(obj.driver !== ""){
                    tr1.children('td[class="driver_td"]').html(driverBid);
                }else{

                }
                if(obj.status !== ""){
                    tr1.children('td[class="status_td"]').html(statusBid);
                }else{

                }
                alert(obj.driver+" "+obj.status);
            },
        });

    });

});