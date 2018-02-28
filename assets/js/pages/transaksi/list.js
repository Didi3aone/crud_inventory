    $(document).ready(function () {
    var responsiveHelper_dt_basic = undefined;

    var breakpointDefinition = {
        tablet : 1024,
        phone : 480
    };

    var table = $("#dataTable");
    var url = "/crud_inventory/transaksi/list_all_data";

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
                {"sTitle": "ID", "mData": "transaksi_id"},
                {"sTitle": "Transaksi Type", "mData": "transaksi_type_id"},
                {"sTitle": "Nama Customer", "mData": "customer_name"},
                {"sTitle": "produk Name", "mData": "produk_name"},
                {"sTitle": "Jumlah Produk", "mData": "jumlah_item"},
                {"sTitle": "Total Harga", "mData": "total_harga"},
                {"sTitle": "Tanggal Transaksi", "mData": "transaksi_tanggal"},
                {"sTitle": "Action", "mData": null},
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