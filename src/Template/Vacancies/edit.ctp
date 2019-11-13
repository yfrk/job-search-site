<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vacancy $vacancy
 */
?>
<div class="row p-2 flex-fill">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <?= $this->Form->create($vacancy) ?>
    <div class="card">
      <div class="card-header">
        Edit Vacancy
      </div>
      <div class="card-body">
        <br/>
        Title
        <br/>
        <?= $this->Form->control('title'); ?>
        <br/>
        Description
        <div class="input-group">
          <?= $this->Form->textarea('description'); ?>
        </div>
        Tags
        <br/>
        <?= $this->Form->control('tag_string', ['type' => 'text']) ?>
        <br/>
        <?= $this->Form->button(__('Save changed'), ['class' => 'btn btn-success mt-4']) ?>
      </div>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div>
