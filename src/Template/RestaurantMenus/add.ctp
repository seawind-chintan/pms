<section class="content-header">
  <h1>
    Menu
    <small><?= __('Add') ?></small>
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
        <?= $this->Form->create($restaurantMenu, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties,'readonly'=>true]);
            echo $this->Form->input('restaurant_kitchen_id', ['options' => $restaurantKitchens]);
            echo $this->Form->input('restaurant_menu_type_id', ['options' => $restaurantMenuTypes]);
            echo $this->Form->input('menu_category', ['options' => $menu_category_array]);
            echo $this->Form->input('code');
            echo $this->Form->input('name');
            echo $this->Form->input('price');
            echo $this->Form->input('description');
            /* *
            echo $this->Form->input('discountable', ['options' => array('Yes'=> 'Yes','No'=>'No')]);
            echo $this->Form->input('is_home_delivery', array(
                'label' => 'Is Home Delivery?',
                'type' => 'checkbox',
                'id' => 'is_home_delivery',
                'value' =>'Yes'
            ));
            /* */
            echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options));
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

