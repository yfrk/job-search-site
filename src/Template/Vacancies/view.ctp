<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Vacancy $vacancy
 */
?>
<div class="row p-2 flex-fill">
  <div class="col-md-6">
    <h4><?= h($vacancy->title) ?></h4>
    <?= $this->Html->link(h($vacancy->employer->title), ['controller' => 'Employers', 'action' => 'view', $vacancy->employer->id]) ?>
    <br/>
    <?php if($user['role'] == 'employee'): ?>
      <?= $this->Html->link(__('Respond'), ['action' => 'respond', $vacancy->id], ['class' => 'btn btn-success btn-sm mt-4']); ?>
    <?php endif; ?>
    <p class="mt-4">
      <?= $this->Text->autoParagraph(h($vacancy->description)); ?>
    </p>

    <?php if(!empty($vacancy->tags)): ?>
      <?php foreach($vacancy->tags as $tag): ?>
        <a href="#"><span class="badge badge-secondary"><?= h($tag->title); ?></span></a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
