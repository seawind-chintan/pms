<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder'). DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'sidebar-menu.ctp';
if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<?php
$session = $this->request->getSession();
$current_user_data = $session->read('Auth.User');
//pr($current_user_data);
?>
<ul class="sidebar-menu">
    <?php
if($current_user_data['role'] == 1){
?>

    <li class="header">MAIN NAVIGATION</li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Users</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/users'); ?>"><i class="fa fa-list"></i> Manage Users</a></li>
            <li><a href="<?php echo $this->Url->build('/user-roles'); ?>"><i class="fa fa-list"></i> Manage Roles</a></li>
            <li><a href="<?php echo $this->Url->build('/user-services/assignServices'); ?>"><i class="fa fa-circle-o"></i> Assign Services</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>Common</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/countries'); ?>"><i class="fa fa-list"></i> Manage Countries</a></li>
            <li><a href="<?php echo $this->Url->build('/states'); ?>"><i class="fa fa-list"></i> Manage States</a></li>
            <li><a href="<?php echo $this->Url->build('/cities'); ?>"><i class="fa fa-list"></i> Manage Cities</a></li>
            <li><a href="<?php echo $this->Url->build('/property-types'); ?>"><i class="fa fa-list"></i> Manage Property Types</a></li>
            <li><a href="<?php echo $this->Url->build('/services'); ?>"><i class="fa fa-list"></i> Manage Services</a></li>
            <li><a href="<?php echo $this->Url->build('/room-statuses'); ?>"><i class="fa fa-check-square"></i>Manage Room Statuses</a></li>
        </ul>
    </li>
    <!--<li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/'); ?>"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/home2'); ?>"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
                <span class="label label-primary pull-right">4</span>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/layout/top-nav'); ?>"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/boxed'); ?>"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/fixed'); ?>"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/layout/collapsed-sidebar'); ?>"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/widgets'); ?>">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-green">new</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/charts/chartjs'); ?>"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/morris'); ?>"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/flot'); ?>"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/charts/inline'); ?>"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/ui/general'); ?>"><i class="fa fa-circle-o"></i> General</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/icons'); ?>"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/buttons'); ?>"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/sliders'); ?>"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/timeline'); ?>"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/ui/modals'); ?>"><i class="fa fa-circle-o"></i> Modals</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/forms/general'); ?>"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/advanced'); ?>"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/forms/editors'); ?>"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/tables/simple'); ?>"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/tables/data'); ?>"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $this->Url->build('/pages/calendar'); ?>">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-red">3</small>
                <small class="label pull-right bg-blue">17</small>
            </span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
                <small class="label pull-right bg-yellow">12</small>
                <small class="label pull-right bg-green">16</small>
                <small class="label pull-right bg-red">5</small>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/mailbox'); ?>">Inbox <span class="label label-primary pull-right">13</span></a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/compose'); ?>">Compose</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/mailbox/read-mail'); ?>">Read</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/pages/starter'); ?>"><i class="fa fa-circle-o"></i> Starter</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/invoice'); ?>"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/login'); ?>"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/register'); ?>"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/lockscreen'); ?>"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/404'); ?>"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/500'); ?>"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/blank'); ?>"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="<?php echo $this->Url->build('/pages/examples/pace'); ?>"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li>
                <a href="#">
                <i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i> Level Two
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
    </li>
    <li><a href="<?php echo $this->Url->build('/pages/documentation'); ?>"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
    <li class="header">LABELS</li>
    <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    <li><a href="<?php echo $this->Url->build('/pages/debug'); ?>"><i class="fa fa-bug"></i> Debug</a></li>-->

<?php
}
elseif($current_user_data['role'] == 2){
?>

    <li class="header">MAIN NAVIGATION</li>
    <!-- <li class="treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>Employees/Managers</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/users'); ?>"><i class="fa fa-list"></i> Manage Employees/Managers</a></li>
            <li><a href="<?php echo $this->Url->build('/user-services/assignServices'); ?>"><i class="fa fa-circle-o"></i> Assign Services</a></li>
        </ul>
    </li> -->
    <li class="treeview">
        <a href="<?php echo $this->Url->build('/dashboard'); ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user-plus"></i> <span>Members</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/members'); ?>"><i class="fa fa-list"></i> Manage Members</a></li>
        </ul>
    </li>
    <!-- <li class="treeview">
        <a href="#">
            <i class="fa fa-building"></i> <span>Properties</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/properties'); ?>"><i class="fa fa-building"></i> Manage Properties</a></li>
        </ul>
    </li> -->
    <li class="treeview">
        <a href="#">
            <i class="fa fa-home"></i> <span>Front Office</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/rooms/showroomrack'); ?>"><i class="fa fa-table"></i> Room Rack</a></li>
            <li><a href="<?php echo $this->Url->build('/reservations'); ?>"><i class="fa fa-book"></i> Reservations</a></li>
            <li><a href="<?php echo $this->Url->build('/checkins'); ?>"><i class="fa fa-sign-in"></i> Check-Ins</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-ship"></i> <span>Water Park</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Masters</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo $this->Url->build('/waterpark-prices'); ?>"><i class="fa fa-list"></i> Base Prices</a></li>
                    <li><a href="<?php echo $this->Url->build('/waterpark-specific-prices'); ?>"><i class="fa fa-list"></i> Specific Prices</a></li>
                    <li><a href="<?php echo $this->Url->build('/waterpark-costumelockers'); ?>"><i class="fa fa-list"></i> Costume & Locker Prices</a></li>
                    <li><a href="<?php echo $this->Url->build('/waterpark-recharges'); ?>"><i class="fa fa-list"></i> Recharges </a></li>
                    <li><a href="<?php echo $this->Url->build('/waterpark-belts'); ?>"><i class="fa fa-circle-o-notch"></i> Belts </a></li>
                    <li><a href="<?php echo $this->Url->build('/waterpark-settings'); ?>"><i class="fa fa-gear"></i> Settings </a></li>
                </ul>
            </li>
            <li><a href="<?php echo $this->Url->build('/waterpark-tickets'); ?>"><i class="fa fa-ticket"></i> Tickets </a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-issued-belts'); ?>"><i class="fa fa-circle-o-notch"></i> Issued Belts </a></li>
        </ul>
    </li>

<?php
}
?>
<?php } ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>Restaurant Master</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php /* * ?>
            <li><a href="<?php echo $this->Url->build('/restaurant-tables'); ?>"><i class="fa fa-list"></i> Create Table</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-tables/displayRestaurantTable'); ?>"><i class="fa fa-list"></i> Display Table</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-waiters'); ?>"><i class="fa fa-list"></i> Create Waiter</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-table-bookings'); ?>"><i class="fa fa-list"></i> Booking</a></li>
            <?php /* */ ?>

            <li><a href="<?php echo $this->Url->build('/restaurant-tables/defaultRestaurant'); ?>"><i class="fa fa-list"></i> Default Restaurant</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-kitchens'); ?>"><i class="fa fa-list"></i> Create Kitchen</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-menu-types'); ?>"><i class="fa fa-list"></i> Create Menu Type</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-menus'); ?>"><i class="fa fa-list"></i> Create Menu</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>Waterpark KOTS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/waterpark-taxes'); ?>"><i class="fa fa-list"></i> Tax Master</a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-kots/add'); ?>"><i class="fa fa-list"></i> New KOT</a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-kots/'); ?>"><i class="fa fa-list"></i> Open KOT List</a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-kots/closeKot'); ?>"><i class="fa fa-list"></i> Close KOT </a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-kots/cancelKot'); ?>"><i class="fa fa-list"></i> Cancel KOT </a></li>
        </ul>
    </li>
    <?php /* * ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>Restaurant Order</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/kots/add'); ?>"><i class="fa fa-list"></i> New KOT</a></li>
            <li><a href="<?php echo $this->Url->build('/kots'); ?>"><i class="fa fa-list"></i> Close KOT </a></li>

            
            <li><a href="<?php echo $this->Url->build('/kots/change_table'); ?>"><i class="fa fa-list"></i> Shift Table</a></li>
            <li><a href="<?php echo $this->Url->build('/restaurant-tables/displayRestaurantTable'); ?>"><i class="fa fa-list"></i> Display Table</a></li>
            
        </ul>
    </li>
    <?php /* */ ?>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-circle-o"></i> <span>Billing</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo $this->Url->build('/waterpark-kot-billings/unsettled_bill'); ?>"><i class="fa fa-list"></i> Unsettled Bill</a></li>
            <li><a href="<?php echo $this->Url->build('/waterpark-kot-billings/settled_bill'); ?>"><i class="fa fa-list"></i> Settled Bill</a></li>
        </ul>
    </li>
</ul>