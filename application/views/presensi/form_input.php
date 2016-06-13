<div class="col-md-12">
	<strong>Tanggal: <?php echo date('d M Y', strtotime($tanggal)); ?></strong>
	<form class="form-horizontal" role="form" action="<?php echo base_url().'presensi/update'; ?>" method="post" onsubmit="return confirm('Anda yakin?')">
		<?php
		$teknisi = '';
		$idx_jadwal = 0;
		foreach ($jadwal as $j) {
			$teknisi .= $j->id_teknisi;

			$idx_jadwal++;
            if($idx_jadwal < count($jadwal))
                $teknisi .= ';';
		}
		?>
		<input type="hidden" name="teknisi" value="<?php echo $teknisi; ?>">

		<input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">

		<div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
			Teknisi:
        </div>

		<table id="dynamic-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th style="text-align: center;">ID</th>
					<th style="text-align: center;">Nama</th>
					<th style="text-align: center;">Site</th>
					<th style="text-align: center;" colspan="5">Keterangan</th>
				</tr>	
			</thead>

			<tbody>
		<?php if(count($jadwal) > 0): ?>
			<?php foreach($jadwal as $j): ?>
				<tr>
					<td style="width: 10%;"><?php echo $j->id_teknisi; ?></td>
					<td><?php echo $j->nama_teknisi; ?></td>
					<td style="width: 15%;"><?php echo $j->nama_site; ?></td>
					<td style="width: 10%;text-align: center;">
						<div class="radio">
							<label>
								<input type="radio" id="<?php echo $j->id_teknisi.'_H'; ?>" name="<?php echo $j->id_teknisi; ?>" class="ace" value="H" <?php echo $j->keterangan=='H'?'checked':''; ?> />
								<span class="lbl"> Hadir</span>
							</label>
						</div>
					</td>
					<td style="width: 10%;text-align: center;">
						<div class="radio">
							<label>
								<input type="radio" id="<?php echo $j->id_teknisi.'_S'; ?>" name="<?php echo $j->id_teknisi; ?>" class="ace" value="S" <?php echo $j->keterangan=='S'?'checked':''; ?> />
								<span class="lbl"> Sakit</span>
							</label>
						</div>
					</td>
					<td style="width: 10%;text-align: center;">
						<div class="radio">
							<label>
								<input type="radio" id="<?php echo $j->id_teknisi.'_I'; ?>" name="<?php echo $j->id_teknisi; ?>" class="ace" value="I" <?php echo $j->keterangan=='I'?'checked':''; ?> />
								<span class="lbl"> Izin</span>
							</label>
						</div>
					</td>
					<td style="width: 10%;text-align: center;">
						<div class="radio">
							<label>
								<input type="radio" id="<?php echo $j->id_teknisi.'_A'; ?>" name="<?php echo $j->id_teknisi; ?>" class="ace" value="A" <?php echo $j->keterangan=='A'?'checked':''; ?> />
								<span class="lbl"> Alpha</span>
							</label>
						</div>
					</td>
					<td style="width: 10%;text-align: center;">
						<div class="radio">
							<label>
								<input type="radio" id="<?php echo $j->id_teknisi.'_C'; ?>" name="<?php echo $j->id_teknisi; ?>" class="ace" value="C" <?php echo $j->keterangan=='C'?'checked':''; ?> />
								<span class="lbl"> Cuti</span>
							</label>
						</div>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>

		<div style="display: block;width: 100%;text-align: center;">
            <button class="btn btn-success" type="submit">
                <i class="ace-icon fa fa-check bigger-110"></i>
                Simpan
            </button>
        </div>
		<?php else: ?>
			<tr><td colspan="8">Maaf, tidak ada data yang ditampilkan.</td></tr>
		<?php endif ?>
	</form>
</div>