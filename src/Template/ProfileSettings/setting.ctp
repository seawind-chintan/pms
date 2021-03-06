<section class="content-header">
    <h1>
        Profile Setting
    </h1>
    <ol class="breadcrumb">
        <li>
            <?php //echo $this->Html->link('<i class="fa fa-dashboard"></i> ' . __('Back'), ['action' => 'index'], ['escape' => false]) ?>
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
                <?= $this->Form->create($profileSetting, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
//                    echo $this->Form->input('user_id');
                    echo $this->Form->input('title');
                    echo $this->Form->input('short_title');
                    echo $this->Form->input('skin', ['label' => 'Skin','options' => $skin_array]);
//                    echo $this->Form->input('skin');
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

