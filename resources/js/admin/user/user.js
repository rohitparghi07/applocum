$(document).ready(function() {

    if (isUserValidationError ) {
        $('#modal-default').modal('show'); 
    }

    page_load();  

    //get data in pageload from storage and initialize table
    function page_load() {
        var table = $("#userTable").DataTable({
            responsive: true,
            paging: true,
            processing: true,
            serverSide: true,
            lengthMenu: [15],
            saveState: true,
            defaultContent: "-",
            bDestroy: true,
            ajax: {
                url: AdminUrl+"user/getUserDataTable",
                type: "get",
                dataType: "json",
                dataSrc: function(res) {
                    return res["data"];
                }
            },
            lengthChange: false,
            searching: true,
            info: true,
            autoWidth: false,
            language: {
                emptyTable: "No data available"
            },
            columns: [
                {
                    width: "5%",
                    data: "id",
                    orderable: true
                },
                {
                    width: "20%",
                    data: "fullname",
                    orderable: true
                },
              
                {
                    width: "13%",
                    data: "email",
                    orderable: true
                },   
                {
                    width: "10%",
                    data: "role",
                    orderable: true
                }        
             
            ],
            order: [[0, "desc"]],
        });
    }

});