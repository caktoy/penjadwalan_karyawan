<?php if (isset($_SESSION['pesan'])) { ?>
  <div class="alert alert-block alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert">
      <i class="ace-icon fa fa-times"></i>
    </button>
    <?php echo $this->session->flashdata('pesan'); ?>
  </div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <h3 class="header smaller lighter blue"><?php echo $judul; ?></h3>
        
        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url().'laporan/presensi/lihat'; ?>">
            <div class="col-md-6">                        
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="awal"> Tanggal Awal </label>

                    <div class="col-sm-4">
                        <input type="date" id="awal" name="awal" class="form-control" required />
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="akhir"> Tanggal Akhir </label>

                    <div class="col-sm-4">
                        <input type="date" id="akhir" name="akhir" class="form-control" required />
                    </div>
                </div>
            
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-primary" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        Submit
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <button class="btn btn-danger" type="reset">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        Reset
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>