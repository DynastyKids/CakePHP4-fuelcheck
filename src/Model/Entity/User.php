<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime|null $createtime
 * @property string|null $userinfo
 * @property string|null $userkey
 * @property string|null $useremail
 * @property string|null $userpass
 * @property int|null $NSW
 * @property int|null $TAS
 * @property int|null $WA
 * @property int|null $ACT
 * @property int|null $VIC
 * @property int|null $SA
 * @property int|null $NT
 * @property int|null $QLD
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'createtime' => true,
        'userinfo' => true,
        'userkey' => true,
        'useremail' => true,
        'userpass' => true,
        'NSW' => true,
        'TAS' => true,
        'WA' => true,
        'ACT' => true,
        'VIC' => true,
        'SA' => true,
        'NT' => true,
        'QLD' => true,
    ];
}
