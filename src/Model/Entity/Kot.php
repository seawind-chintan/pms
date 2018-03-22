<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Kot Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $kot_no
 * @property int $restaurant_table_id
 * @property int $restaurant_table_code
 * @property int $no_of_pax
 * @property string $steward
 * @property string $nc_kot
 * @property string $remark
 * @property string $split
 * @property float $amount
 * @property string $total_qty
 * @property string $bill_paid
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\RestaurantTable $restaurant_table
 * @property \App\Model\Entity\KotItem[] $kot_items
 */
class Kot extends Entity
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
        'property_id' => true,
        'kot_no' => true,
        'restaurant_table_id' => true,
        'restaurant_table_code' => true,
        'no_of_pax' => true,
        'steward' => true,
        'nc_kot' => true,
        'remark' => true,
        'split' => true,
        'amount' => true,
        'total_qty' => true,
        'kot_status' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'restaurant_table' => true,
        'kot_items' => true
    ];
}
