<?php
use Migrations\AbstractMigration;

class CreateVacanciesTags extends AbstractMigration
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
        $table = $this->table('vacancies_tags', ['id' => false, 'primary_key' => ['vacancy_id', 'tag_id']]);
        $table->addColumn('vacancy_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('tag_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('vacancy_id', 'vacancies', 'id');
        $table->addForeignKey('tag_id', 'tags', 'id');
        $table->create();
    }
}
