<section class="content-header">
  <h1>
    Property
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
        <?= $this->Form->create($property, array('role' => 'form', 'type' => 'file')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('code');
            echo $this->Form->input('name');
            echo $this->Form->input('type', ['options' => $propertyTypes]);
            //echo $this->Form->input('user');
            echo $this->Form->input('address');
            echo $this->Form->input('images[]' , ['type' => 'file', 'multiple' => true, 'required' => false]);

            $add_images = $property->images;
            $images_dir = $property->images_dir;

            if(!empty($add_images))
            {   
                echo '<div class="form-group col-md-12 padding-left-o">';
                echo '<div class="col-md-2"><label>Images selected when add:<label></div>';

                $add_images = explode(',', $add_images);

                echo '<div class="col-md-10">';
                
                foreach ($add_images as $add_img_num => $add_img) {
                    echo '<div class="col-md-2 add_image_div">';
                    echo '<img src="'.DEFAULT_URL.PROPERTIES_IMAGES_UPLOAD_DIR.'/'.$images_dir.'/'.$add_img.'" width="50" height="50" />&nbsp;&nbsp;&nbsp;';
                    echo '<input type="hidden" name="add_image[]" value="'.$add_img.'" />';
                    echo '<input type="button" class="remove-img btn-small btn-info" value="Remove">';
                    echo '</div>';
                }

                echo '</div>';

                echo '</div>';                                        
            }

            echo $this->Form->input('start_time');
            echo $this->Form->input('end_time');
            echo $this->Form->input('sunday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('monday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('tuesday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('wednesday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('thursday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('friday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('saturday_open', ['type' => 'checkbox', 'required' => false]);
            echo $this->Form->input('notes');
            echo $this->Form->input('status');
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
            jQuery('.remove-img').click(function(){
                console.log(jQuery(this).parent());
                jQuery(this).parent().remove();
            })
        });
        </script>
      </div>
    </div>
  </div>
</section>

