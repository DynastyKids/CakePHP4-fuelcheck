<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Info Controller
 *
 * @property \App\Model\Table\InfoTable $Info
 * @method \App\Model\Entity\Info[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FuelController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($key=null)
    {
        $this->autoRender=false;
        $nswresults = TableRegistry::getTableLocator()->get('nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);
        $tasresults = TableRegistry::getTableLocator()->get('tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85']);
        $waresults = TableRegistry::getTableLocator()->get('wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85']);

        $allresults = json_encode(['NSW'=>$nswresults->toArray(),'TAS'=>$tasresults->toArray(),'WA'=>$waresults->toArray()]);
//        debug($allresults);

        return $this->response->withType("application/json")->withStringBody($allresults);

    }

    /**
     * NSW method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function NSW($key=null)
    {
        $this->autoRender=false;
        $nswresults = TableRegistry::getTableLocator()->get('nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);
        $tasresults = TableRegistry::getTableLocator()->get('tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85']);
        $waresults = TableRegistry::getTableLocator()->get('wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85']);

        $allresults = json_encode(['NSW'=>$nswresults->toArray(),'TAS'=>$tasresults->toArray(),'WA'=>$waresults->toArray()]);
//        debug($allresults);

        return $this->response->withType("application/json")->withStringBody($allresults);

    }
}
