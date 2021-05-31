<?php

load::model('user/User_permission');
class_alias('User_permission_model','Permission');
$permission = new Permission();

$login_id = session::get('session_data')['login_id'];
$menu = $permission->getMenusByLoginId($login_id);

// prx($menu);


?>
<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

<div class="slimscroll-menu">

    <!--- Sidemenu -->
    <div id="sidebar-menu">

        <ul class="metismenu" id="side-menu">

            <li class="menu-title">Navigation</li>

            <?php if($menu['menu_dashboard']==1): ?>
            
            <li>
                <a href="<?php echo base_url('user/dashboard');?>">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard </span>
                </a>
            </li>

         <?php endif; ?>
         
         
            <li class="menu-title mt-2">Apps & Services</li>

            <?php if($menu['menu_notification']==1): ?>
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-format-underline"></i>
                    <span> Notification </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li> <a href="<?php echo base_url('user/notification-create'); ?>">Create Notification</a> </li>
                    <li> <a href="<?php echo base_url('user/notification-manage'); ?>">Manage Notification</a> </li>
                    
                </ul>
            </li>

        <?php endif; ?>
            
            <?php if($menu['menu_campaigns']==1): ?>
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-package-variant-closed"></i>
                    <span> Campaigns</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    
                    <li>
                        <a href="<?php echo base_url('user/convert'); ?>">Convert</a>
                    </li>

                    <li>
                    <a href="javascript: void(0);">Create</a>
                    </li>

                    <li>
                    <a href="javascript: void(0);">Manage</a>
                    </li>
                    <li>
                     <a href="javascript: void(0);">Manage Templates</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

            <?php if($menu['menu_phone_book']==1): ?>
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-package-variant-closed"></i>
                    <span> Phone Book </span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    <li>
                        <a href="javascript: void(0);">Create Compaigns</a>
                    </li>
                    <li>
                        <a href="javascript: void(0);">Manage Compaigns</a>
                    </li>
                   

                </ul>
            </li>
        <?php endif; ?>

            <?php if($menu['menu_support_tools']==1): ?>
            
            <li>
                <a href="javascript: void(0);">
                    <i class="mdi mdi-package-variant-closed"></i>
                    <span> Support Tools</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul class="nav-second-level" aria-expanded="false">
                    
                    <li><a href="javascript: void(0);">Duplicate Removals</a></li>
                    <li><a href="javascript: void(0);">Opt-Out Removals</a></li>

                </ul>
            </li>
            <?php endif; ?>
            
            </li>

        </ul>

    </div>
    <!-- End Sidebar -->

    <div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->