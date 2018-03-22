<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkKot Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property int $restaurant_kitchen_id
 * @property int $waterpark_kot_no
 * @property float $total_amount
 * @property int $total_qty
 * @property int $kot_status
 * @property \Cake\I18n\FrozenDate $kot_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\RestaurantKitchen $restaurant_kitchen
 * @property \App\Model\Entity\WaterparkKotItem[] $waterpark_kot_items
 */
class WaterparkKot extends Entity
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
        'restaurant_kitchen_id' => true,
        'waterpark_kot_no' => true,
        'total_amount' => true,
        'total_qty' => true,
        'kot_status' => true,
        'kot_date' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'property' => true,
        'restaurant_kitchen' => true,
        'waterpark_kot_items' => true
    ];
}
