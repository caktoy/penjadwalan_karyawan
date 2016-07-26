<div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 12pt;padding-bottom: 40px;">
    <?php echo $judul; ?><br>
    <?php echo $subjudul; ?><br>
</div>

<table border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td>ID Teknisi</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->id_teknisi; ?></td>
    </tr>
    <tr>
        <td>Nama Teknisi</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->nama_teknisi; ?></td>
    </tr>
    <tr>
        <td>Jenis Kelamin</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->jenis_kelamin_teknisi; ?></td>
    </tr>
    <tr>
        <td>Tempat, Tanggal Lahir</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->kota_lahir.', '.date('d-m-Y', strtotime($teknisi[0]->tanggal_lahir_teknisi)); ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->alamat_teknisi; ?></td>
    </tr>
    <tr>
        <td>No. Telepon</td>
        <td>:</td>
        <td><?php echo $teknisi[0]->no_telp_teknisi; ?></td>
    </tr>
</table>
<br>

<table cellpadding="2" cellspacing="0" border="1" width="100%" id="dynamic-table" 
    class="table table-striped table-bordered table-hover" style="font-size: 6pt;">
    <thead>
        <tr style="font-weight: bold;">
            <th style="text-align: center;" rowspan="2">
                SITE
            </th>
            <th style="text-align: center;" colspan="52">
                MINGGU
            </th>
        </tr>
        <tr>
            <?php for ($i = 1; $i <= 52; $i++) : ?>
            <th style="text-align: center;">
                <?php echo $i; ?>
            </th>
            <?php endfor ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jadwal as $site => $tkn) : ?>
        <tr>
            <td style="text-align: center;"><?php echo $site; ?></td>
            <?php foreach ($tkn as $t) : ?>
            <td style="text-align: center;<?php if(strpos($t, $id_teknisi) !== false) { echo "background-color: #333333;"; } ?>">
                <span style="color: white;"><?php if(strpos($t, $id_teknisi) !== false) { echo "&nbsp;"; } ?></span>
            </td>
            <?php endforeach ?>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<!-- <pre><?php print_r($jadwal['Gresik 1']); ?></pre> -->
<?php if(isset($cetak)): ?>
<hr>
<form method="post" target="_blank" action="<?php echo $cetak; ?>">
    <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
    <input type="hidden" name="teknisi" value="<?php echo $id_teknisi; ?>">
    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
</form>
<?php endif ?>

<?php if (!isset($cetak)): ?>
<table border="0" width="100%" style="padding-top: 30px;">
    <tr>
        <td width="80%"></td>
        <td width="20%" style="text-align: center;font-size: 9pt;">
            Surabaya, <?php echo date('d-m-Y') ?><br><br><br><br><br>
            (_______________________)
        </td>
    </tr>
</table>
<?php endif ?>