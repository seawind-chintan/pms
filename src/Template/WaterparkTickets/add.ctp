<section class="content-header">
  <h1>
    Waterpark Ticket
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
        <?= $this->Form->create($waterparkTicket, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            echo $this->Form->input('code');
            echo $this->Form->input('no_of_persons');
            echo $this->Form->input('no_of_adults');
            echo $this->Form->input('no_of_childs');
            echo $this->Form->input('issued_by');
            echo $this->Form->input('member_id', ['options' => $members, 'empty' => 'Select Member']);
            echo $this->Form->input('member_type');
            echo $this->Form->input('total_amount');
            echo $this->Form->input('hold_amount');
            echo $this->Form->input('balance');
            echo $this->Form->input('discount_code');
            echo $this->Form->input('discount_amount');
            echo $this->Form->input('payment_mode');
            echo $this->Form->input('card_number');
            echo $this->Form->input('card_holder');
            echo $this->Form->input('status');
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

