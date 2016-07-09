<div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 14pt;padding-bottom: 40px;">
    <?php echo $judul; ?><br>
    <?php echo $subjudul; ?>
</div>
<?php if(count($sites) > 0): ?>

<?php if(isset($cetak)): ?>
<div class="clearfix">
        <div class="pull-right tableTools-container"></div>
</div>
<div class="table-header">
    <?php echo $judul; ?>
</div>
<?php endif ?>

<table cellpadding="2" cellspacing="0" border="1" width="100%" id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
        <tr style="font-weight: bold;">
            <th rowspan="2" style="text-align: center;">
                TANGGAL
            </th>
            <?php foreach($sites as $site): ?>
            <th colspan="2" style="text-align: center;">
                <?php echo $site->nama_site; ?>
            </th>
            <?php endforeach ?>
        </tr>
        <tr>
            <?php foreach($sites as $site): ?>
            <th style="text-align: center;">
                <?php echo isset($cetak)?'TEKNISI':'TEKN.'; ?>
            </th>
            <th style="text-align: center;">
                <?php echo isset($cetak)?'KETERANGAN':'KET.'; ?>
            </th>
            <?php endforeach ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($presensi as $p): ?>
        <tr>
            <?php foreach($p as $key => $value): ?>
            <?php 
            if(strpos($value, ';') !== false) {
                $arr_value = explode(';', $value);
                $tampil = '';
                $idx_val = 0;
                foreach ($arr_value as $val) {
                    if($val == 'H') 
                        $tampil .= '<span class="label label-success">Hadir</span>';
                    else if($val == 'S')
                        $tampil .= '<span class="label label-purple">Sakit</span>';
                    else if($val == 'I')
                        $tampil .= '<span class="label label-warning">Izin</span>';
                    else if($val == 'A')
                        $tampil .= '<span class="label label-danger">Alpha</span>';
                    else if($val == 'C')
                        $tampil .= '<span class="label label-info">Cuti</span>';
                    else
                        $tampil = null;

                    $idx_val++;
                    if($idx_val < count($arr_value)) {
                        if(!isset($cetak))
                            $tampil .= ', ';
                        else
                            $tampil .= ' ';
                    }
                }
            } else {
                if($value == 'H') 
                    $tampil = '<span class="label label-success">Hadir</span>';
                else if($value == 'S')
                    $tampil = '<span class="label label-purple">Sakit</span>';
                else if($value == 'I')
                    $tampil = '<span class="label label-warning">Izin</span>';
                else if($value == 'A')
                    $tampil = '<span class="label label-danger">Alpha</span>';
                else if($value == 'C')
                    $tampil = '<span class="label label-info">Cuti</span>';
                else
                    $tampil = $value;
            }
            ?>
            <td style="text-align: center;"><?php echo $tampil; ?></td>
            <?php endforeach ?>
        </tr>
        <?php endforeach ?>
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
<?php else: ?>
<p>Maaf, Tidak ada data yang ditampilkan.</p>
<?php endif ?>

<p style="font-style: italic;"> Keterangan:
    <ul>
    <?php foreach ($teknisi as $tek) : ?>
        <li><?php echo $tek->id_teknisi; ?>: <?php echo $tek->nama_teknisi; ?></li>
    <?php endforeach ?>
    </ul>
</p>

<?php if(isset($cetak)): ?>
<hr>
<form method="post" action="<?php echo $cetak; ?>">
    <input type="hidden" name="awal" value="<?php echo $awal; ?>">
    <input type="hidden" name="akhir" value="<?php echo $akhir; ?>">
    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-print"></i> Cetak PDF</button>
</form>
<?php endif ?>