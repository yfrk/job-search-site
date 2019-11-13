<?php

?>
<?= $this->Form->create() ?>
<?= $this->Form->end() ?>

<div class="row p-2 flex-fill">
  <div class="col-md-6">
    <h4>
      <?= h($employer->title); ?>
    </h4>
    <div class="card">
      <div class="card-header">
        Responses
      </div>

      <?php if (!empty($employer->vacancies)): ?>
        <ul class="list-group list-group-flush">
          <?php foreach ($employer->vacancies as $vacancy): ?>
            <?php foreach ($vacancy->responses as $response): ?>
              <li class="list-group-item">
                <p class="<?= $response->viewed ? 'text-muted' : '' ?>">
                  <?php $employee = $response->employee ?>
                  <?= $this->Html->link(__(h($employee->title)), ['controller' => 'Employees', 'action' => 'view', $employee->id]) ?>
                  responsed in
                  <?= $this->Html->link(__(h($vacancy->title)), ['controller' => 'Vacancies', 'action' => 'view', $vacancy->id]) ?>
                </p>
              </li>
            <?php endforeach; ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
<script>
 $(document).ready(function(){
   $.ajax({
     method: 'POST',
     headers: {
       'X-CSRF-Token': $('[name="_csrfToken"]').val()
     },
     url: '/employers/responses/<?= $employer->user->id ?>',
     data: {
       _method: 'POST',
       _csrfToken: $('[name="_csrfToken"]').val(),
       '_Token[fields]': $('[name^="_Token"]')[0].value,
       '_Token[unlocked]': $('[name^="_Token"]')[1].value
     },
     dataType: "json",
     context: document.body
   }).done(function(data) {
     console.log("success");
   }).fail(function() {
     console.log("fail");
   });
 });

</script>
