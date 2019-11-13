<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row p-2 flex-fill mt-4">
  <?= $this->Form->create($employee, ['class' => 'w-100', 'type' => 'file']) ?>
  <div class="col-md-8">
    <div class="row">
      <div id="title" class="col">
        <h3>
          <div>
            <?= $this->Html->image($employee->image_path, ['width' => 64, 'height' => 64, 'class' => 'd-inline-block align-top']); ?>
            <span class="upload badge badge-secondary">upload</span>
          </div>
          <?= $this->Form->input('upload', ['type' => 'file', 'accept' => 'image/*', 'style' => 'display: none;' ]); ?>
          <span class="title">
            <?= h($employee->title); ?>
          </span>
          <span class="edit badge badge-secondary">edit</span>
          <?= $this->Form->control('title', ['style' => 'display: none;']) ?>
        </h3>
      </div>
    </div>
    <div class="row mt-2">
      <div id="age" class="col">
        Age
        <span class="age"><?= h($employee->age); ?></span>
        <?= $this->Form->control('age', ['type' => 'number', 'style' => 'display: none;']) ?>
        <span class="edit badge badge-secondary">edit</span>
      </div>
    </div>
    <div class="row mt-2">
      <div id="description" class="col">
        <h5>
          About
          <span class="edit badge badge-secondary">edit</span>
        </h5>
        <p><?= h($employee->description) ?></p>
        <div class="input-group">
          <?= $this->Form->textarea('description', ['style' => 'display: none;']) ?>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div id="tags" class="col">
        <h5>
          Skills
          <span class="edit badge badge-secondary">edit</span>
        </h5>
        <?= $this->Form->control('skill_string', ['type' => 'text', 'style' => 'display: none;']); ?>
        <div class="taglist">
          <?php foreach($employee->skills as $skill): ?>
            <a href="#"><span class="tag badge badge-secondary"><?= h($skill->title); ?></span></a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-primary mt-2']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

<?= $this->Html->script('edit.js'); ?>
