<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vicfuel Entity
 *
 * @property int $id
 * @property string|null $brand
 * @property string|null $code
 * @property string|null $name
 * @property string|null $address
 * @property string|null $suburb
 * @property string|null $state
 * @property string|null $postcode
 * @property float|null $loc_lat
 * @property float|null $loc_lng
 * @property float|null $U91
 * @property float|null $P95
 * @property float|null $P98
 * @property float|null $DL
 * @property float|null $PDL
 * @property float|null $LPG
 * @property float|null $EV
 * @property float|null $E10
 * @property float|null $E85
 * @property float|null $B20
 */
class Vicfuel extends Entity
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
        'brand' => true,
        'code' => true,
        'name' => true,
        'address' => true,
        'suburb' => true,
        'state' => true,
        'postcode' => true,
        'loc_lat' => true,
        'loc_lng' => true,
        'U91' => true,
        'P95' => true,
        'P98' => true,
        'DL' => true,
        'PDL' => true,
        'LPG' => true,
        'EV' => true,
        'E10' => true,
        'E85' => true,
        'B20' => true,
    ];
}
