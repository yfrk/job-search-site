<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer[]|\Cake\Collection\CollectionInterface $employers
 */
?>
<div class="row flex-fill">
  <div class="col-md-2">

  </div>
  <div class="col-md-8">
    <div class="card mt-4">
      <ul class="list-group list-group-flush">
        <?php foreach ($employers as $employer): ?>
          <li class="list-group-item">
            <div class="row">
              <div class="col-8">
                <h5>
                  <?= $this->Html->link(h($employer->title), ['action' => 'view', $employer->id])?>
                </h5>
              </div>
              <div class="col-4 text-right">
                <?= $this->Html->image($employer->image_path, ['width' => 30, 'height' => 30, 'class' => 'd-inline-block align-top' ])?>
              </div>
            </div>
            <p>
              <?= h($employer->description) ?>
            </p>
            <div class="row">
              <div class="col-md-2">
              </div>
              <div class="col-md-10 text-right">
                <small class="text-muted"><?= h($employer->created); ?></small>
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
