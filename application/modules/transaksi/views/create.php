<?php
    $id            = isset($item["transaksi_id"]) ? $item["transaksi_id"] : "";
    $transaksi_type_id            = isset($item["transaksi_type_id"]) ? $item["transaksi_type_id"] : "";
    $produk_id     = isset($item['produk_id']) ? $item['produk_id'] : "";
    $produk_name   = isset($item["produk_name"]) ? $item["produk_name"] : "";
    $price         = isset($item['transaksi_harga']) ? $item['transaksi_harga'] : "";
    $customer_id   = isset($item['customer_id']) ? $item['customer_id'] : "";
    $customer      = isset($item['customer_name']) ? $item['customer_name'] : "";
    $jumlah 	   =  isset($item['jumlah_item']) ? $item['jumlah_item'] : "";
    // print_r($jumlah);exit;
    $btn_msg       = ($id == 0) ? "Create" : " Update";
    $header_title  = ($id == 0) ? "Input Transaksi Baru" : " Edit Transaksi";
?>

<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">
            <h1 class="page-title txt-color-blueDark"><?= $title_page ?></h1>
        </div>
    </div>

    <section id="widget-grid" class="">
        <article>
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-pencil-square-o"></i> </span>
                    <h2><?= $header_title; ?></h2>
                </header>

                <!-- FORM FIELDS -->
                <div>
                    <form class="smart-form" id="form-submits" action="<?= site_url('transaksi/proccess_form') ?>" method="post">
                    	<?php if($id != 0) : ?>
                    		<input type="hidden" name="id" value="<?= $id ?>">
                    	<?php endif; ?>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <label class="label">Pilih Produk <sup class="color-red">*</sup></label>
                                    <label class="select">
                                        <?php if($produk_id != "") : ?>
                                        <select name="prod_id" id="prod_id" style="width: 100%;">
                                            <option selected value="<?= $produk_id?>"><?= $produk_name ?></option>
                                        </select>
                                            <?php else: ?>
                                        <select name="prod_id" id="prod_id"></select>
                                        <?php endif; ?>
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="label">Price <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input type="number" name="harga" value="<?= $price ?>">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="label">Jumlah item <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input type="number" name="jumlah" value="<?= $jumlah ?>">
                                    </label>
                                </section>
                            </div>     
                            <div class="row">
                                <section class="col col-6">
                                    <label class="label">Transaksi Type</label>
                                    <label class="input">
                                        <select name="type_id" style="width: 100%;" class="form-control">
                                            <option value=""> -- Pilih Tipe --</option>
                                            <option value="1"> Pengeluaran </option>
                                            <option value="2"> Pemasukan </option>
                                        </select>
                                    </label>
                                </section>

                                <section class="col col-6">
                                    <label class="label">Pilih Customer <sup class="color-red">*</sup></label>
                                    <label class="select">
                                        <?php if($customer != "") : ?>
                                        <select name="cust_id" id="cust_id" style="width: 100%;">
                                            <option selected value="<?= $customer_id?>"><?= $customer ?></option>
                                        </select>
                                            <?php else: ?>
                                        <select name="cust_id" id="cust_id"></select>
                                        <?php endif; ?>
                                    </label>
                                </section>
                            </div>
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary"><?= $btn_msg ?></button>
                            <a href="<?= site_url('transaksi') ?>" class="btn btn-danger">Cancel</a>
                        </footer>

                        <!-- HIDDEN FIELDS -->
                        <input type="hidden" name="id" value="<?= $id ?>" />
                    </form>
                </div>
                <!-- END OF FORM FIELDS -->
            </div>
        </article>
    </section>
</div>