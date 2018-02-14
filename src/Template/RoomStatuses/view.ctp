<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomStatus $roomStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room Status'), ['action' => 'edit', $roomStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room Status'), ['action' => 'delete', $roomStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Room Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room Status'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roomStatuses view large-9 medium-8 columns content">
    <h3><?= h($roomStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($roomStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($roomStatus->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($roomStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($roomStatus->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($roomStatus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($roomStatus->modified) ?></td>
        </tr>
    </table>
</div>
