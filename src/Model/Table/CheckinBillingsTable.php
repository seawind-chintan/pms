<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CheckinBillings Model
 *
 * @property \App\Model\Table\CheckinsTable|\Cake\ORM\Association\BelongsTo $Checkins
 *
 * @method \App\Model\Entity\CheckinBilling get($primaryKey, $options = [])
 * @method \App\Model\Entity\CheckinBilling newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CheckinBilling[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CheckinBilling|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CheckinBilling patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinBilling[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CheckinBilling findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CheckinBillingsTable extends Table
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

        $this->setTable('checkin_billings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Checkins', [
            'foreignKey' => 'checkin_id',
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
            ->scalar('bill_number')
            ->maxLength('bill_number', 100)
            ->requirePresence('bill_number', 'create')
            ->notEmpty('bill_number');

        $validator
            ->decimal('net_amount')
            ->requirePresence('net_amount', 'create')
            ->notEmpty('net_amount');

        $validator
            ->decimal('tax_amount')
            ->requirePresence('tax_amount', 'create')
            ->notEmpty('tax_amount');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->integer('bill_status')
            ->requirePresence('bill_status', 'create')
            ->notEmpty('bill_status');

        $validator
            ->scalar('pay_mode')
            ->allowEmpty('pay_mode');

        $validator
            ->scalar('card_number')
            ->maxLength('card_number', 50)
            ->allowEmpty('card_number');

        $validator
            ->scalar('card_holder')
            ->maxLength('card_holder', 150)
            ->allowEmpty('card_holder');

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
        $rules->add($rules->existsIn(['checkin_id'], 'Checkins'));

        return $rules;
    }
}
