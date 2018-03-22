<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * KotItem Entity
 *
 * @property int $id
 * @property int $kot_id
 * @property int $kot_no
 * @property int $restaurant_table_id
 * @property int $restaurant_waiter_id
 * @property int $restaurant_kitchen_id
 * @property int $restaurant_menu_id
 * @property string $menu_code
 * @property string $menu_name
 * @property string $qty
 * @property float $menu_price
 * @property string $remarks
 * @property string $bill_paid
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Kot $kot
 * @property \App\Model\Entity\RestaurantTable $restaurant_table
 * @property \App\Model\Entity\RestaurantWaiter $restaurant_waiter
 * @property \App\Model\Entity\RestaurantKitchen $restaurant_kitchen
 * @property \App\Model\Entity\RestaurantMenu $restaurant_menu
 */
class KotItem extends Entity
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
        'kot_id' => true,
        'kot_no' => true,
        'restaurant_table_id' => true,
        'restaurant_waiter_id' => true,
        'restaurant_kitchen_id' => true,
        'restaurant_menu_id' => true,
        'menu_code' => true,
        'menu_name' => true,
        'qty' => true,
        'menu_price' => true,
        'remarks' => true,
        'created' => true,
        'modified' => true,
        'kot' => true,
        'restaurant_table' => true,
        'restaurant_waiter' => true,
        'restaurant_kitchen' => true,
        'restaurant_menu' => true
    ];
}
