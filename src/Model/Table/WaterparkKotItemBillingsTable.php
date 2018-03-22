<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkKotItemBillings Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\WaterparkKotsTable|\Cake\ORM\Association\BelongsTo $WaterparkKots
 * @property \App\Model\Table\WaterparkKotBillingsTable|\Cake\ORM\Association\BelongsTo $WaterparkKotBillings
 * @property \App\Model\Table\RestaurantKitchensTable|\Cake\ORM\Association\BelongsTo $RestaurantKitchens
 * @property \App\Model\Table\RestaurantMenusTable|\Cake\ORM\Association\BelongsTo $RestaurantMenus
 *
 * @method \App\Model\Entity\WaterparkKotItemBilling get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKotItemBilling findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkKotItemBillingsTable extends Table
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

        $this->setTable('waterpark_kot_item_billings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WaterparkKots', [
            'foreignKey' => 'waterpark_kot_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('WaterparkKotBillings', [
            'foreignKey' => 'waterpark_kot_billing_id'
        ]);
        $this->belongsTo('RestaurantKitchens', [
            'foreignKey' => 'restaurant_kitchen_id'
        ]);
        $this->belongsTo('RestaurantMenus', [
            'foreignKey' => 'restaurant_menu_id',
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
            ->integer('waterpark_kot_no')
            ->requirePresence('waterpark_kot_no', 'create')
            ->notEmpty('waterpark_kot_no');

        $validator
            ->scalar('menu_code')
            ->maxLength('menu_code', 255)
            ->requirePresence('menu_code', 'create')
            ->notEmpty('menu_code');

        $validator
            ->scalar('menu_name')
            ->maxLength('menu_name', 255)
            ->requirePresence('menu_name', 'create')
            ->notEmpty('menu_name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->integer('qty')
            ->requirePresence('qty', 'create')
            ->notEmpty('qty');

        $validator
            ->decimal('total_price')
            ->requirePresence('total_price', 'create')
            ->notEmpty('total_price');

        $validator
            ->decimal('cgst')
            ->requirePresence('cgst', 'create')
            ->notEmpty('cgst');

        $validator
            ->decimal('sgst')
            ->requirePresence('sgst', 'create')
            ->notEmpty('sgst');

        $validator
            ->date('kot_item_date')
            ->requirePresence('kot_item_date', 'create')
            ->notEmpty('kot_item_date');

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
        $rules->add($rules->existsIn(['waterpark_kot_id'], 'WaterparkKots'));
        $rules->add($rules->existsIn(['waterpark_kot_billing_id'], 'WaterparkKotBillings'));
        $rules->add($rules->existsIn(['restaurant_kitchen_id'], 'RestaurantKitchens'));
        $rules->add($rules->existsIn(['restaurant_menu_id'], 'RestaurantMenus'));

        return $rules;
    }
}
