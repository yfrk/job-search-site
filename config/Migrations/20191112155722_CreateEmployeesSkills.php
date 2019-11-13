<?php
use Migrations\AbstractMigration;

class CreateEmployeesSkills extends AbstractMigration
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
        $table = $this->table('employees_skills', ['id' => false, 'primary_key' => ['employee_id', 'skill_id']]);
        $table->addColumn('employee_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('skill_id', 'integer', [
            'default' => null,
            'limit' => 11,
            'null' => false,
        ]);
        $table->addForeignKey('employee_id', 'employees', 'id');
        $table->addForeignKey('skill_id', 'skills', 'id');
        $table->create();
    }
}
