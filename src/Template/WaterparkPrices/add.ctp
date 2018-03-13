<section class="content-header">
  <h1>
    Waterpark Price
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
        <?= $this->Form->create($waterparkPrice, array('role' => 'form')) ?>
          <div class="box-body">
          <?php
            echo $this->Form->input('property_id', ['options' => $properties]);
            
            echo $this->Form->input('monday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('monday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('tuesday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('tuesday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('wednesday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('wednesday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('thursday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('thursday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('friday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('friday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('saturday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('saturday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);

            echo $this->Form->input('sunday_total_price', ['templates' => ['inputContainer' => '<div class="row"><div class="col-md-6">{{content}}</div>']]);
            echo $this->Form->input('sunday_ticket_price', ['templates' => ['inputContainer' => '<div class="input {{type}}{{required}} col-md-6">{{content}}</div></div>', 'inputContainerError' => '<div class="input {{type}}{{required}} error col-md-6">{{content}}{{error}}</div></div>']]);
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

