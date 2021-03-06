$(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var table = $("#dataTable");
    var url = "/crud_inventory/report/list_all_data";

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
                {"sTitle": "produk Name", "mData": "produk_name"},
                {"sTitle": "Total Harga", "mData": "tot"},
                {"sTitle": "Unit/pcs", "mData": "kategori_name"},
                {"sTitle": "Jumlah Produk", "mData": "jumlah_item"},
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