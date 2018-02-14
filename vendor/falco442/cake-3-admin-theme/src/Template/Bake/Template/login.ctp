<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
%>
<div class="container">

    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
		    		<?= $this->Flash->render('auth') ?>
				    <?= $this->Form->create() ?>
				    <fieldset>
				        <legend><?= __('Please enter your username and password') ?></legend>
				        <?= $this->Form->input('username') ?>
				        <?= $this->Form->input('password') ?>
				    </fieldset>
				    <?= $this->Form->button(__('Login')); ?>
				    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
