<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kots Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\RestaurantTablesTable|\Cake\ORM\Association\BelongsTo $RestaurantTables
 * @property \App\Model\Table\KotItemsTable|\Cake\ORM\Association\HasMany $KotItems
 *
 * @method \App\Model\Entity\Kot get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kot newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Kot[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kot|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kot patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kot[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kot findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class KotsTable extends Table
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

        $this->setTable('kots');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('RestaurantTables', [
            'foreignKey' => 'restaurant_table_id'
        ]);
        $this->hasMany('KotItems', [
            'foreignKey' => 'kot_id'
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

        /* */
        $validator
            ->integer('kot_no')
            ->requirePresence('kot_no', 'create')
            ->notEmpty('kot_no');

        $validator
            ->integer('restaurant_table_code')
            ->allowEmpty('restaurant_table_code');

        $validator
            ->integer('no_of_pax')
            ->requirePresence('no_of_pax', 'create')
            ->allowEmpty('no_of_pax');

        $validator
            ->scalar('steward')
            ->maxLength('steward', 255)
            ->allowEmpty('steward');

        $validator
            ->scalar('nc_kot')
            ->requirePresence('nc_kot', 'create')
            ->allowEmpty('nc_kot');

        $validator
            ->scalar('remark')
            ->allowEmpty('remark');

        $validator
            ->scalar('split')
            ->requirePresence('split', 'create')
            ->allowEmpty('split');

        $validator
            ->decimal('amount')
            ->allowEmpty('amount');

        $validator
            ->scalar('total_qty')
            ->maxLength('total_qty', 10)
            ->allowEmpty('total_qty');

        $validator
            ->scalar('kot_status')
            ->requirePresence('kot_status', 'create')
            ->allowEmpty('kot_status');
        /* */
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
        $rules->add($rules->existsIn(['restaurant_table_id'], 'RestaurantTables'));

        return $rules;
    }
}
