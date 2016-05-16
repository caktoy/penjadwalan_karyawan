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
                
                <form class="form-horizontal" role="form" action="<?php echo base_url().'index.php/kota/tambah_ubah_kota'; ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="provinsi"> Provinsi </label>

                            <div class="col-sm-5">
                                <div class="input-group">
                                    <select id="provinsi" name="provinsi" class="col-xs-10 col-sm-5 form-control" required>
                                        <?php foreach ($provinsi as $p) { ?>
                                        <option value="<?php echo $p->ID_PROVINSI; ?>"><?php echo $p->NAMA_PROVINSI; ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="input-group-btn">
                                            <a class="btn btn-sm btn-info" href="#tambahProvinsi" data-toggle="modal" role="button">
                                                    <i class="ace-icon fa fa-plus bigger-110"></i>
                                                    Tambah
                                            </a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="nama_kota"> Nama Kota </label>

                            <div class="col-sm-5">
                                <input type="hidden" id="id_kota" name="id_kota" class="col-xs-10 col-sm-5 form-control" value="<?php echo $id_kota; ?>" />
                                <input type="text" id="nama_kota" name="nama_kota" placeholder="Nama Kota" class="col-xs-10 col-sm-5 form-control" />
                            </div>
                        </div>
                    
                        <div class="col-md-offset-2 col-md-5">
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
                </form>
                
                <div class="col-md-12">&nbsp;</div>
                
                <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                </div>
                <div class="table-header">
                        Tabel Kota
                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Provinsi</th>
                                <th>Kota</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($kota as $k) { ?>
                            <tr>
                                <td>
                                    <span class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="javascript:void(0);" onclick="fill('<?php echo $k->ID_PROVINSI; ?>', '<?php echo $k->NAMA_PROVINSI; ?>')">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a href="<?php echo base_url().'index.php/kota/activate_provinsi/'.$k->ID_PROVINSI; ?>" onclick="return confirm('Anda yakin?');">
                                            <?php if($k->STATUS_PROVINSI == "Y") { ?>
                                            <i class="ace-icon fa fa-remove bigger-130 red"></i>
                                            <?php } else { ?>
                                            <i class="ace-icon fa fa-undo bigger-130 orange"></i>
                                            <?php } ?>
                                        </a>
                                    </span>
                                    <span class="<?php echo $k->STATUS_PROVINSI=="Y"?"green":"red"; ?>"><?php echo $k->NAMA_PROVINSI; ?></span>
                                </td>
                                <td><?php echo $k->NAMA_KOTA; ?></td>
                                <td><?php echo $k->STATUS=="Y"?"Aktif":"Non-Aktiv"; ?></td>
                                <td style="text-align: center;">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="javascript:void(0);" onclick="fill('<?php echo $k->ID_KOTA; ?>', '<?php echo $k->ID_PROVINSI; ?>', '<?php echo $k->NAMA_KOTA; ?>')">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a href="<?php echo base_url().'index.php/kota/activate_kota/'.$k->ID_KOTA; ?>" onclick="return confirm('Anda yakin?');">
                                            <?php if($k->STATUS == "Y") { ?>
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

<div id="tambahProvinsi" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header no-padding">
        <div class="table-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <span class="white">&times;</span>
          </button>
          Tambah Provinsi
        </div>
      </div>
      <form class='form-horizontal' role='form' action='<?php echo base_url()."index.php/kota/tambah_provinsi"; ?>' method='post' enctype="multipart/form-data">
            <div class='modal-body no-padding'>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="nama_prov_new"> Nama Provinsi </label>

                    <div class="col-sm-5">
                        <input type="text" id="nama_prov_new" name="nama_prov_new" placeholder="Nama Provinsi" class="col-xs-10 col-sm-5 form-control" />
                    </div>
                </div>
            </div>
            <div class='modal-footer no-margin-top'>
                <button class='btn btn-success btn-sm pull-left' type='submit' id="btn-simpan">
                    <i class='ace-icon fa fa-check'></i> Simpan
                </button>
                <button class='btn btn-sm btn-danger' data-dismiss='modal'>
                    <i class='ace-icon fa fa-times'></i> Tutup
                </button>&nbsp;
            </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
    function fill(id, prov, nama) {
        $("#id_kota").val(id);
        $("#provinsi").val(prov);
        $("#nama_kota").val(nama);
    }
</script>