<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee[]|\Cake\Collection\CollectionInterface $employees
 */
?>
<div class="row flex-fill">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <div class="card mt-4">
      <ul class="list-group list-group-flush">
        <?php foreach ($employees as $employee): ?>
          <li class="list-group-item">
            <div class="row">
              <div class="col-8">
                <h5>
                  <?= $this->Html->link(h($employee->title), ['action' => 'view', $employee->id]) ?>
                </h5>
                <?php if($employee->age > 0): ?>
                  <small class="text-muted">Age</small>
                  <br/>
                  <small><?= $employee->age ?></small>
                  <br/>
                <?php endif; ?>
              </div>
              <div class="col-4 text-right">
                <?= $this->Html->image(
                  $employee->image_path, [ 'class' => 'd-inline-block align-top', 'width' => 80, 'height' => 80]) ?>
              </div>
            </div>
            <small class="text-muted">About</small>
            <p>
              <?= h($employee->description); ?>
            </p>
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-10 text-right">
                <small class="text-muted"><?= h($employee->created); ?></small>
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
