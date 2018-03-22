<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkKots Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\RestaurantKitchensTable|\Cake\ORM\Association\BelongsTo $RestaurantKitchens
 * @property \App\Model\Table\WaterparkKotItemsTable|\Cake\ORM\Association\HasMany $WaterparkKotItems
 *
 * @method \App\Model\Entity\WaterparkKot get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkKot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkKot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkKot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkKot findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkKotsTable extends Table
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

        $this->setTable('waterpark_kots');
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
        $this->belongsTo('RestaurantKitchens', [
            'foreignKey' => 'restaurant_kitchen_id'
        ]);
        $this->hasMany('WaterparkKotItems', [
            'foreignKey' => 'waterpark_kot_id'
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
            ->requirePresence('kot_status', 'create')
            ->notEmpty('kot_status');

        $validator
            ->date('kot_date')
            ->requirePresence('kot_date', 'create')
            ->notEmpty('kot_date');

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
        $rules->add($rules->existsIn(['restaurant_kitchen_id'], 'RestaurantKitchens'));

        return $rules;
    }
}
