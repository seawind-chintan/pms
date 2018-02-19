<section class="content-header">
  <h1>
    Room
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
        <?= $this->Form->create($room, array('role' => 'form', 'type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('number');
            echo $this->Form->input('code');
            echo $this->Form->input('type', ['options' => $roomtypes]);
            echo $this->Form->input('images[]', ['label' => 'Room Images', 'type' => 'file', 'multiple' => 'true']);

            $add_images = $room->images;
            $images_dir = $room->images_dir;

            if(!empty($add_images))
            {   
                echo '<div class="form-group col-md-12 padding-left-o">';
                echo '<div class="col-md-2"><label>Images selected when add:<label></div>';

                $add_images = explode(',', $add_images);

                echo '<div class="col-md-10">';
                
                foreach ($add_images as $add_img_num => $add_img) {
                    echo '<div class="col-md-2 add_image_div">';
                    echo '<img src="'.DEFAULT_URL.ROOMS_IMAGES_UPLOAD_DIR.'/'.$images_dir.'/'.$add_img.'" width="50" height="50" />&nbsp;&nbsp;&nbsp;';
                    echo '<input type="hidden" name="add_image[]" value="'.$add_img.'" />';
                    echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                    echo '</div>';
                }

                echo '</div>';

                echo '</div>';                                        
            }

            echo $this->Form->input('room_occupancy');
            echo $this->Form->input('description');
            //echo $this->Form->input('user_id', ['options' => $users]);
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
            //getPriceByType();
            jQuery('.remove-img').click(function(){
                console.log(jQuery(this).parent());
                jQuery(this).parent().remove();
            })
            function getPriceByType(){
              var typeId = jQuery('#type').val();
              $.ajax({
                  url: "<?=DEFAULT_URL?>room-types/getpricebytype/"+typeId,
                  type: "POST",
                  /*data: dataString,*/
                  success: function(data)
                   {
                    //alert(data);
                    jQuery('#rate').val(data);
                   },
              });
            }
            jQuery('#type').change(function(){
                getPriceByType();
            })
        });
        </script>
      </div>
    </div>
  </div>
</section>

