<div style="display: block;width: 100%;text-align: center;font-weigth: bold;font-size: 12pt;padding-bottom: 40px;">
    <?php echo $judul; ?><br>
    <?php echo $subjudul; ?><br>
</div>
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
    		<td style="text-align: center;"><?php print_r($site); ?></td>
    		<?php foreach ($tkn as $t) : ?>
    			<td style="text-align: center;"><?php echo $t; ?></td>
    		<?php endforeach ?>
    	</tr>
    	<?php endforeach ?>
    </tbody>
</table>

<table border="0" width="100%" style="padding-top: 30px;">
    <tr>
        <td width="90%"></td>
        <td width="10%" style="text-align: center;font-size: 9pt;">
            Surabaya, <?php echo date('d-m-Y') ?><br><br><br><br><br>
            (_______________________)
        </td>
    </tr>
</table>

<p style="font-style: italic;font-size: 9pt;">
	Keterangan:
	<ul style="font-size: 6pt;">
	<?php foreach ($teknisi as $tekn) {
		echo "<li>".$tekn->id_teknisi.": ".$tekn->nama_teknisi."</li>";
	} ?>
	</ul>
</p>