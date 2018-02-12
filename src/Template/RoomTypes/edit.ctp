<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomType $roomType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $roomType->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $roomType->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Room Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="roomTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($roomType) ?>
    <fieldset>
        <legend><?= __('Edit Room Type') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('slug');
            echo $this->Form->control('price');
            echo $this->Form->control('total_rooms');
            echo $this->Form->control('status');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
