<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomType $roomType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Room Type'), ['action' => 'edit', $roomType->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room Type'), ['action' => 'delete', $roomType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomType->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Room Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roomTypes view large-9 medium-8 columns content">
    <h3><?= h($roomType->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($roomType->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Slug') ?></th>
            <td><?= h($roomType->slug) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($roomType->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($roomType->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Rooms') ?></th>
            <td><?= $this->Number->format($roomType->total_rooms) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $this->Number->format($roomType->status) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($roomType->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($roomType->modified) ?></td>
        </tr>
    </table>
</div>
