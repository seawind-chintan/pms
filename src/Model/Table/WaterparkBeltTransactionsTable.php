<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkBeltTransactions Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\BeltsTable|\Cake\ORM\Association\BelongsTo $Belts
 * @property \App\Model\Table\KotBillingsTable|\Cake\ORM\Association\BelongsTo $KotBillings
 *
 * @method \App\Model\Entity\WaterparkBeltTransaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkBeltTransaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkBeltTransactionsTable extends Table
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

        $this->setTable('waterpark_belt_transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('Belts', [
//            'foreignKey' => 'belt_id',
//            'joinType' => 'INNER'
//        ]);
//        $this->belongsTo('KotBillings', [
//            'foreignKey' => 'kot_billing_id'
//        ]);
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
            ->integer('transaction_type')
            ->requirePresence('transaction_type', 'create')
            ->notEmpty('transaction_type');

        $validator
            ->decimal('bill_amount')
            ->requirePresence('bill_amount', 'create')
            ->notEmpty('bill_amount');

        $validator
            ->decimal('tax_amount')
            ->requirePresence('tax_amount', 'create')
            ->notEmpty('tax_amount');

        $validator
            ->decimal('net_amount')
            ->requirePresence('net_amount', 'create')
            ->notEmpty('net_amount');

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
//        $rules->add($rules->existsIn(['belt_id'], 'Belts'));
//        $rules->add($rules->existsIn(['kot_billing_id'], 'KotBillings'));

        return $rules;
    }
}
