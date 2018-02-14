<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomType[]|\Cake\Collection\CollectionInterface $roomTypes
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Room Type'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="roomTypes index large-9 medium-8 columns content">
    <h3><?= __('Room Types') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_rooms') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roomTypes as $roomType): ?>
            <tr>
                <td><?= $this->Number->format($roomType->id) ?></td>
                <td><?= h($roomType->name) ?></td>
                <td><?= h($roomType->slug) ?></td>
                <td><?= $this->Number->format($roomType->price) ?></td>
                <td><?= $this->Number->format($roomType->total_rooms) ?></td>
                <td><?= $this->Number->format($roomType->status) ?></td>
                <td><?= h($roomType->created) ?></td>
                <td><?= h($roomType->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $roomType->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roomType->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roomType->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomType->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
