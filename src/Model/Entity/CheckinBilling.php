<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CheckinBilling Entity
 *
 * @property int $id
 * @property int $checkin_id
 * @property string $bill_number
 * @property float $net_amount
 * @property float $tax_amount
 * @property float $total_amount
 * @property int $bill_status
 * @property string $pay_mode
 * @property string $card_number
 * @property string $card_holder
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Checkin $checkin
 */
class CheckinBilling extends Entity
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
        'checkin_id' => true,
        'bill_number' => true,
        'net_amount' => true,
        'tax_amount' => true,
        'total_amount' => true,
        'bill_status' => true,
        'pay_mode' => true,
        'card_number' => true,
        'card_holder' => true,
        'created' => true,
        'modified' => true,
        'checkin' => true
    ];
}
