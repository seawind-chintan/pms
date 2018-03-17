<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * WaterparkTickets Model
 *
 * @property \App\Model\Table\PropertiesTable|\Cake\ORM\Association\BelongsTo $Properties
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\MembersTable|\Cake\ORM\Association\BelongsTo $Members
 *
 * @method \App\Model\Entity\WaterparkTicket get($primaryKey, $options = [])
 * @method \App\Model\Entity\WaterparkTicket newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\WaterparkTicket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTicket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\WaterparkTicket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTicket[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\WaterparkTicket findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class WaterparkTicketsTable extends Table
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

        $this->setTable('waterpark_tickets');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Properties', [
            'foreignKey' => 'property_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Members', [
            'foreignKey' => 'member_id',
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
            ->scalar('code')
            ->maxLength('code', 50)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->integer('no_of_persons')
            ->requirePresence('no_of_persons', 'create')
            ->notEmpty('no_of_persons');

        $validator
            ->integer('no_of_adults')
            ->allowEmpty('no_of_adults');

        $validator
            ->integer('no_of_childs')
            ->allowEmpty('no_of_childs');

        $validator
            ->scalar('issued_by')
            ->maxLength('issued_by', 100)
            ->requirePresence('issued_by', 'create')
            ->notEmpty('issued_by');

        $validator
            ->scalar('member_type')
            ->maxLength('member_type', 50)
            ->allowEmpty('member_type');

        $validator
            ->decimal('total_amount')
            ->requirePresence('total_amount', 'create')
            ->notEmpty('total_amount');

        $validator
            ->decimal('hold_amount')
            ->requirePresence('hold_amount', 'create')
            ->notEmpty('hold_amount');

        $validator
            ->decimal('balance')
            ->requirePresence('balance', 'create')
            ->notEmpty('balance');

        $validator
            ->scalar('discount_code')
            ->maxLength('discount_code', 100)
            ->allowEmpty('discount_code');

        $validator
            ->decimal('discount_amount')
            ->requirePresence('discount_amount', 'create')
            ->notEmpty('discount_amount');

        $validator
            ->integer('payment_mode')
            ->requirePresence('payment_mode', 'create')
            ->notEmpty('payment_mode');

        $validator
            ->scalar('card_number')
            ->maxLength('card_number', 20)
            ->allowEmpty('card_number');

        $validator
            ->scalar('card_holder')
            ->maxLength('card_holder', 100)
            ->allowEmpty('card_holder');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['member_id'], 'Members'));

        return $rules;
    }
}
