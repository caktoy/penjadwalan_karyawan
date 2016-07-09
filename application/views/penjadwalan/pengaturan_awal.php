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
            <form id="form-setting" class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>penjadwalan/do">
                <div class="col-md-6">                        
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="tahun"> Tahun </label>

                        <div class="col-sm-9">
                            <input class="form-control" id="tahun" name="tahun" type="number" value="<?php echo $setting['tahun']; ?>" 
                                onchange="check_year(this.value)" required />
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="kerja"> Kerja per Periode (Minggu) </label>

                        <div class="col-sm-9">
                            <input type="number" id="kerja" name="kerja" class="col-xs-10 col-sm-5 form-control" min="1" max="100" 
                                value="<?php echo $setting['kerja']; ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="libur"> Libur per Periode (Minggu) </label>

                        <div class="col-sm-9">
                            <input type="number" id="libur" name="libur" class="col-xs-10 col-sm-5 form-control" min="1" max="100" 
                                value="<?php echo $setting['libur']; ?>" />
                        </div>
                    </div>
                
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-success" type="submit">
                            <i class="ace-icon fa fa-play bigger-110"></i>
                            Simpan & Jalankan
                        </button>
                        &nbsp; &nbsp; &nbsp;
                        <button class="btn btn-danger" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                        <button class="btn btn-info pull-right" id="btn-lihat" type="button">
                            <i class="ace-icon fa fa-eye bigger-110"></i>
                            Lihat
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function check_year(tahun) {
        var url = '<?php echo base_url()."penjadwalan/check_year"; ?>';
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", url, false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("tahun=" + tahun);
        var resp = xhttp.responseText;
        if(resp > 32)
            $("#btn-lihat").show();
        else
            $("#btn-lihat").hide();
        
        var isVisible = $("#btn-lihat").is(":visible");
        if(isVisible) {
            $("#form-setting").on("submit", function(){
                return confirm("Jadwal pada tahun " + tahun + " sudah pernah dilakukan proses penjadwalan." + 
                    "\nJika Anda melanjutkan proses ini, data sebelumnya akan terhapus dan digantikan dengan data baru." + 
                    "\n\nApakah Anda yakin akan melanjutkan proses ini?");
            });
        } else {
            $("#form-setting").on("submit", function(){});
        }
    }

    $(document).ready(function() {
        $("#btn-lihat").on("click", function() {
            var tahun = $("#tahun").val();
            window.location = "<?php echo base_url().'penjadwalan/lihat_jadwal/'; ?>" + tahun;
        });
    });
</script>