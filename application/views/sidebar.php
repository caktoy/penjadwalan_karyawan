<div id="sidebar" class="sidebar responsive">
        <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
        </script>

        <ul class="nav nav-list">
            <li class="<?php echo $aktif=='beranda'?'active':''; ?>">
                <a href="<?php echo base_url(); ?>">
                            <i class="menu-icon fa fa-home"></i>
                            <span class="menu-text"> Beranda </span>
                    </a>

                    <b class="arrow"></b>
            </li>

            <li class="<?php echo $aktif=='master'?'active':''; ?>">
                    <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-desktop"></i>
                            <span class="menu-text">
                                    Data Master
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                            <li class="">
                                    <a href="<?php echo base_url(); ?>teknisi">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Master Teknisi
                                    </a>

                                    <b class="arrow"></b>
                            </li>

                            <li class="">
                                    <a href="<?php echo base_url(); ?>site">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Master Site
                                    </a>

                                    <b class="arrow"></b>
                            </li>

                            <li class="">
                                    <a href="<?php echo base_url(); ?>kota">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Master Provinsi & Kota
                                    </a>

                                    <b class="arrow"></b>
                            </li>
                    </ul>
            </li>

            <li class="<?php echo $aktif=='penjadwalan'?'active':''; ?>">
                    <a href="<?php echo base_url(); ?>penjadwalan">
                            <i class="menu-icon fa fa-calendar"></i>
                            <span class="menu-text"> Penjadwalan </span>
                    </a>

                    <b class="arrow"></b>
            </li>

            <li class="<?php echo $aktif=='presensi'?'active':''; ?>">
                    <a href="<?php echo base_url(); ?>presensi">
                            <i class="menu-icon fa fa-check-square-o"></i>
                            <span class="menu-text"> Presensi </span>
                    </a>

                    <b class="arrow"></b>
            </li>

            <li class="<?php echo $aktif=='laporan'?'active':''; ?>">
                    <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-paperclip"></i>
                            <span class="menu-text">
                                    Laporan
                            </span>

                            <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                            <li class="">
                                    <a href="<?php echo base_url(); ?>laporan/presensi">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Laporan Presensi
                                    </a>

                                    <b class="arrow"></b>
                            </li>

                            <li class="">
                                    <a href="<?php echo base_url(); ?>laporan/detil">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Laporan Detil Presensi
                                    </a>

                                    <b class="arrow"></b>
                            </li>

                            <li class="">
                                    <a href="<?php echo base_url(); ?>laporan/teknisi">
                                            <i class="menu-icon fa fa-caret-right"></i>
                                            Laporan Jadwal Teknisi
                                    </a>

                                    <b class="arrow"></b>
                            </li>
                    </ul>
            </li>
        </ul><!-- /.nav-list -->

        <!-- <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div> -->

        <div style="position: fixed;bottom: 0;width: inherit;border: inherit;">
            <img src="<?php echo base_url().'assets/img/logo-perusahaan.png'; ?>" alt="Logo Perusahaan" style="width: inherit;border: inherit;">
        </div>

        <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
        </script>
</div>