<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Employees Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Employee get($primaryKey, $options = [])
 * @method \App\Model\Entity\Employee newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Employee[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Employee|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Employee patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Employee[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Employee findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EmployeesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('employees');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Responses', [
            'foreignKey' => 'employee_id'
        ]);

        $this->belongsToMany('Skills', [
            'foreignKey' => 'employee_id',
            'targetForeignKey' => 'skill_id',
            'joinTable' => 'employees_skills'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->allowEmptyString('title');

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

        $validator
            ->scalar('city')
            ->allowEmptyString('city');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 255)
            ->allowEmptyFile('image_path');

        $validator
            ->scalar('cvfile_path')
            ->maxLength('cvfile_path', 255)
            ->allowEmptyFile('cvfile_path');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function getEmployeeByUserId($userId)
    {
      $employee = $this->find()->where(['Employees.user_id' => $userId])->firstOrFail();
      return $employee;
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->skill_string) {
            $entity->skills = $this->_buildSkills($entity->skill_string);
        }
    }

    protected function _buildSkills($skillString)
    {
        $newSkills = array_map('trim', explode(',', $skillString));

        $newSkills = array_filter($newSkills);

        $newSkills = array_unique($newSkills);

        $out = [];
        $query = $this->Skills->find()
                            ->where(['Skills.title IN' => $newSkills]);

        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newSkills);
            if ($index !== false) {
                unset($newSkills[$index]);
            }
        }

        foreach ($query as $skill) {
            $out[] = $skill;
        }

        foreach ($newSkills as $skill) {
            $out[] = $this->Skills->newEntity(['title' => $skill]);
        }
        return $out;
    }
}
