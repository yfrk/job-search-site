<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vacancies Model
 *
 * @property \App\Model\Table\EmployersTable&\Cake\ORM\Association\BelongsTo $Employers
 *
 * @method \App\Model\Entity\Vacancy get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vacancy newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vacancy[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vacancy|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vacancy saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vacancy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vacancy[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vacancy findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VacanciesTable extends Table
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

        $this->setTable('vacancies');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Employers', [
            'foreignKey' => 'employer_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsToMany('Responses', [
            'foreignKey' => 'vacancy_id',
            'targetForeignKey' => 'response_id',
            'joinTable' => 'vacancies_responses'
        ]);

        $this->belongsToMany("Tags", [
            "joinTable" => "vacancies_tags",
            'targetForeignKey' => 'tag_id',
            "dependent" => true
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
        $rules->add($rules->existsIn(['employer_id'], 'Employers'));

        return $rules;
    }

    public function isOwnedBy($vacancyId, $employerId)
    {
      return $this->exists(['id' => $vacancyId, 'employer_id' => $employerId]);
    }

    public function findTagged(Query $query, array $options)
    {
        $columns = [
            'Vacancies.id', 'Vacancies.employer_id', 'Vacancies.title',
            'Vacancies.description', 'Vacancies.created', 'Vacancies.modified'
        ];

        $query = $query
               ->select($columns)
               ->distinct($columns);

        if (empty($options['tags'])) {
            $query->leftJoinWith('Tags')
                  ->where(['Tags.title IS' => null]);
        } else {
            $query->innerJoinWith('Tags')
                  ->where(['Tags.title IN' => $options['tags']]);
        }
        return $query->group(['Vacancies.id'])
                     ->leftJoinWith('Employers')
                     ->where(['Employers.id = Vacancies.employer_id'])
                     ->group(['Vacancies.id']);
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->tag_string) {
            $entity->tags = $this->_buildTags($entity->tag_string);
        }
    }

    protected function _buildTags($tagString)
    {
        $newTags = array_map('trim', explode(',', $tagString));

        $newTags = array_filter($newTags);

        $newTags = array_unique($newTags);

        $out = [];
        $query = $this->Tags->find()
                            ->where(['Tags.title IN' => $newTags]);

        foreach ($query->extract('title') as $existing) {
            $index = array_search($existing, $newTags);
            if ($index !== false) {
                unset($newTags[$index]);
            }
        }

        foreach ($query as $tag) {
            $out[] = $tag;
        }

        foreach ($newTags as $tag) {
            $out[] = $this->Tags->newEntity(['title' => $tag]);
        }
        return $out;
    }

}
