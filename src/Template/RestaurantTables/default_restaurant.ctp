<section class="content-header">
  <h1>
    Set Default Restaurant
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
        <?= $this->Form->create($restaurantTable, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
          $session = $this->request->session();
          $select_property_id = $session->read('default_restaurant_id');
          //$select_property_name = $session->read('default_restaurant_name');
//            echo $this->Form->input('property_id', ['options' => $properties,'empty'=>'Select Default Property']);
            echo $this->Form->input('property_id', ['options' => $properties,'default'=>$select_property_id]);



//            pr($session->read(''));
//            exit;
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

<script type="text/javascript">
function getmax_table(id)
{
//alert(id);
//alert("hello");
//var state = jQuery('#userdetail-state').val();
//alert(state);
//dataString="state_id="+id;
//jQuery('#userdetail-city').parent().attr('id', "city-area")
  $.ajax({
            url: "<?php echo DEFAULT_URL;?>restaurant-tables/getmax_table/"+id,
            type: "POST",
            success: function(data)
             {
                alert(data);
                $('#service_div').html(data);
             },
        });
}
</script>

