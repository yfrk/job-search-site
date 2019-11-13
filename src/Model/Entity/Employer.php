<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Employer Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $description
 * @property string|null $image_path
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Vacancy[] $vacancies
 */
class Employer extends Entity
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
        'description' => true,
        'image_path' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'vacancies' => true
    ];

    protected function _getImagePath($image_path)
    {
        if (empty($image_path)) {
            return 'icons/user.png';
        } else {
            return $image_path;
        }
    }
}
