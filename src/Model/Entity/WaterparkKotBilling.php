<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkKotBilling Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $property_id
 * @property int $waterpark_kot_id
 * @property int $waterpark_belt_id
 * @property int $restaurant_kitchen_id
 * @property int $waterpark_kot_no
 * @property float $total_amount
 * @property int $total_qty
 * @property float $total_cgst
 * @property float $total_sgst
 * @property int $bill_status
 * @property \Cake\I18n\FrozenDate $bill_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\WaterparkKot $waterpark_kot
 * @property \App\Model\Entity\WaterparkBelt $waterpark_belt
 * @property \App\Model\Entity\RestaurantKitchen $restaurant_kitchen
 * @property \App\Model\Entity\WaterparkKotItemBilling[] $waterpark_kot_item_billings
 */
class WaterparkKotBilling extends Entity
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
        'waterpark_kot_id' => true,
        'waterpark_belt_id' => true,
        'restaurant_kitchen_id' => true,
        'waterpark_kot_no' => true,
        'total_amount' => true,
        'total_qty' => true,
        'total_cgst' => true,
        'total_sgst' => true,
        'bill_status' => true,
        'bill_date' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'property' => true,
        'waterpark_kot' => true,
        'waterpark_belt' => true,
        'restaurant_kitchen' => true,
        'waterpark_kot_item_billings' => true
    ];
}
