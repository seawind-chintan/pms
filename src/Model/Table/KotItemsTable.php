<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * KotItems Model
 *
 * @property \App\Model\Table\KotsTable|\Cake\ORM\Association\BelongsTo $Kots
 * @property \App\Model\Table\RestaurantTablesTable|\Cake\ORM\Association\BelongsTo $RestaurantTables
 * @property \App\Model\Table\RestaurantWaitersTable|\Cake\ORM\Association\BelongsTo $RestaurantWaiters
 * @property \App\Model\Table\RestaurantKitchensTable|\Cake\ORM\Association\BelongsTo $RestaurantKitchens
 * @property \App\Model\Table\RestaurantMenusTable|\Cake\ORM\Association\BelongsTo $RestaurantMenus
 *
 * @method \App\Model\Entity\KotItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\KotItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\KotItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\KotItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\KotItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\KotItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\KotItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KotItemsTable extends Table
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

        $this->setTable('kot_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Kots', [
            'foreignKey' => 'kot_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantTables', [
            'foreignKey' => 'restaurant_table_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantWaiters', [
            'foreignKey' => 'restaurant_waiter_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantKitchens', [
            'foreignKey' => 'restaurant_kitchen_id',
            'joinType' => 'INNER'
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
            ->integer('kot_no')
            ->requirePresence('kot_no', 'create')
            ->notEmpty('kot_no');

        $validator
            ->scalar('menu_code')
            ->maxLength('menu_code', 255)
            ->requirePresence('menu_code', 'create')
            ->allowEmpty('menu_code');

        $validator
            ->scalar('menu_name')
            ->maxLength('menu_name', 255)
            ->requirePresence('menu_name', 'create')
            ->notEmpty('menu_name');

        $validator
            ->scalar('qty')
            ->maxLength('qty', 10)
            ->requirePresence('qty', 'create')
            ->notEmpty('qty');

        $validator
            ->decimal('menu_price')
            ->requirePresence('menu_price', 'create')
            ->notEmpty('menu_price');

        $validator
            ->scalar('remarks')
            ->allowEmpty('remarks');

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
        $rules->add($rules->existsIn(['kot_id'], 'Kots'));
        $rules->add($rules->existsIn(['restaurant_table_id'], 'RestaurantTables'));
        $rules->add($rules->existsIn(['restaurant_waiter_id'], 'RestaurantWaiters'));
        $rules->add($rules->existsIn(['restaurant_kitchen_id'], 'RestaurantKitchens'));
        $rules->add($rules->existsIn(['restaurant_menu_id'], 'RestaurantMenus'));

        return $rules;
    }
}
