<?php
use Migrations\AbstractMigration;

class AddViewedToResponses extends AbstractMigration
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
        $table = $this->table('responses');
        $table->addColumn('viewed', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->update();
    }
}
