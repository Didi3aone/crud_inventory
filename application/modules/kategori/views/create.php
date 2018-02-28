<?php
    $id                 = isset($item["kategori_produk_id"]) ? $item["kategori_produk_id"] : "";
    $name               = isset($item["kategori_name"]) ? $item["kategori_name"] : "";
    $btn_msg            = ($id == 0) ? "Create" : " Update";
    $header_title       = ($id == 0) ? "Input Kategori Baru" : " Edit Kategori";
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
                    <form class="smart-form" id="form-submits" action="<?= site_url('kategori/proccess_form') ?>" method="post">
                    	<?php if($id != 0) : ?>
                    		<input type="hidden" name="id" value="<?= $id ?>">
                    	<?php endif; ?>
                        <fieldset>
                            <div class="row">
                                <section>
                                    <label class="label">Nama Kategori <sup class="color-red">*</sup></label>
                                    <label class="input">
                                        <input type="text" name="name" value="<?= $name ?>">
                                    </label>
                                </section>
                            </div>     
                        </fieldset>

                        <footer>
                            <button type="submit" class="btn btn-primary"><?= $btn_msg ?></button>
                            <a href="<?= site_url('kategori') ?>" class="btn btn-danger">Cancel</a>
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