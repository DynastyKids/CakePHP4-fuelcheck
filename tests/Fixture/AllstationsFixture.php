<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AllstationsFixture
 */
class AllstationsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'brand' => 'Lorem ipsum dolor sit amet',
                'code' => 'Lorem ipsum dolor sit amet',
                'name' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'suburb' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lor',
                'postcode' => 'Lore',
                'loc_lat' => 1,
                'loc_lng' => 1,
                'U91' => 1,
                'P95' => 1,
                'P98' => 1,
                'DL' => 1,
                'PDL' => 1,
                'LPG' => 1,
                'EV' => 1,
                'E10' => 1,
                'E85' => 1,
                'B20' => 1,
                'adblue' => 1,
                'LAF' => 1,
            ],
        ];
        parent::init();
    }
}
