<section class="content-header">
    <h1>
        <?php echo __('Service'); ?>
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
        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <i class="fa fa-info"></i>
                    <h3 class="box-title"><?php echo __('Information'); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= __('Parent Service') ?></dt>
                        <dd>
                            <?= $service->has('parent_service') ? $service->parent_service->name : '-' ?>
                        </dd>
                        <dt><?= __('Name') ?></dt>
                        <dd>
                            <?= h($service->name) ?>
                        </dd>


                        <dt><?= __('Status') ?></dt>
                        <dd>
                            <?php echo $status_options[$service->status];?>
                        </dd>
                    </dl>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- ./col -->
    </div>
    <!-- div -->

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <i class="fa fa-share-alt"></i>
                    <h3 class="box-title"><?= __('Related {0}', ['Services']) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <?php if (!empty($service->child_services)): ?>

                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th>Id</th>
                                    <th>Parent Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th><?php echo __('Actions'); ?></th>
                                </tr>

                                <?php foreach ($service->child_services as $childServices): ?>
                                    <tr>
                                        <td>
                                            <?= h($childServices->id) ?>
                                        </td>
                                        <td>
                                            <?= $service->name;?>
                                            <?php //echo ($childServices->parent_id); ?>
                                        </td>
                                        <td>
                                            <?= h($childServices->name) ?>
                                        </td>
                                        <td>
                                            <?= $status_options[$childServices->status]; ?>
                                        </td>
                                        <td class="actions">
                                            <?= $this->Html->link(__('View'), ['controller' => 'Services', 'action' => 'view', $childServices->id], ['class' => 'btn btn-info btn-xs']) ?>

                                            <?= $this->Html->link(__('Edit'), ['controller' => 'Services', 'action' => 'edit', $childServices->id], ['class' => 'btn btn-warning btn-xs']) ?>

                                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Services', 'action' => 'delete', $childServices->id], ['confirm' => __('Are you sure you want to delete # {0}?', $childServices->id), 'class' => 'btn btn-danger btn-xs']) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>

                    <?php endif; ?>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>