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
                <h3 class="header smaller lighter blue">Master Teknisi</h3>
                
                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url().'index.php/teknisi/tambah_ubah' ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="id"> ID Teknisi </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="id" name="id" placeholder="ID Teknisi" class="col-xs-10 col-sm-5 form-control" value="<?php echo $id_teknisi; ?>" readonly />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="nama"> Nama Teknisi </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="nama" name="nama" placeholder="Nama Teknisi" class="col-xs-10 col-sm-5 form-control" required />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="alamat"> Alamat Teknisi </label>

                                    <div class="col-sm-9">
                                        <textarea id="alamat" name="alamat" placeholder="Alamat Teknisi" class="col-xs-10 col-sm-5 form-control"></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="telp"> No. Telepon </label>

                                    <div class="col-sm-9">
                                        <input type="text" id="telp" name="telp" placeholder="No. Telepon" class="col-xs-10 col-sm-5 form-control" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right" for="jk"> Jenis Kelamin </label>

                                    <div class="col-sm-9">
                                        <select id="jk" name="jk" class="col-xs-10 col-sm-5 form-control">
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="tmp_lahir"> Tempat Lahir </label>

                                        <div class="col-sm-9">
                                            <select id="tmp_lahir" name="tmp_lahir" class="col-xs-10 col-sm-5 form-control">
                                                <?php foreach($kota as $k) { ?>
                                                <option value="<?php echo $k->ID_KOTA ?>"><?php echo $k->NAMA_KOTA ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="tgl_lahir"> Tanggal Lahir </label>

                                        <div class="col-sm-9">
                                            <input class="form-control" id="tgl_lahir" name="tgl_lahir" type="date" />
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="agama"> Agama </label>

                                        <div class="col-sm-9">
                                            <select id="agama" name="agama" class="col-xs-10 col-sm-5 form-control">
                                                <option>Islam</option>
                                                <option>Kristen</option>
                                                <option>Katolik</option>
                                                <option>Hindu</option>
                                                <option>Budha</option>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="email"> Email </label>

                                        <div class="col-sm-9">
                                            <input type="email" id="email" name="email" placeholder="Email" class="col-xs-10 col-sm-5 form-control" />
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
                        Tabel Teknisi
                </div>

                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Teknisi</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No. Telepon</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Agama</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($teknisi as $t) { ?>
                                    <tr>
                                        <td><?php echo $t->ID_TEKNISI; ?></td>
                                        <td><?php echo $t->NAMA_TEKNISI; ?></td>
                                        <td><?php echo $t->ALAMAT_TEKNISI; ?></td>
                                        <td><?php echo $t->NO_TELP_TEKNISI; ?></td>
                                        <td><?php echo $t->JENIS_KELAMIN_TEKNISI; ?></td>
                                        <td><?php echo $t->NAMA_KOTA . ', ' . date('d-m-Y', strtotime($t->TANGGAL_LAHIR_TEKNISI)); ?></td>
                                        <td><?php echo $t->AGAMA_TEKNISI; ?></td>
                                        <td><?php echo $t->EMAIL_TEKNISI; ?></td>
                                        <td><?php echo $t->STATUS=="Y"?"Aktif":"Non-Aktiv"; ?></td>
                                        <td style="text-align: center;">
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="green" href="javascript:void(0);" onclick="edit('<?php echo $t->ID_TEKNISI; ?>')">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>
                                                <a href="<?php echo base_url().'index.php/teknisi/activate/'.$t->ID_TEKNISI; ?>" onclick="return confirm('Anda yakin?');">
                                                    <?php if($t->STATUS == "Y") { ?>
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
    function edit(id) {
        $.ajax({
            url: '<?php echo base_url().'index.php/teknisi/detil' ?>';
            dataType: 'json',
            type: 'post',
            data: {'id': id},
            success: function(result) {
                var teknisi = result[0];
                $("#id").val(teknisi.ID_TEKNISI);
                $("#nama").val(teknisi.NAMA_TEKNISI);
                $("#alamat").val(teknisi.ALAMAT_TEKNISI);
                $("#telp").val(teknisi.NO_TELP_TEKNISI);
                $("#jk").val(teknisi.JENIS_KELAMIN_TEKNISI);
                $("#tmp_lahir").val(teknisi.ID_KOTA);
                $("#agama").val(teknisi.AGAMA_TEKNISI);
                $("#email").val(teknisi.EMAIL_TEKNISI);
            },
            error: function(xhr, status, error) {
                console.log(error);
                alert("Gagal!");
            }
        });
    }
</script>
