<section class="content-header">
    <h1>
        Service
        <small><?= __('Add') ?></small>
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
                <?= $this->Form->create($service, array('role' => 'form')) ?>
                <div class="box-body">
                    <?php
                    echo $this->Form->input('parent_id', ['label' => 'Parent Service', 'options' => $parentServices, 'empty' => 'Select Service']);
                    echo $this->Form->input('name');
                    echo $this->Form->input('notes');
                    $selected = array();
                    echo $this->Form->input('status', array('label' => 'Status', 'class' => 'form-control', 'options' => $status_options, 'selected' => $selected));
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

