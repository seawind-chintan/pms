<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = SITENAME;
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?> -
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?php // $this->Html->css('base.css') ?>
    <?php //$this->Html->css('cake.css') ?>

    <?= $this->Html->css('../bundles/bootstrap/css/bootstrap.min.css') ?>
    <?= $this->Html->css('../bundles/metisMenu/metisMenu.min.css') ?>
    <?= $this->Html->css('sb-admin-2.css') ?>
    <?= $this->Html->css('../bundles/font-awesome/css/font-awesome.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?php // $this->fetch('css') ?>
    <?php // $this->fetch('script') ?>
</head>
<body>
    <div id="wrapper">
        <!--<nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li class="name">
                    <h1><a href=""><?= SITENAME ?></a></h1>
                </li>
            </ul>
            <div class="top-bar-section">
                <ul class="right">
                    <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                    <?php
                    //pr($this->request);exit;
                    $session = $this->request->getSession();
                    $user_data = $session->read('Auth.User');
                    if(!empty($user_data))
                    {
                        ?><li><?= $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout']) ?></li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>-->
        
        <?php
        //pr($this->request);exit;
        $session = $this->request->getSession();
        $user_data = $session->read('Auth.User');
        if(!empty($user_data))
        {
            echo $this->element('Common/sidebar');
            
            ?>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Flash->render() ?>
                            <?= $this->fetch('content') ?>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
            <?php
        }
        else
        {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Please Sign In</h3>
                            </div>
                            <div class="panel-body">
                                <?= $this->Flash->render() ?>
                                <?= $this->fetch('content') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

    <?= $this->Html->script('../bundles/jquery/jquery.min.js') ?>
    <?= $this->Html->script('../bundles/bootstrap/js/bootstrap.min.js') ?>
    <?= $this->Html->script('../bundles/metisMenu/metisMenu.min.js') ?>
    <?= $this->Html->script('sb-admin-2.js') ?>
</body>
</html>