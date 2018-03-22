<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkTax Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $restaurant_menu_type_id
 * @property float $cgst
 * @property float $sgst
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\RestaurantMenuType $restaurant_menu_type
 */
class WaterparkTax extends Entity
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
        'restaurant_menu_type_id' => true,
        'cgst' => true,
        'sgst' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'restaurant_menu_type' => true
    ];
}
