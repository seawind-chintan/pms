<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkTaxes Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\RestaurantMenuTypesTable|\Cake\ORM\Association\BelongsTo $RestaurantMenuTypes
 *
 * @method \App\Model\Entity\WaterparkTax get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkTax newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkTax[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTax|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkTax patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTax[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTax findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkTaxesTable extends Table
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

        $this->setTable('waterpark_taxes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->decimal('cgst')
            ->requirePresence('cgst', 'create')
            ->notEmpty('cgst');

        $validator
            ->decimal('sgst')
            ->requirePresence('sgst', 'create')
            ->notEmpty('sgst');

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
        $rules->add($rules->existsIn(['restaurant_menu_type_id'], 'RestaurantMenuTypes'));
        $rules->add($rules->isUnique(['restaurant_menu_type_id'], 'Tax for this menu type is already exists'));
        return $rules;
    }
}
