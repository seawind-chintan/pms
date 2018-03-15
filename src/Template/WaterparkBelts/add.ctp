<section class="content-header">
  <h1>
    Waterpark Belt
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
        <?= $this->Form->create($waterparkBelt, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('code', ['readonly' => true]);
            echo $this->Form->input('status', ['options' => ['Unavailable', 'Available']]);
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

<?php $this->start('scriptBottom'); ?>
<script>
  $(function () {

    //alert($("#property-id").val());
    getBeltCode($("#property-id").val());

    function getBeltCode(propertyId){
      //alert("get belt code");
      var postData = {
          "property_id":propertyId
      };
      $.ajax({
          url: "<?=DEFAULT_URL?>waterpark-settings/getsettingsbyproperty/",
          type: "POST",
          data: {myData:postData},
          success: function(data)
           {
            console.log(data);
            if(data === 'false'){

              /*alert('No rates available for this room');
              jQuery('#room_checkbox_'+roomID).attr("checked", false);
              jQuery('#select_plan_'+roomID).html('');*/

            } else {

              jQuery('#code').val(data);
              
            }
            //jQuery('#roomrack_display').html(data);
           },
      });
    }

    $("#property-id").change(function(){
      getBeltCode($(this).val());
    });

  });
</script>
<?php $this->end(); ?>