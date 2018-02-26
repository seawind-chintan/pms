<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Checkins Model
 *
 * @property \App\Model\Table\MembersTable|\Cake\ORM\Association\BelongsTo $Members
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\CheckinRoomsRatesTable|\Cake\ORM\Association\HasMany $CheckinRoomsRates
 *
 * @method \App\Model\Entity\Checkin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Checkin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Checkin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Checkin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Checkin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Checkin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Checkin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CheckinsTable extends Table
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

        $this->setTable('checkins');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('CheckinRoomsRates', [
            'foreignKey' => 'checkin_id'
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
            ->dateTime('arrival_date_time')
            ->requirePresence('arrival_date_time', 'create')
            ->notEmpty('arrival_date_time');

        $validator
            ->integer('no_of_adult')
            ->requirePresence('no_of_adult', 'create')
            ->notEmpty('no_of_adult');

        $validator
            ->integer('no_of_child')
            ->requirePresence('no_of_child', 'create')
            ->notEmpty('no_of_child');

        $validator
            ->scalar('arrival_from')
            ->maxLength('arrival_from', 150)
            ->allowEmpty('arrival_from');

        $validator
            ->scalar('destination')
            ->maxLength('destination', 150)
            ->allowEmpty('destination');

        $validator
            ->scalar('purpose_of_visit')
            ->maxLength('purpose_of_visit', 255)
            ->allowEmpty('purpose_of_visit');

        $validator
            ->scalar('travel_agent')
            ->maxLength('travel_agent', 255)
            ->allowEmpty('travel_agent');

        $validator
            ->scalar('remarks')
            ->allowEmpty('remarks');

        $validator
            ->dateTime('dept_date_time')
            ->requirePresence('dept_date_time', 'create')
            ->notEmpty('dept_date_time');

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
        $rules->add($rules->existsIn(['member_id'], 'Members'));
        $rules->add($rules->existsIn(['property_id'], 'Properties'));

        return $rules;
    }
}
