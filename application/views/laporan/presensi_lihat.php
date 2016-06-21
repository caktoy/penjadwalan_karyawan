<div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 14pt;padding-bottom: 40px;">
    <?php echo $judul; ?><br>
    <?php echo $subjudul; ?><br>
    <?php echo "Masa Kerja: ".($periode->days + 1)." Hari"; ?>
</div>
<table cellpadding="2" cellspacing="0" border="1" width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr style="font-weight: bold;">
            <th style="text-align: center;">
                NO
            </th>
            <th style="text-align: center;">
                NAMA
            </th>
            <th style="text-align: center;">
                HADIR
            </th>
            <th style="text-align: center;">
                SAKIT
            </th>
            <th style="text-align: center;">
                IZIN
            </th>
            <th style="text-align: center;">
                ALPHA
            </th>
            <th style="text-align: center;">
                CUTI
            </th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($presensi) > 0) : ?>
        <?php $no=1; foreach ($presensi as $p) : ?>
        <tr>
            <td style="text-align: right;">
                <?php echo $no; ?>.
            </td>
            <td>
                <?php echo $p->nama; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $p->hadir; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $p->sakit; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $p->izin; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $p->alpha; ?>
            </td>
            <td style="text-align: center;">
                <?php echo $p->cuti; ?>
            </td>
        </tr>
        <?php $no++; ?>
        <?php endforeach ?>
        <?php else : ?>
        <tr>
            <td colspan="7" style="text-align: center;">Maaf, tidak ada data yang ditampilkan.</td>
        </tr>
        <?php endif ?>
    </tbody>
</table>
<?php if(!isset($cetak)): ?>
<table border="0" width="100%" style="padding-top: 30px;">
    <tr>
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%"></td>
        <td width="25%" style="text-align: center;">
            Surabaya, <?php echo date('d-m-Y') ?><br><br><br><br><br>
            (_______________________)
        </td>
    </tr>
</table>
<?php endif ?>

<?php if(isset($cetak)): ?>
<hr>
<form method="post" target="_blank" action="<?php echo $cetak; ?>">
    <input type="hidden" name="awal" value="<?php echo $awal; ?>">
    <input type="hidden" name="akhir" value="<?php echo $akhir; ?>">
    <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
</form>
<?php endif ?>