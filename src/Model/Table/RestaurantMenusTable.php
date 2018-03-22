<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RestaurantMenus Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\RestaurantKitchensTable|\Cake\ORM\Association\BelongsTo $RestaurantKitchens
 * @property \App\Model\Table\RestaurantMenuTypesTable|\Cake\ORM\Association\BelongsTo $RestaurantMenuTypes
 *
 * @method \App\Model\Entity\RestaurantMenu get($primaryKey, $options = [])
 * @method \App\Model\Entity\RestaurantMenu newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RestaurantMenu[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantMenu|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RestaurantMenu patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantMenu[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RestaurantMenu findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RestaurantMenusTable extends Table
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

        $this->setTable('restaurant_menus');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantKitchens', [
            'foreignKey' => 'restaurant_kitchen_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantMenuTypes', [
            'foreignKey' => 'restaurant_menu_type_id',
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
            ->scalar('menu_category')
            ->maxLength('menu_category', 255)
            ->requirePresence('menu_category', 'create')
            ->notEmpty('menu_category');

        $validator
            ->scalar('code')
            ->maxLength('code', 255)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmpty('description');

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
        $rules->add($rules->existsIn(['restaurant_kitchen_id'], 'RestaurantKitchens'));
        $rules->add($rules->existsIn(['restaurant_menu_type_id'], 'RestaurantMenuTypes'));

        return $rules;
    }
}
