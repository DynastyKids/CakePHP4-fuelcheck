<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Info $info
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Info'), ['action' => 'edit', $info->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Info'), ['action' => 'delete', $info->id], ['confirm' => __('Are you sure you want to delete # {0}?', $info->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Info'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Info'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="info view content">
            <h3><?= h($info->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('State') ?></th>
                    <td><?= h($info->state) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($info->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tgp Ulp') ?></th>
                    <td><?= $this->Number->format($info->tgp_ulp) ?></td>
                </tr>
                <tr>
                    <th><?= __('Tgp Dl') ?></th>
                    <td><?= $this->Number->format($info->tgp_dl) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lastfetchtime') ?></th>
                    <td><?= h($info->lastfetchtime) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
