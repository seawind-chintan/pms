<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomStatus $roomStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $roomStatus->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $roomStatus->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Room Statuses'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="roomStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($roomStatus) ?>
    <fieldset>
        <legend><?= __('Edit Room Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('slug');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
