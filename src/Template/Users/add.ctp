<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */

$this->layout = false;
?>
<head>
  <?= $this->Html->css('bootstrap.css') ?>
  <?= $this->Html->script('jquery.js') ?>
  <?= $this->Html->script('bootstrap.js') ?>
  <?= $this->Html->css('login.css') ?>
</head>

<body class="text-center">
  <?= $this->Form->create($user, ['class' => 'form-signin']) ?>
  <?= $this->Html->image('icons/logo.svg', [ 'width' => 72, 'height' => 72, 'class' => 'mb-4'])?>
  <h1 class="h3 mb-3 font-weight-normal">Create Account</h1>
  <?php
  echo $this->Form->control('username', ['placeholder' => 'Name', 'class' => 'form-control']);
  echo $this->Form->control('email', ['placeholder' => 'Email', 'class' => 'form-control']);
  echo $this->Form->control('password', ['placeholder' => 'Password', 'class' => 'form-control']);
  ?>
  <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
    <?php
    echo $this->Form->radio('role', [
      'employee' => 'Employee',
      'employer' => 'Employer',
    ], [
      'label' => ['class' => 'btn btn-outline-primary'],
      'label.0' => ['class' => 'btn btn-outline-primary active'],
    ]);
    ?>
  </div>
  <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-lg btn-primary btn-block mb-2']) ?>
  Already have an account?
  <?= $this->Html->link(__('Log in'), ['action' => 'login']) ?>
  <?= $this->Form->end() ?>
</body>
