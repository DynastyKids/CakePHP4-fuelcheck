<?php
declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from templates/Pages/
 *
 * @link https://book.cakephp.org/4/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    /**
     * Displays a view
     *
     * @param string ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Http\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\View\Exception\MissingTemplateException When the view file could not
     *   be found and in debug mode.
     * @throws \Cake\Http\Exception\NotFoundException When the view file could not
     *   be found and not in debug mode.
     * @throws \Cake\View\Exception\MissingTemplateException In debug mode.
     */
    public function display(string ...$path): ?Response
    {
        if (!$path) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            return $this->render(implode('/', $path));
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }


    public function home()
    {
        $nswcluster = $tascluster = $wacluster = $sacluster = $ntcluster = $qldcluster = $viccluster = $actcluster = [];
        $U91 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $nswcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $tascluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $wacluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $sacluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $LAF = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LAF'])->where(['LAF IS NOT NULL'])->orderAsc('LAF')->limit(3)->toArray();
        $ntcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG, 'LAF' => $LAF];
        $U91 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $qldcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $viccluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $U91 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $E10 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $P95 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $P98 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $LPG = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $DL = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $PDL = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'postcode', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        $actcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        $allresults = ['Status' => '00', 'NSW' => $nswcluster, 'TAS' => $tascluster, 'NT' => $ntcluster, 'SA' => $sacluster, 'WA' => $wacluster, 'QLD' => $qldcluster, 'VIC' => $viccluster, 'ACT' => $actcluster];
        $this->set(compact('allresults', 'nswcluster'));
    }
}
