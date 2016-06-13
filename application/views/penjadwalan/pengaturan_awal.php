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
        <h3 class="header smaller lighter blue">Penjadwalan</h3>
        
        <div class="row">
            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>penjadwalan/save_setting">
                    <div class="col-md-6">                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="tahun"> Tahun </label>

                            <div class="col-sm-9">
                                <input class="form-control" id="tahun" name="tahun" type="number" min="<?php echo date('Y'); ?>" value="<?php echo $setting['tahun']; ?>" />
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="kerja"> Kerja per Periode (Minggu) </label>

                            <div class="col-sm-9">
                                <input type="number" id="kerja" name="kerja" class="col-xs-10 col-sm-5 form-control" min="0" max="100" value="<?php echo $setting['kerja']; ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="libur"> Libur per Periode (Minggu) </label>

                            <div class="col-sm-9">
                                <input type="number" id="libur" name="libur" class="col-xs-10 col-sm-5 form-control" min="0" max="100" value="<?php echo $setting['libur']; ?>" />
                            </div>
                        </div>
                    
                        <div class="col-md-offset-3 col-md-9">
                            <button class="btn btn-primary" type="submit">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Simpan
                            </button>

                            &nbsp;
                            <button class="btn btn-success" type="button" id="jalankan">
                                <i class="ace-icon fa fa-play bigger-110"></i>
                                Jalankan
                            </button>

                            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <button class="btn btn-danger" type="reset">
                                <i class="ace-icon fa fa-undo bigger-110"></i>
                                Reset
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#jalankan').click(function() {
            var tahun = $('#tahun').val();
            var kerja = $('#kerja').val();
            var libur = $('#libur').val();
            var url = '<?php echo base_url(); ?>penjadwalan/do/'+tahun+'/'+kerja+'/'+libur;
            window.location.href = url;
        });
    });
</script>