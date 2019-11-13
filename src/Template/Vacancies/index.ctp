<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vacancy[]|\Cake\Collection\CollectionInterface $vacancies
 */
?>
<div class="row flex-fill">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <div class="card mt-4">
      <ul class="list-group list-group-flush">
        <?php foreach ($vacancies as $vacancy): ?>
          <li class="list-group-item">
            <div class="row">
              <div class="col-8">
                <?= $this->Html->link(h($vacancy->title), ['action' => 'view', $vacancy->id])?>
                <br/>
                <small class="text-muted">
                  <?= h($vacancy->employer->title) ?>
                </small>
              </div>
              <div class="col-4 text-right">
                <?= $this->Html->image($vacancy->employer->image_path, ['class' => 'd-inline-block align-top', 'width' => 60, 'height' => 60]) ?>
              </div>
            </div>
            <p class="mt-2">
              <?= h($vacancy->description) ?>
            </p>
            <div class="row">
              <div class="col-md-2">
                <?php if($user['role'] == 'employee'): ?>
                  <?= $this->Html->link(__('Respond'), ['action' => 'respond', $vacancy->id]); ?>
                <?php endif; ?>
              </div>
              <div class="col-md-10 text-right">
                <small class="text-muted"><?= h($vacancy->created); ?></small>
              </div>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
  <div class="col-md-2">

  </div>
</div>
