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
            dataType: "JSON",
            data: {id:idBid,driver:driverBid,status:statusBid},
            success: function() {
                if(statusBid){
                    tr1.children('td[class="status_out"]').html(statusBid);
                }
                alert(statusBid);
            },
        });

    });

});