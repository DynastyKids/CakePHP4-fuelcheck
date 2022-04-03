<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Info[]|\Cake\Collection\CollectionInterface $info
 */
?>
<div class="info index content">
    <?= $this->Html->link(__('New Info'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Info') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('lastfetchtime') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('tgp_ulp') ?></th>
                    <th><?= $this->Paginator->sort('tgp_dl') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($info as $info): ?>
                <tr>
                    <td><?= $this->Number->format($info->id) ?></td>
                    <td><?= h($info->lastfetchtime) ?></td>
                    <td><?= h($info->state) ?></td>
                    <td><?= $this->Number->format($info->tgp_ulp) ?></td>
                    <td><?= $this->Number->format($info->tgp_dl) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $info->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $info->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $info->id], ['confirm' => __('Are you sure you want to delete # {0}?', $info->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
