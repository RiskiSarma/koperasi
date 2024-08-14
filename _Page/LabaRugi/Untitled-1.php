<?php }if(!empty($ATJR)||!empty($EML)||!empty($ETAK)||!empty($UMM)){ ?>
            <li class="nav-item">
                <a class="nav-link <?php if($PageMenu=="SettingGeneral"||$PageMenu=="EntitasAkses"||$PageMenu=="AutoJurnal"){echo "";}else{echo "collapsed";} ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="javascript:void(0);">
                    <i class="bi bi-gear"></i>
                        <span>Pengaturan</span><i class="bi bi-chevron-down ms-auto">
                    </i>
                </a>
                <ul id="components-nav" class="nav-content collapse <?php if($PageMenu=="SettingGeneral"||$PageMenu=="EntitasAkses"||$PageMenu=="AutoJurnal"){echo "show";} ?>" data-bs-parent="#sidebar-nav">
                    <?php if(!empty($UMM)){ ?>  
                        <li>
                            <a href="index.php?Page=SettingGeneral" class="<?php if($PageMenu=="SettingGeneral"){echo "active";} ?>">
                                <i class="bi bi-circle"></i><span>Umum</span>
                            </a>
                        </li>
                    <?php }if(!empty($ETAK)){ ?>  
                        <li>
                            <a href="index.php?Page=EntitasAkses" class="<?php if($PageMenu=="EntitasAkses"){echo "active";} ?>">
                                <i class="bi bi-circle"></i><span>Entitas Akses</span>
                            </a>
                        </li>
                    <?php }if(!empty($ATJR)){ ?>  
                        <li>
                            <a href="index.php?Page=AutoJurnal" class="<?php if($PageMenu=="AutoJurnal"){echo "active";} ?>">
                                <i class="bi bi-circle"></i><span>Auto Jurnal</span>
                            </a>
                        </li>
                    <?php }if(!empty($EML)){ ?>  
                        <li>
                            <a href="index.php?Page=SettingEmail" class="<?php if($PageMenu=="SettingEmail"){echo "active";} ?>">
                                <i class="bi bi-circle"></i><span>Email</span>
                            </a>
                        </li>
                    <?php } ?>  
                </ul>
            </li>