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

$cakeDescription = 'Job Search';
$userId = $this->Session->read('Auth.User.id');
$roles = ['employer' => 'Employers', 'employee' => 'Employees'];

if ($userId) {
  $role = $this->Session->read('Auth.User.role');
  $controller = $roles[$role];
  $controller = $controller ? $controller : 'Users';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?= $cakeDescription ?>:
      <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->script('jquery.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
  </head>
  <body>
    <div id="nav" class="navbar navbar-light bg-light border-bottom w-100">
      <a class="navbar-brand" href="/">
        <?= $this->Html->image('icons/logo.svg',[ 'width' => 30, 'height' => 30, 'class' => 'd-inline-block align-top']) ?>
        Job Search
      </a>



      <?php if ($this->Session->read('Auth.User')): ?>
        <div class="dropdown show">
          <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            My Account
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <?php if(isset($role) && $role === 'employer'): ?>
              <a href="<?= $this->Url->build(['controller' => 'Employers', 'action' => 'responses', $userId]) ?>"
                 class="dropdown-item">
                Responses
                <div id="responseCount" class="badge badge-danger"></div>
              </a>
            <?php endif; ?>
            <?= $this->Html->link(
              'Profile',
              ['controller' => $controller, 'action' => 'edit', $userId],
              ['class' => 'dropdown-item']);
            ?>
            <?= $this->Html->link('Edit',
                                  ['controller' => 'Users', 'action' => 'edit', $userId],
                                  ['class' => 'dropdown-item']
            ) ?>
            <div class="dropdown-divider"></div>
            <?= $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
          </div>
        </div>
      <?php else: ?>
        <div class="btn-group" role="group">
          <?= $this->Html->link('Sign In', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-outline-info']) ?>
          <?= $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'add'], ['class' => 'btn btn-outline-info']) ?>
        </div>
      <?php endif; ?>
    </div>

    <div id="frame" class="d-flex flex-column">
      <div id="framePadding" class="p-2"></div>
      <div id="mainFrame" class="p-2 flex-fill d-flex flex-column">
        <div class="container-fluid flex-fill d-flex flex-column">
          <?= $this->Flash->render() ?>
          <?= $this->fetch('content') ?>
        </div>
      </div>
    </div>

    <?php if(isset($role) && $role === 'employer'): ?>
      <?= $this->Html->link('', ['controller' => 'Employers', 'action' => 'meta', $userId], ['id' => 'employerMetaLink', 'style' => 'display: none;']); ?>
      <?= $this->Html->script('employer.js') ?>
    <?php endif; ?>
  </body>
</html>
