<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property int $employee_id
 * @property bool|null $viewed
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Employee $employee
 * @property \App\Model\Entity\Vacancy[] $vacancies
 */
class Response extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'employee_id' => true,
        'vacancy_id' => true,
        'viewed' => true,
        'created' => true,
        'modified' => true,
        'employee' => true,
        'vacancies' => true
    ];
}
