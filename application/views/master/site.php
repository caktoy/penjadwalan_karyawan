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
                <h3 class="header smaller lighter blue">Master Site</h3>
                
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url().'index.php/site/tambah_ubah'; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="id"> ID Site </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="id" name="id" placeholder="ID Site" class="col-xs-10 col-sm-5 form-control" value="<?php echo $id_site; ?>" readonly />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="nama"> Nama Site </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="nama" name="nama" placeholder="Nama Site" class="col-xs-10 col-sm-5 form-control" required />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="alamat"> Alamat Site </label>

                                    <div class="col-sm-9">
                                        <textarea id="alamat" name="alamat" placeholder="Alamat Site" class="col-xs-10 col-sm-5 form-control"></textarea>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="kota"> Kota Site </label>

                                        <div class="col-sm-9">
                                            <select id="kota" name="kota" class="col-xs-10 col-sm-5 form-control">
                                                <?php foreach($kota as $k) { ?>
                                                <option value="<?php echo $k->ID_KOTA ?>"><?php echo $k->NAMA_KOTA ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="provinsi"> Provinsi Site </label>

                                        <div class="col-sm-9">
                                            <input class="form-control" id="provinsi" name="provinsi" type="text" readonly />
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="telp"> No. Telepon </label>

                                        <div class="col-sm-9">
                                            <input type="text" id="telp" name="telp" placeholder="No. Telepon" class="col-xs-10 col-sm-5 form-control" />
                                        </div>
                                    </div>
                                
                                    <div class="col-md-offset-3 col-md-9">
                                            <button class="btn btn-success" type="submit">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Simpan
                                            </button>

                                            &nbsp; &nbsp; &nbsp;
                                            <button class="btn btn-danger" type="reset">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Batal
                                            </button>
                                    </div>
                            </div>
                        </div>
                </form>
                
                <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                        Tabel Site
                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID Site</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>No. Telepon</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($site as $s) { ?>
                            <tr>
                                <td><?php echo $s->ID_SITE; ?></td>
                                <td><?php echo $s->NAMA_SITE; ?></td>
                                <td><?php echo $s->ALAMAT_SITE; ?></td>
                                <td><?php echo $s->NAMA_KOTA; ?></td>
                                <td><?php echo $s->NO_TELP_SITE; ?></td>
                                <td><?php echo $s->STATUS=="Y"?"Aktif":"Non-Aktiv"; ?></td>
                                <td style="text-align: center;">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="javascript:void(0);" onclick="fill('<?php echo $s->ID_SITE; ?>')">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a href="<?php echo base_url().'index.php/site/activate/'.$s->ID_SITE; ?>" onclick="return confirm('Anda yakin?');">
                                            <?php if($s->STATUS == "Y") { ?>
                                            <i class="ace-icon fa fa-remove bigger-130 red"></i>
                                            <?php } else { ?>
                                            <i class="ace-icon fa fa-undo bigger-130 orange"></i>
                                            <?php } ?>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
        </div>
</div>

<script>
    $(document).ready(function() {
        var kota = $("#kota").val();
        getProvinsi(kota);
        
        $('#kota').change(function() {
            var kota = $(this).val();
            getProvinsi(kota);
        });
    });
    
    function getProvinsi(kota) {
        $.ajax({
            url: '<?php echo base_url()."index.php/kota/get_provinsi"; ?>',
            type: 'post',
            data: {'id': kota},
            dataType: 'html',
            success: function(result) {
                $("#provinsi").val(result);
            },
            error: function(xhr, status, error) {
                $("#provinsi").val(null);
                console.log(error);
            }
        });
    }
    
    function fill(id) {
        $.ajax({
            url: '<?php echo base_url()."index.php/site/detil"; ?>',
            type: 'post',
            data: {'id': id},
            dataType: 'json',
            success: function(result) {
                var site = result[0];
                $("#id").val(site.ID_SITE);
                $("#nama").val(site.NAMA_SITE);
                $("#alamat").val(site.ALAMAT_SITE);
                $("#kota").val(site.ID_KOTA);
                $("#telp").val(site.NO_TELP_SITE);
                
                getProvinsi(site.ID_KOTA);
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert("Gagal mengambil data!");
            }
        });
    }
</script>
