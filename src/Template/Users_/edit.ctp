<section class="content-header">
  <h1>
    User
    <small><?= __('Edit') ?></small>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> '.__('Back'), ['action' => 'index'], ['escape' => false]) ?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"><?= __('Form') ?></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php
        //pr($user);
        ?>
        <?= $this->Form->create($user, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            //pr($userdetail);

            echo $this->Form->input('username');
            echo $this->Form->input('password');

            echo $this->Form->input('user_detail.first_name');
            echo $this->Form->input('user_detail.last_name');

            echo $this->Form->input('email');
            echo $this->Form->input('mobile');

            $countriesoptions = array();
            foreach ($countries as $coney => $country) {
              $countriesoptions[$country->id] = $country->name;
            }
            $selected = array();
            echo $this->Form->input('user_detail.country', array('label'=>'Select Country','class' => 'form-control', 'options' => $countriesoptions, 'selected' => $selected));

            $statesoptions = array();
            foreach ($states as $stkey => $state) {
              $statesoptions[$state->id] = $state->name;
            }
            $selected = array();
            echo $this->Form->input('user_detail.state', array('label'=>'Select State','class' => 'form-control', 'options' => $statesoptions, 'selected' => $selected));

            $citiesoptions = array();
            foreach ($cities as $citykey => $city) {
              $citiesoptions[$city->id] = $city->name;
            }
            $selected = array();
            echo $this->Form->input('user_detail.city', array('label'=>'Select Country','class' => 'form-control', 'options' => $citiesoptions, 'selected' => $selected));

            echo $this->Form->input('user_detail.pincode');
            echo $this->Form->input('user_detail.address');

            echo '<input type="hidden" name="user_id" value="'.$user->id.'">';

            $rolesoptions = array();
            foreach ($userroles as $urkey => $userrole) {
              $rolesoptions[$userrole->id] = $userrole->name;
            }
            $selected = array();
            echo $this->Form->input('role', array('label'=>'Select Role','class' => 'form-control', 'options' => $rolesoptions, 'selected' => $selected));

            $selected = array();
            echo $this->Form->input('status', array('label'=>'Status','class' => 'form-control', 'options' => $status_options, 'selected' => $selected));
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</section>

