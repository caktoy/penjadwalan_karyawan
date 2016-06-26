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

                <form class="form-horizontal" role="form" action="<?php echo base_url().'kota/tambah_ubah_kota'; ?>" method="post">
                        <div class="form-group">
                            <label class="col-sm-2 control-label no-padding-right" for="provinsi"> Provinsi </label>

                            <div class="col-sm-5">
                                <div class="input-group">
                                    <select id="provinsi" name="provinsi" class="col-xs-10 col-sm-5 form-control" required>
                                        <?php foreach ($provinsi as $p) { ?>
                                        <option value="<?php echo $p->id_provinsi; ?>"><?php echo $p->nama_provinsi; ?></option>
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
                                        <a class="green" href="#modal-provinsi" role="button" data-toggle="modal" 
                                            onclick="fill_provinsi('<?php echo $k->id_provinsi; ?>', '<?php echo $k->nama_provinsi; ?>', '<?php echo $k->status_provinsi; ?>')">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a href="<?php echo base_url().'index.php/kota/activate_provinsi/'.$k->id_provinsi; ?>" 
                                            onclick="return confirm('Anda yakin?\nInfo: Semua kota yang ada pada Provinsi <?php echo strtoupper($p->nama_provinsi); ?> juga akan dinon-aktifkan/diaktifkan.');">
                                            <?php if($k->status_provinsi == "Y") { ?>
                                            <i class="ace-icon fa fa-remove bigger-130 red"></i>
                                            <?php } else { ?>
                                            <i class="ace-icon fa fa-undo bigger-130 orange"></i>
                                            <?php } ?>
                                        </a>
                                    </span>
                                    <span class="<?php echo $k->status_provinsi=="Y"?"green":"red"; ?>"><?php echo $k->nama_provinsi; ?></span>
                                </td>
                                <td><?php echo $k->nama_kota; ?></td>
                                <td><?php echo $k->status=="Y"?"Aktif":"Non-Aktiv"; ?></td>
                                <td style="text-align: center;">
                                    <div class="hidden-sm hidden-xs action-buttons">
                                        <a class="green" href="javascript:void(0);" onclick="fill('<?php echo $k->id_kota; ?>', '<?php echo $k->id_provinsi; ?>', '<?php echo $k->nama_kota; ?>')">
                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                        </a>
                                        <a href="<?php echo base_url().'index.php/kota/activate_kota/'.$k->id_kota; ?>" onclick="return confirm('Anda yakin?');">
                                            <?php if($k->status == "Y") { ?>
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
      <form class='form-horizontal' role='form' action='<?php echo base_url()."kota/tambah_provinsi"; ?>' method='post' enctype="multipart/form-data">
            <div class='modal-body'>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="nama_prov_new"> Nama Provinsi </label>

                    <div class="col-sm-8">
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

<div id="modal-provinsi" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data" action="<?php echo base_url().'kota/ubah_provinsi'; ?>">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span class="white">&times;</span>
                        </button>
                        Ubah Provinsi
                    </div>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="id_provinsi-u" name="id_provinsi-u">
                    <input type="hidden" id="status-u" name="status-u">
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="nama_provinsi-u"> Nama Provinsi </label>

                        <div class="col-sm-8">
                            <input type="text" id="nama_provinsi-u" name="nama_provinsi-u" placeholder="Nama Provinsi" class="col-xs-10 col-sm-5 form-control" />
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success pull-left">
                        <i class="ace-icon fa fa-check"></i>
                        Simpan
                    </button>

                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Tutup
                    </button>
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

    function fill_provinsi(id, prov, status) {
        $("#id_provinsi-u").val(id);
        $("#nama_provinsi-u").val(prov);
        $("#status-u").val(status);
    }

    function load_provinsi(provinsi) {
        $.ajax({
            url: '<?php echo base_url()."kota/provinsi"; ?>',
            type: 'post',
            data: {'provinsi': provinsi},
            dataType: 'json',
            success: function(result) {
                var provinsi = result;
                console.log(provinsi);
            },
            error: function(xhr, error, status) {
                console.log(error);
            }
        });
    }

    $(document).ready(function() {
        $("#provinsi").change(function() {
            var provinsi = $(this).val();
            load_provinsi(provinsi);
        });
    });
</script>
