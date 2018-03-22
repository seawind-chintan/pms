<section class="content-header">
    <h1>
        Shift Table
    </h1>
    <ol class="breadcrumb">
        <li>
            <?= $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                <?= $this->Form->create($kot, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php /* */ ?>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('occupied_id', ['options' => $occupied_table_array, 'empty' => 'Select Occupied Tables','label'=>'Occupied Tables']);
                            if(isset($error_array ['error_occupied'])){echo '<span class="error-message">'.$error_array ['error_occupied'].'</span>';}
                            ?>
                        </div>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('non_occupied_id', ['options' => $non_occupied_table_array, 'empty' => 'Select Vacant Table','label'=>'Vacant Tables']);
                            if(isset($error_array ['error_non_occupied'])){echo '<span class="error">'.$error_array ['error_non_occupied'].'</span>';}
                            ?>
                        </div>
                    </div>
                </div>

                <div class="box-body">

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