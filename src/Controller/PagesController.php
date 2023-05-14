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
        $this->redirect(['action'=>'mapl','U91']);
    }

    public function dev(){
        // Nothing expected from Controller.
    }

    public function mapl($fueltype = null){
        $intype = 0;
        $priceinfo=TableRegistry::getTableLocator()->get('Allstations')->find('all')->orderAsc($fueltype)->toArray();
        $fueltypes = ['U91','E10','P95','P98','DL','PDL','LPG','EV'];
        if ($fueltype != null && in_array($fueltype, $fueltypes)){ // Fuel type found
            $intype = 1;
            $priceinfo=TableRegistry::getTableLocator()->get('Allstations')->find('all')->whereNotNull($fueltype)->orderAsc($fueltype)->toArray();
        }
        $latestinfo=TableRegistry::getTableLocator()->get('Info')->find('all')->orderAsc('lastfetchtime')->limit(1)->toArray();
        $this->set(compact('priceinfo','intype','latestinfo'));
    }

    public function mapv2($fueltype = null){
        $requestType = $this->request->getQuery('fuel');
        $intype = 0;
        $fueltypes = ['U91','E10','P95','P98','DL','PDL','LPG','EV'];
        if ($requestType != null && in_array($requestType, $fueltypes)){ // Fuel type found
            $intype = 1;
            $priceinfo=TableRegistry::getTableLocator()->get('Allstations')->find('all')->whereNotNull($requestType)->toArray();
        } else {
            $priceinfo=TableRegistry::getTableLocator()->get('Allstations')->find('all')->toArray();
        }
        $latestinfo=TableRegistry::getTableLocator()->get('Info')->find('all')->orderAsc('lastfetchtime')->limit(1)->toArray();
        $this->set(compact('priceinfo','intype','latestinfo'));
    }

    public function table(){
        $latestinfo=TableRegistry::getTableLocator()->get('Info')->find('all')->orderAsc('lastfetchtime')->limit(1)->toArray();
        $statenames=["NATIONWIDE","ACT","NSW","NT","SA","TAS","QLD","VIC","WA"];
        $fueltypes = ["U91","E10","P95","P98","LPG","DL","PDL"];
        $allresults = ['Status' => '00'];

        foreach ($statenames as $state) {
            $statecluster = [];
            if ($state == "NT"){
                $statecluster+=['LAF'=>TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>$state])
                    ->select(['brand', 'name', 'address','suburb','state','postcode', 'loc_lat', 'loc_lng', 'LAF'])
                    ->whereNotNull('LAF')->orderAsc('LAF')->limit(20)];
            }
            foreach ($fueltypes as $fueltype) {
                $resultrow = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>$state])
                    ->select(['brand', 'name', 'address','suburb','state','postcode', 'loc_lat', 'loc_lng', $fueltype])
                    ->whereNotNull($fueltype)->orderAsc($fueltype)->limit(20);
                if ($state == "NATIONWIDE"){
                    $resultrow = TableRegistry::getTableLocator()->get('Allstations')->find()
                        ->select(['brand', 'name', 'address','suburb','state','postcode', 'loc_lat', 'loc_lng', $fueltype])
                        ->whereNotNull($fueltype)->orderAsc($fueltype)->limit(35);
                }
                $statecluster+=[$fueltype=>$resultrow->toArray()];
            }
            $allresults += [strtoupper($state) => $statecluster];
        }
        $this->set(compact('allresults','statenames','fueltypes','latestinfo'));
    }
}
