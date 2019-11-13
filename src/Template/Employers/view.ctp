<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Employer $employer
 */
?>
<div class="row p-2 flex-fill">
  <div class="col-md-6">
    <h4>
      <?= h($employer->title); ?>
    </h4>
    <p class="mt-4">
      <?= h($employer->description); ?>
    </p>
    <div class="card">
      <div class="card-header">
        Vacancies
      </div>

      <?php if (!empty($employer->vacancies)): ?>
        <ul class="list-group list-group-flush">
          <?php foreach ($employer->vacancies as $vacancies): ?>
            <li class="list-group-item">
              <h5>
                <?= $this->Html->link(__(h($vacancies->title)), ['controller' => 'Vacancies', 'action' => 'view', $vacancies->id]) ?>
              </h5>
              <p><?= h($vacancies->description) ?></p>
              <small class="text-muted">
                <?=    h($vacancies->created) ?>
              </small>
            </li>

          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
