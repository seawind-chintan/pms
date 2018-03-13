<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkPrices Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\WaterparkPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkPrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkPrice findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkPricesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('waterpark_prices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('monday_total_price')
            ->requirePresence('monday_total_price', 'create')
            ->notEmpty('monday_total_price');

        $validator
            ->decimal('monday_ticket_price')
            ->requirePresence('monday_ticket_price', 'create')
            ->notEmpty('monday_ticket_price');

        $validator
            ->decimal('tuesday_total_price')
            ->requirePresence('tuesday_total_price', 'create')
            ->notEmpty('tuesday_total_price');

        $validator
            ->decimal('tuesday_ticket_price')
            ->requirePresence('tuesday_ticket_price', 'create')
            ->notEmpty('tuesday_ticket_price');

        $validator
            ->decimal('wednesday_total_price')
            ->requirePresence('wednesday_total_price', 'create')
            ->notEmpty('wednesday_total_price');

        $validator
            ->decimal('wednesday_ticket_price')
            ->requirePresence('wednesday_ticket_price', 'create')
            ->notEmpty('wednesday_ticket_price');

        $validator
            ->decimal('thursday_total_price')
            ->requirePresence('thursday_total_price', 'create')
            ->notEmpty('thursday_total_price');

        $validator
            ->decimal('thursday_ticket_price')
            ->requirePresence('thursday_ticket_price', 'create')
            ->notEmpty('thursday_ticket_price');

        $validator
            ->decimal('friday_total_price')
            ->requirePresence('friday_total_price', 'create')
            ->notEmpty('friday_total_price');

        $validator
            ->decimal('friday_ticket_price')
            ->requirePresence('friday_ticket_price', 'create')
            ->notEmpty('friday_ticket_price');

        $validator
            ->decimal('saturday_total_price')
            ->requirePresence('saturday_total_price', 'create')
            ->notEmpty('saturday_total_price');

        $validator
            ->decimal('saturday_ticket_price')
            ->requirePresence('saturday_ticket_price', 'create')
            ->notEmpty('saturday_ticket_price');

        $validator
            ->decimal('sunday_total_price')
            ->requirePresence('sunday_total_price', 'create')
            ->notEmpty('sunday_total_price');

        $validator
            ->decimal('sunday_ticket_price')
            ->requirePresence('sunday_ticket_price', 'create')
            ->notEmpty('sunday_ticket_price');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['property_id'], 'Properties'));
        $rules->add($rules->isUnique(['property_id'], 'Prices for this property already added. If you want to change some, just edit it!'));

        $mondayticketpricecheck = function($order) {
            return $order->monday_ticket_price < $order->monday_total_price;
        };
        $rules->add($mondayticketpricecheck, [
            'errorField' => 'monday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $tuesdayticketpricecheck = function($order) {
            return $order->tuesday_ticket_price < $order->tuesday_total_price;
        };
        $rules->add($tuesdayticketpricecheck, [
            'errorField' => 'tuesday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $wednesdayticketpricecheck = function($order) {
            return $order->wednesday_ticket_price < $order->wednesday_total_price;
        };
        $rules->add($wednesdayticketpricecheck, [
            'errorField' => 'wednesday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $thursdayticketpricecheck = function($order) {
            return $order->thursday_ticket_price < $order->thursday_total_price;
        };
        $rules->add($thursdayticketpricecheck, [
            'errorField' => 'thursday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $fridayticketpricecheck = function($order) {
            return $order->friday_ticket_price < $order->friday_total_price;
        };
        $rules->add($fridayticketpricecheck, [
            'errorField' => 'friday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $saturdayticketpricecheck = function($order) {
            return $order->saturday_ticket_price < $order->saturday_total_price;
        };
        $rules->add($saturdayticketpricecheck, [
            'errorField' => 'saturday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        $sundayticketpricecheck = function($order) {
            return $order->sunday_ticket_price < $order->sunday_total_price;
        };
        $rules->add($sundayticketpricecheck, [
            'errorField' => 'sunday_ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        return $rules;
    }
}
