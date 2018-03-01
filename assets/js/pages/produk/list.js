    $(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var table = $("#dataTable");
    var url = "/crud_inventory/produk/list_all_data";

    // Check if div exist
    if(table.length > 0) {
        $(table).dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" + "t" + "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            // "aaSorting": [[2, "desc"]],
            "iDisplayLength" : 50,
            "sPaginationType": "full_numbers",
            "bProcessing": false,
            "bServerSide": true,
            "bSortable" : true,
            "sAjaxSource": url,
            "aoColumns": [
                {"sTitle": "ID", "mData": "produk_id"},
                {"sTitle": "Nama Produk", "mData": "produk_name"},
                {"sTitle": "Unit/kategori", "mData": "kategori_name"},
                {
                    "sTitle" : "Action" , "sClass" : "center", "mData" : null,
                    "bSortable" : false,
                    "mRender" : function(data ,type, full) {

                        var button = '<td>';
                        button += '<a class="btn btn-primary btn-circle" href="/crud_inventory/produk/edit/' + full.produk_id + '" rel="tooltip" title="Edit Transaksi"><i class="fa fa-pencil"></i></a> &nbsp;';
                        button += '<a class="btn btn-danger btn-circle delete-confirm" href="javascript:askToDelete('+ full.produk_id +');" rel="tooltip" title="Delete Transaksi"><i class="fa fa-trash"></i></a> &nbsp;';
                        button += '</td>';
                        return button;
                    }
                }
            ],
            "preDrawCallback" : function() {
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dataTable'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_dt_basic.respond();
            }
        });
    }
});

var askToDelete = function(aid = null) {
        
    var url = "/crud_inventory/produk/delete";

    title = 'Delete Confirmation';
    content = 'Apakah anda yakin akan menghapus data ini ?';

    swal({
        title: "Delete Confirmation",
        text: content,
        type: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        animation: true,
        customClass: "",
    }).then(function () {

        //show loading.
        $('.loading').css("display", "block");

        //ajax post.
        $.ajax({
            type: "post",
            url: url,
            cache: false,
            data: {
                id: aid,
            },
            dataType: 'json',
            success: function(data) {
                //stop loading.
                if(data.is_error == true ) {
                   swal("Error!", data.error_msg, "error");
                } else {
                    //succes
                    $.smallBox({
                            title: '<strong>' + data['notif_title'] + '</strong>',
                            content: data['notif_message'],
                            color: "#659265",
                            iconSmall: "fa fa-check fa-2x fadeInRight animated",
                            timeout: 1000
                        }, function() {
                        //reload table
                        location.reload();                       
                    });
                }
            },
            error: function() {
                console.log("error");

                //stop loading.
                $('.loading').css("display", "none");
            }
        });
    }).catch(swal.noop);
}