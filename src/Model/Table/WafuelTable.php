<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Wafuel Model
 *
 * @method \App\Model\Entity\Wafuel newEmptyEntity()
 * @method \App\Model\Entity\Wafuel newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Wafuel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Wafuel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Wafuel findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Wafuel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Wafuel[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Wafuel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wafuel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Wafuel[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Wafuel[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Wafuel[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Wafuel[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class WafuelTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('wafuel');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('brand')
            ->maxLength('brand', 255)
            ->allowEmptyString('brand');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name')
            ->add('name', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('address')
            ->allowEmptyString('address');

        $validator
            ->scalar('suburb')
            ->maxLength('suburb', 255)
            ->allowEmptyString('suburb');

        $validator
            ->scalar('state')
            ->maxLength('state', 10)
            ->allowEmptyString('state');

        $validator
            ->scalar('postcode')
            ->maxLength('postcode', 6)
            ->allowEmptyString('postcode');

        $validator
            ->numeric('loc_lat')
            ->allowEmptyString('loc_lat');

        $validator
            ->numeric('loc_lng')
            ->allowEmptyString('loc_lng');

        $validator
            ->numeric('U91')
            ->allowEmptyString('U91');

        $validator
            ->numeric('P95')
            ->allowEmptyString('P95');

        $validator
            ->numeric('P98')
            ->allowEmptyString('P98');

        $validator
            ->numeric('DL')
            ->allowEmptyString('DL');

        $validator
            ->numeric('PDL')
            ->allowEmptyString('PDL');

        $validator
            ->numeric('LPG')
            ->allowEmptyString('LPG');

        $validator
            ->numeric('EV')
            ->allowEmptyString('EV');

        $validator
            ->numeric('E10')
            ->allowEmptyString('E10');

        $validator
            ->numeric('E85')
            ->allowEmptyString('E85');

        $validator
            ->numeric('B20')
            ->allowEmptyString('B20');

        $validator
            ->numeric('LAF')
            ->allowEmptyString('LAF');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['name'], ['allowMultipleNulls' => true]), ['errorField' => 'name']);

        return $rules;
    }
}
