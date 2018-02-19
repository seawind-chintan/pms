<section class="content-header">
  <h1>
    Room
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
        <?= $this->Form->create($room, array('role' => 'form', 'type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('number');
            echo $this->Form->input('code');
            echo $this->Form->input('type', ['options' => $roomtypes]);
            echo $this->Form->input('images[]', ['label' => 'Room Images', 'type' => 'file', 'multiple' => 'true']);
            echo $this->Form->input('room_occupancy');
            echo $this->Form->input('description');
            echo $this->Form->input('status', ['options' => $status_options]);
          ?>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <?= $this->Form->button(__('Save')) ?>
          </div>
        <?= $this->Form->end() ?>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            /*getPriceByType();
            function getPriceByType(){
              var typeId = jQuery('#type').val();
              $.ajax({
                  url: "<?=DEFAULT_URL?>room-types/getpricebytype/"+typeId,
                  type: "POST",
                  success: function(data)
                   {
                    //alert(data);
                    jQuery('#rate').val(data);
                   },
              });
            }
            jQuery('#type').change(function(){
                getPriceByType();
            })*/
        });
        </script>
      </div>
    </div>
  </div>
</section>

