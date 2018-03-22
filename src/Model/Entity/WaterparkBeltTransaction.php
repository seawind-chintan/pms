<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * WaterparkBeltTransaction Entity
 *
 * @property int $id
 * @property int $property_id
 * @property int $belt_id
 * @property int $kot_billing_id
 * @property int $transaction_type
 * @property float $bill_amount
 * @property float $tax_amount
 * @property float $net_amount
 * @property int $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Property $property
 * @property \App\Model\Entity\Belt $belt
 * @property \App\Model\Entity\KotBilling $kot_billing
 */
class WaterparkBeltTransaction extends Entity
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
        'belt_id' => true,
        'kot_billing_id' => true,
        'transaction_type' => true,
        'bill_amount' => true,
        'tax_amount' => true,
        'net_amount' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'property' => true,
        'belt' => true,
        'kot_billing' => true
    ];
}
