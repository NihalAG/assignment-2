<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Coverage[]|\Cake\Collection\CollectionInterface $coverage
 */

?>
<!-- <nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li></li>
    </ul>
</nav> -->
<h3><?= __('Coverages') ?></h3>

<div class="table-responsive">
    <table class="mdl-data-table mdl-js-data-table table">
        <thead>
            <tr>
                <th class="mdl-data-table__cell--non-numeric" scope="col">
                    <?= $this->Paginator->sort('id', 'Coverage ID') ?>
                </th>
                <th class="mdl-data-table__cell--non-numeric" scope="col"><?= $this->Paginator->sort('Coverage_Name') ?></th>
                <th class="mdl-data-table__cell--non-numeric" scope="col"><?= $this->Paginator->sort('Cost') ?></th>
                <th class="mdl-data-table__cell--non-numeric" scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coverage as $coverage): ?>
            <tr class="non-editable-row lead">
                <td class="mdl-data-table__cell--non-numeric coverage-id">
                    <?= $this->Number->format($coverage->id) ?>
                </td>
                <td class="mdl-data-table__cell--non-numeric coverage-name">
                    <?= $coverage->Coverage_Name ?>
                </td>
                <td class="mdl-data-table__cell--non-numeric coverage-cost">
                    <?= $this->Number->format($coverage->Cost) ?>
                </td>
                <td class="mdl-data-table__cell--non-numeric">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored update">Update</button>
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored deleteModal" data-row-id="<?= $this->Number->format($coverage->id) ?>" data-target="#deleteCoverage">Delete</button>
                </td>
            </tr>
            <tr class="editable-row lead">
                <td class="mdl-data-table__cell--non-numeric coverage-id">
                    <?= $this->Form->hidden('id', ['value' => $coverage->id]); ?>
                    <?= $this->Number->format($coverage->id); ?>        
                </td>
                <td class="mdl-data-table__cell--non-numeric coverage-name">
                    <?= $this->Form->control('Coverage_Name', ['type' => 'select', 'options' => ['' => 'Select', 'Auto' => 'Auto', 'Property'=>'Property', 'Legal Expense' => 'Legal Expense'], 'label' => false, 'class' => 'form-control', 'id' => false]); ?>
                    <span class="error-message-container"></span>
                </td>
                <td class="mdl-data-table__cell--non-numeric coverage-cost">
                    <?= $this->Form->control('Cost', ['label' => false, 'class' => 'form-control', 'id' => false]); ?>
                    <span class="error-message-container"></span>
                </td>
                <td class="mdl-data-table__cell--non-numeric actions">
                    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored save">Save</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- <?= $this->Html->link(__('New Coverage'), ['action' => 'add']) ?> -->
<button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#addCoverage">
  Add New Coverage
</button>

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
<!-- Add Modal -->
<div class="modal fade" id="addCoverage" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Insurance Coverage</h4>
      </div>
      <div class="modal-body">
        <?= 
            $this->Form->control('Coverage_Name', ['type' => 'select', 'options' => ['' => 'Select', 'Auto' => 'Auto', 'Property'=>'Property', 'Legal Expense' => 'Legal Expense'], 'class' => 'form-control', 'id' => 'add-new-coverage-name', 'required' => 'required']);
        ?>
        <span class="error-message-container"></span> 
        <br/>
        <?=
            $this->Form->control('Cost', ['class' => 'form-control', 'id' => 'add-new-coverage-cost', 'required' => 'required']);
        ?>
        <span class="error-message-container"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Close</button>
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored create">Create New Coverage</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteCoverage" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Insurance Coverage</h4>
      </div>
      <div class="modal-body">
        <h2><center>Are you sure you want to delete this coverage?<center></h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" data-dismiss="modal">Close</button>
        <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored delete">Delete Coverage</button>
      </div>
    </div>
  </div>
</div>