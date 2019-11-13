<div class="row p-2 flex-fill align-items-center">
  <div class="col-md-2"></div>
  <div class="col-md-8 input-group">
    <?= $this->Form->create('', ['action' => 'vacancies', 'method' => 'get', 'class' => 'w-100']) ?>
    <div class="input-group input-group-lg w-100">
      <?= $this->Form->search('search') ?>
    </div>
    <?= $this->Form->end() ?>
  </div>
  <div class="col-md-2"></div>
</div>
<div class="row p-2 flex-fill">
  <div class="col-md-2">

  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Find Job</h5>
        <p class="card-text">Sequi et molestiae autem ut veritatis dolorem. </p>
        <?= $this->Html->link(__('Vacancies'), ['controller' => 'Vacancies'], ['class' => 'btn btn-primary']); ?>
      </div>
    </div>
  </div>
  <div class="col-md-2">
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Find Employees</h5>
        <p class="card-text">Temporibus ratione asperiores at dolorem. Sit excepturi </p>
        <?= $this->Html->link(__('Employees'), ['controller' => 'Employees'], ['class' => 'btn btn-primary']); ?>
      </div>
    </div>
  </div>
  <div class="col-md-2">

  </div>
</div>
