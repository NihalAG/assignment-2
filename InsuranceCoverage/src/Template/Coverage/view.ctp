<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coverage $coverage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Coverage'), ['action' => 'edit', $coverage->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Coverage'), ['action' => 'delete', $coverage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $coverage->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Coverage'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Coverage'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="coverage view large-9 medium-8 columns content">
    <h3><?= h($coverage->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($coverage->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($coverage->Cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Coverage Name') ?></th>
            <td><?= $coverage->Coverage_Name ?></td>
        </tr>
    </table>
    <div class="row">
        <h4></h4>
        
    </div>
</div>
