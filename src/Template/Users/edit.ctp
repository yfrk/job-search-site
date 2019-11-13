<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
  <div class="col-md-4">
    <?= $this->Form->create($user) ?>
    <legend><?= __('Edit User') ?></legend>
    <?= $this->Form->control('email', [
      'placeholder' => 'Email',
      'class' => 'mt-2'
    ]) ?>
    <?= $this->Form->control('password', [ 'placeholder' => 'Password', 'class' => 'mt-2' ]) ?>
    <br/>
    <?= $this->Form->button(__('Save Changes'), [ 'class' => 'btn btn-primary mt-2' ]) ?>
    <?= $this->Form->end() ?>
  </div>
</div>
