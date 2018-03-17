<section class="content-header">
  <h1>
    <?php echo __('Waterpark Ticket'); ?>
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
            <!-- /.box-header -->
            <div class="box-body">
                <dl class="dl-horizontal">
                                                                                                        <dt><?= __('Property') ?></dt>
                                <dd>
                                    <?= $waterparkTicket->has('property') ? $waterparkTicket->property->name : '' ?>
                                </dd>
                                                                                                                <dt><?= __('User') ?></dt>
                                <dd>
                                    <?= $waterparkTicket->has('user') ? $waterparkTicket->user->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Code') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->code) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Issued By') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->issued_by) ?>
                                        </dd>
                                                                                                                                                    <dt><?= __('Member') ?></dt>
                                <dd>
                                    <?= $waterparkTicket->has('member') ? $waterparkTicket->member->id : '' ?>
                                </dd>
                                                                                                                        <dt><?= __('Member Type') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->member_type) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Discount Code') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->discount_code) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Card Number') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->card_number) ?>
                                        </dd>
                                                                                                                                                            <dt><?= __('Card Holder') ?></dt>
                                        <dd>
                                            <?= h($waterparkTicket->card_holder) ?>
                                        </dd>
                                                                                                                                    
                                            
                                                                                                                                                            <dt><?= __('No Of Persons') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->no_of_persons) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Adults') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->no_of_adults) ?>
                                </dd>
                                                                                                                <dt><?= __('No Of Childs') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->no_of_childs) ?>
                                </dd>
                                                                                                                <dt><?= __('Total Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->total_amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Hold Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->hold_amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Balance') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->balance) ?>
                                </dd>
                                                                                                                <dt><?= __('Discount Amount') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->discount_amount) ?>
                                </dd>
                                                                                                                <dt><?= __('Payment Mode') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->payment_mode) ?>
                                </dd>
                                                                                                                <dt><?= __('Status') ?></dt>
                                <dd>
                                    <?= $this->Number->format($waterparkTicket->status) ?>
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

</section>
