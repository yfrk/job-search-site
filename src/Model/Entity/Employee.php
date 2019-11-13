<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;
/**
 * Employee Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image_path
 * @property string|null $cvfile_path
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Employee extends Entity
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
        'user_id' => true,
        'title' => true,
        'city' => true,
        'age' => true,
        'description' => true,
        'image_path' => true,
        'cvfile_path' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'skills' => true,
        'skill_string' => true
    ];

    protected function _getImagePath($image_path)
    {
        if (empty($image_path)) {
            return 'icons/user.png';
        } else {
            return $image_path;
        }
    }

    protected function _getSkillString()
    {
        if (isset($this->_properties['skill_string'])) {
            return $this->_properties['skill_string'];
        }

        if (empty($this->skills)) {
            return '';
        }

        $skills = new Collection($this->skills);
        $str = $skills->reduce(function ($string, $skill) {
            return $string . $skill->title . ', ';
        }, '');
        return trim($str, ', ');
    }
}
