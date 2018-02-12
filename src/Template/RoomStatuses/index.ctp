<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RoomStatus[]|\Cake\Collection\CollectionInterface $roomStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Room Status'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="roomStatuses index large-9 medium-8 columns content">
    <h3><?= __('Room Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('slug') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roomStatuses as $roomStatus): ?>
            <tr>
                <td><?= $this->Number->format($roomStatus->id) ?></td>
                <td><?= h($roomStatus->name) ?></td>
                <td><?= h($roomStatus->slug) ?></td>
                <td><?= $this->Number->format($roomStatus->status) ?></td>
                <td><?= h($roomStatus->created) ?></td>
                <td><?= h($roomStatus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $roomStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $roomStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $roomStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $roomStatus->id)]) ?>
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
