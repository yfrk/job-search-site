<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
    <?= $this->Html->css('login.css') ?>
  </head>

  <body class="text-center">
    <?= $this->Form->create(null, ['class' => 'form-signin']) ?>
    <?= $this->Html->image('icons/logo.svg', [ 'width' => 72, 'height' => 72, 'class' => 'mb-4'])?>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

    <?= $this->Form->control('email', ['placeholder' => 'Email', 'class' => 'form-control']) ?>
    <?= $this->Form->control('password', ['placeholder' => 'Password', 'class' => 'form-control']) ?>
    <?= $this->Form->button('Login', ['class' => 'btn btn-lg btn-primary btn-block mb-2']) ?>

    <?= $this->Html->link(__('Create Account'), ['action' => 'add']) ?>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2019</p>
    <?= $this->Form->end() ?>
  </body>
</html>
