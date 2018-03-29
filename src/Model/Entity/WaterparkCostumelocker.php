<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkCostumelocker Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property float $costume_price
 * @property float $locker_price
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 */
class WaterparkCostumelocker extends Entity
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
        'costume_price' => true,
        'costume_deposit_price' => true,
        'locker_price' => true,
        'locker_deposit_price' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true
    ];
}
