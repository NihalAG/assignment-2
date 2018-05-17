<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coverage $coverage
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Coverage'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="coverage form large-9 medium-8 columns content">
    <?= $this->Form->create($coverage) ?>
    <fieldset>
        <legend><?= __('Add Coverage') ?></legend>
        <?php
            echo $this->Form->control('Coverage_Name', ['type' => 'select', 'options' => ['Auto' => 'Auto', 'Property'=>'Property', 'Legal Expense' => 'Legal Expense']]);
            echo $this->Form->control('Cost');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
