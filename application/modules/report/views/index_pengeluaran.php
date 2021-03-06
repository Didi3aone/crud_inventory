<div id="content">
    <!-- widget grid -->
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title ?></h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2><?= $title ?> </h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>                         
                                    <tr>
                                        <th data-class="expand">Total Harga</th>
                                        <th data-class="expand">Produk Name</th>
                                        <th data-class="expand">Kategori/pcs</th>
                                        <th data-class="expand">Jumlah Produk</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <?php 
                                        $total = 0;
                                        $jml_produk = 0;
                                        foreach ($item as $key => $value) {
                                            $total += $value['total_harga'];
                                            $jml_produk +=$value['jumlah_item'];
                                        }
                                    ?>
                                    <th><b>Total Pengeluaran</b></th>
                                    <th><b><?= number_format($total) ?></b></th>
                                    <th colspan="1"></th>
                                    <th><b><?= $jml_produk ?></b></th>
                                </tfoot>
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                </div>
            </article>
        </div>
    </section>
</div>
<!-- end widget div -->