<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkSpecificPrices Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 *
 * @method \App\Model\Entity\WaterparkSpecificPrice get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkSpecificPrice findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkSpecificPricesTable extends Table
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

        $this->setTable('waterpark_specific_prices');
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
            ->integer('type')
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->date('single_date')
            ->allowEmpty('single_date');

        $validator
            ->date('from_date')
            ->allowEmpty('from_date');

        $validator
            ->date('to_date')
            ->allowEmpty('to_date');

        $validator
            ->decimal('total_price')
            ->requirePresence('total_price', 'create')
            ->notEmpty('total_price');

        $validator
            ->decimal('ticket_price')
            ->requirePresence('ticket_price', 'create')
            ->notEmpty('ticket_price');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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

        $rules->add($rules->isUnique(['single_date', 'property_id', 'type'], 'Price for this date already exist !'));

        $rules->add($rules->isUnique(['from_date', 'to_date', 'property_id', 'type'], 'Price for this date range already exist !'));
        $rules->add($rules->isUnique(['to_date', 'from_date', 'property_id', 'type'], 'Price for this date range already exist !'));

        $singledatecheck = function($order) {
            if(empty($order->single_date) && empty($order->type)){
                return false;
            } else {
                return true;
            }
        };
        $rules->add($singledatecheck, [
            'errorField' => 'single_date',
            'message' => 'Single Date Should Not Empty !'
        ]);

        $ticketpricecheck = function($order) {
            return $order->ticket_price < $order->total_price;
        };
        $rules->add($ticketpricecheck, [
            'errorField' => 'ticket_price',
            'message' => 'Ticket Price should be lesser than Total Price !'
        ]);

        return $rules;
    }
}
