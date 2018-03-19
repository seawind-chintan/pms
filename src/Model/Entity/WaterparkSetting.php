<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkSetting Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property string $belt_code_prefix
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Property $property
 */
class WaterparkSetting extends Entity
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
        'property_id' => true,
        'belt_code_prefix' => true,
        'ticket_code_prefix' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'property' => true
    ];
}
