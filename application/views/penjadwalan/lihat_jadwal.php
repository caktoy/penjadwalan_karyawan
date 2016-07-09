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
        <h3 class="header smaller lighter blue">
            <?php echo $judul; ?>
            <a href="<?php echo base_url().'penjadwalan/cetak_jadwal/'.$tahun; ?>" class="btn btn-sm btn-default pull-right">
                <i class="ace-icon fa fa-print bigger-110"></i> PDF
            </a>
        </h3>
        
        <div class="row">
            <div class="space"></div>
            <div id="calendar"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(function($) {
        /* initialize the calendar
        -----------------------------------------------------------------*/

        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();


        var calendar = $('#calendar').fullCalendar({
            //isRTL: true,
             buttonHtml: {
                prev: '<i class="ace-icon fa fa-chevron-left"></i>',
                next: '<i class="ace-icon fa fa-chevron-right"></i>'
            },
        
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: [
                <?php foreach ($jadwal as $j) : ?>
                {
                    title: "<?php echo $j->nama_site.' > '.$j->nama_teknisi.' ('.$j->id_teknisi.')'; ?>",
                    start: "<?php echo $j->tanggal; ?>",
                    className: 'label-success'
                },
                <?php endforeach ?>
            ],
            editable: false,
            droppable: false, // this allows things to be dropped onto the calendar !!!
            selectable: false,
            selectHelper: false,
        });
    })
</script>