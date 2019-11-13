<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer $employer
 */
?>
<div class="row p-2 flex-fill mt-4">
  <?= $this->Form->create($employer, ['class' => 'w-100', 'type' => 'file']) ?>
  <div class="col-md-8">
    <div class="row">
      <div id="title" class="col">
        <h3>
          <div>
            <?= $this->Html->image($employer->image_path, ['width' => 64, 'height' => 64, 'class' => 'd-inline-block align-top']); ?>
            <span class="upload badge badge-secondary">upload</span>
          </div>
          <?= $this->Form->input('upload', ['type' => 'file', 'accept' => 'image/*', 'style' => 'display: none;' ]); ?>
          <span class="title">
            <?= h($employer->title); ?>
          </span>
          <span class="edit badge badge-secondary">edit</span>
          <?= $this->Form->control('title', ['style' => 'display: none;']) ?>
        </h3>
      </div>
    </div>
    <div class="row mt-2">
      <div id="description" class="col">
        <h5>
          About
          <span class="edit badge badge-secondary">edit</span>
        </h5>
        <p><?= h($employer->description) ?></p>
        <div class="input-group">
          <?= $this->Form->textarea('description', ['style' => 'display: none;']) ?>
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col">
        <div class="card">
          <div class="card-header">
            Vacancies <?= $this->Html->link(__('New'), ['controller' => 'Vacancies', 'action' => 'add'], ['class' => 'btn btn-success']); ?>
          </div>
          <?php if(!empty($employer->vacancies)): ?>
            <?php foreach ($employer->vacancies as $vacancy): ?>
              <ul class="list-group list-group-flush">

                <li class="list-group-item">
                  <h5>
                    <?= $this->Html->link(h($vacancy->title), ['controller' => 'Vacancies', 'action' => 'edit', $vacancy->id]) ?>
                  </h5>
                  <p>
                    <?= h($vacancy->description); ?>
                  </p>
                  <small class="text-muted"><?= h($vacancy->created); ?></small>
                </li>
              </ul>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="card-body">
              <?= $this->Html->link(__('Create Vacancy'), ['controller' => 'Vacancies', 'action' => 'add']) ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <?= $this->Form->button(__('Save Changes'), ['class' => 'btn btn-primary mt-2']) ?>
    <?= $this->Form->end() ?>
  </div>
</div>

<?= $this->Html->script('edit.js'); ?>
