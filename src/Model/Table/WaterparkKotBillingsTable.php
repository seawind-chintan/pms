<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkKotBillings Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\WaterparkKotsTable|\Cake\ORM\Association\BelongsTo $WaterparkKots
 * @property \App\Model\Table\WaterparkBeltsTable|\Cake\ORM\Association\BelongsTo $WaterparkBelts
 * @property \App\Model\Table\RestaurantKitchensTable|\Cake\ORM\Association\BelongsTo $RestaurantKitchens
 * @property \App\Model\Table\WaterparkKotItemBillingsTable|\Cake\ORM\Association\HasMany $WaterparkKotItemBillings
 *
 * @method \App\Model\Entity\WaterparkKotBilling get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotBilling findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkKotBillingsTable extends Table
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

        $this->setTable('waterpark_kot_billings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WaterparkKots', [
            'foreignKey' => 'waterpark_kot_id',
            'joinType' => 'INNER'
        ]);
//        $this->belongsTo('WaterparkBelts', [
//            'foreignKey' => 'waterpark_belt_id'
//        ]);
        $this->belongsTo('RestaurantKitchens', [
            'foreignKey' => 'restaurant_kitchen_id'
        ]);
        $this->hasMany('WaterparkKotItemBillings', [
            'foreignKey' => 'waterpark_kot_billing_id'
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
            ->integer('waterpark_kot_no')
            ->requirePresence('waterpark_kot_no', 'create')
            ->notEmpty('waterpark_kot_no');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->integer('total_qty')
            ->requirePresence('total_qty', 'create')
            ->notEmpty('total_qty');

        $validator
            ->decimal('total_cgst')
            ->requirePresence('total_cgst', 'create')
            ->notEmpty('total_cgst');

        $validator
            ->decimal('total_sgst')
            ->requirePresence('total_sgst', 'create')
            ->notEmpty('total_sgst');

        $validator
            ->requirePresence('bill_status', 'create')
            ->notEmpty('bill_status');

        $validator
            ->date('bill_date')
            ->requirePresence('bill_date', 'create')
            ->notEmpty('bill_date');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['property_id'], 'Properties'));
        $rules->add($rules->existsIn(['waterpark_kot_id'], 'WaterparkKots'));
//        $rules->add($rules->existsIn(['waterpark_belt_id'], 'WaterparkBelts'));
        $rules->add($rules->existsIn(['restaurant_kitchen_id'], 'RestaurantKitchens'));

        return $rules;
    }
}
