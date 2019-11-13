<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employee $employee
 */
?>
<div class="row">
  <div class="col">
    <?= $this->Html->image(
      $employee->image_path, [ 'class' => 'd-inline-block align-top', 'width' => 80, 'height' => 80]) ?>

    <?= h($employee->title) ?>
    <?php if($employee->age > 0): ?>
      , <?= h($employee->age) ?> years
    <?php endif; ?>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <h5>About</h5>
    <p>
      <?= h($employee->description) ?>
    </p>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <h5>Skills</h5>
    <?php foreach($employee->skills as $skill): ?>
      <a href="#"><span class="badge badge-secondary"><?= h($skill->title) ?></span></a>
    <?php endforeach; ?>
  </div>
</div>
<div class="row mt-2">
  <div class="col">
    <p>
      <a href="mailto:<?= h($employee->user->email) ?>">Send Message</a>
    </p>
  </div>
</div>
