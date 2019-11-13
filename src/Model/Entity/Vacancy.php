<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Vacancy Entity
 *
 * @property int $id
 * @property int $employer_id
 * @property string|null $title
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Employer $employer
 */
class Vacancy extends Entity
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
        'employer_id' => true,
        'title' => true,
        'description' => true,
        'created' => true,
        'modified' => true,
        'employer' => true,
        'responses_unread' => false,
        'tags' => true,
        'tag_string' => true
    ];


    protected function _getTagString()
    {
        if (isset($this->_properties['tag_string'])) {
            return $this->_properties['tag_string'];
        }

        if (empty($this->tags)) {
            return '';
        }

        $tags = new Collection($this->tags);
        $str = $tags->reduce(function ($string, $tag) {
            return $string . $tag->title . ', ';
        }, '');
        return trim($str, ', ');
    }

    protected function _getResponsesUnread($responses)
    {
        $unread = [];
        foreach ($this->responses as $resp) {
            if (!$resp['viewed']) {
                $unread[] = $resp;
            }
        }
        return $unread;
    }
}
