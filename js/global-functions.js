//$(document).ready(function () {
   /*
    var ptmId = $('input[type=hidden]#ptmId').val();

    $('#btnDownload').click(function (){
        $.get("http://127.0.0.1/index/?path=",
            {
                path: "detail/download/" + ptmId,
            },
            function(data, status){
                var dataReceived = data.split("#");
                $("#DownloadCount").text("Downloaded " + dataReceived[1] + " times");
                window.location.href = dataReceived[0];
                //alert("Datah: " + dataReceived + "\nStatus: " + status);
            });
    })

    // $('#btnSearch').click(function (){
    //     var SearchString = $('input[type=text]#Search').val();
    //     //var movideData = new Array();n
    //
    //     $.get("http://127.0.0.1/index/?path=",
    //         {
    //             path: "search/getall/" + SearchString,
    //         },
    //         function(data, status){
    //             var movideData = $.parseJSON(data);
    //             alert("Data: " + movideData[0]['description'] + "\nStatus: " + status);
    //         }
    //         );
    // })

    $('img.voteOk').click(function () {

        $.get("http://127.0.0.1/index/?path=",
            {
                path: "detail/voteUp/" + ptmId,
            },
            function(data, status){
                $("#voteCount").text("Voted " + data + " times");
                $("#vtOK").hide();
                $("#vtNOTOK").hide();
                //alert("Datah: " + data + "\nStatus: " + status);
        });
    })

    $('img.voteNotOk').click(function () {

        $.get("http://127.0.0.1/index/?path=",
            {
                path: "detail/voteDown/" + ptmId,
            },
            function(data, status){
                $("#voteCount").text("Voted " + data + " times");
                $("#vtOK").hide();
                $("#vtNOTOK").hide();
                //alert("Datah: " + data + "\nStatus: " + status);
            });
    })

    // $('#editptmModal').click(function (){
    //     var movid = $(this).data('movid');
    //     $.get("http://127.0.0.1/index/?path=",
    //         {
    //             path: "admin/getptm/" + movid,
    //         },
    //         function(data, status){
    //             var dataReceived = data.split("#");
    //             $("#movid").text(dataReceived[0]);
    //             $("#title").text(dataReceived[1]);
    //             $("#year").text(dataReceived[2]);
    //         });
    // })

});

$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;
            });
        } else{
            checkbox.each(function(){
                this.checked = false;
            });
        }
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});

$(document).on("click", "a", function () {
    $("#id").val( $(this).data('id') );
    $("#name").val($(this).data('name'));
});

$(document).on("click", "a", function () {
    $("#comid").val( $(this).data('comid') );
    $("#user").val($(this).data('user'));
    $("#description").val($(this).data('description'));
});

$(document).on("click", "a", function () {
    $("#movid").val($(this).data('movid'));
    $("#title").val($(this).data('title'));
    $("#year").val($(this).data('year'));
});*/