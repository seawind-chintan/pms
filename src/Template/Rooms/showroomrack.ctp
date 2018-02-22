<section class="content-header">
  <h1>
    <?php echo __('Room Rack'); ?>
  </h1>
  <ol class="breadcrumb">
    <li>
    <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false])?>
    </li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <i class="fa fa-info"></i>
                <h3 class="box-title"><?php echo __('Information'); ?></h3>
            </div>
            <!-- form start -->
            <?= $this->Form->create('roomrack', array('role' => 'form')) ?>
              <div class="box-body">
              <?php
                echo $this->Form->input('properties', ['label' => 'Select Property','options' => $properties, 'empty' => 'Select' ]);
              ?>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <?= $this->Form->button(__('Save')) ?>
              </div>
            <?= $this->Form->end() ?>
        </div>
        <!-- /.box -->
    </div>
    <!-- ./col -->
</div>
<!-- div -->

</section>

<?php
$this->Html->script([
  'AdminLTE./plugins/jQuery/jquery-2.2.3.min',
],
['block' => 'script']);
?>
<?php $this->start('scriptBottom'); ?>
<script type="text/javascript">

  jQuery('#properties').change(function(){
    var propertyId = jQuery(this).val();

    var postData = {
        "property_id":propertyId
    };

    $.ajax({
        url: "<?=DEFAULT_URL?>rooms/getroomrackbyproperty/",
        type: "POST",
        data: {myData:postData},
        success: function(data)
         {
          //alert(data);
          jQuery('#room_price_'+dataRoom).html(data);
         },
    });
  });
</script>
<?php $this->end(); ?>