<?php
use Migrations\AbstractMigration;

class CreateVacanciesResponses extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('vacancies_responses', ['id' => false, 'primary_key' => ['vacancy_id', 'response_id']]);
        $table->addColumn('vacancy_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('response_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('vacancy_id', 'vacancies', 'id');
        $table->addForeignKey('response_id', 'responses', 'id');
        $table->create();
    }
}
