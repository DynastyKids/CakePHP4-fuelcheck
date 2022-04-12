<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Exception\DatabaseException;
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
        $nswresults = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);
        $tasresults = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85']);
        $waresults = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','LAF']);
        $ntresults = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand','name','address','suburb','state','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20','LAF']);
        $qldresults = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand','name','address','suburb','state','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20','LAF']);
        $saresults = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand','name','address','suburb','state','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20','LAF']);
        $vicresults = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand','name','address','suburb','state','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);
        $actresults = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand','name','address','suburb','state','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);

        $allresults = json_encode(['Status'=>'00','NSW'=>$nswresults->toArray(),'TAS'=>$tasresults->toArray(),'WA'=>$waresults->toArray(),'NT'=>$ntresults->toArray(),'QLD'=>$qldresults->toArray(),'SA'=>$saresults->toArray(),'VIC'=>$vicresults->toArray(),'ACT'=>$actresults->toArray()]);

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(1500)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);

    }

    public function cheapinfo($key=null){
        $this->autoRender=false;
        $nswTable=TableRegistry::getTableLocator()->get('Nswfuel')->find();
        if ($nswTable->find()->count()>0) {
            $nswCheapU91 = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $nswCheapE10 = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $nswCheapP95 = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $nswCheapP98 = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $nswCheapLPG = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $nswCheapDL = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $nswCheapPDL = $nswTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();
        }
        $waTable = TableRegistry::getTableLocator()->get('Wafuel')->find();
        if ($waTable->find()->count()>0) {
            $WaCheapU91 = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $WACheapE10 = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $WaCheapP95 = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $WaCheapP98 = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $WaCheapLPG = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $WaCheapDL = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $WaCheapPDL = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();
            $WaCheapPDL = $waTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LAF'])->where(['LAF IS NOT NULL'])->orderAsc('LAF')->limit(5)->toArray();
        }
        $tasTable=TableRegistry::getTableLocator()->get('Tasfuel')->find();
        if($tasTable->find()->count()>0) {
            $TasCheapU91 = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
            $TasCheapE10 = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
            $TasCheapP95 = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
            $TasCheapP98 = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
            $TasCheapLPG = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
            $TasCheapDL = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
            $TasCheapPDL = $tasTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        }

        $ntTable=TableRegistry::getTableLocator()->get('Ntfuel')->find();
        if($ntTable->find()->count()>0) {
            $NtCheapU91 = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
            $NtCheapE10 = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
            $NtCheapP95 = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
            $NtCheapP98 = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
            $NtCheapLAF = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LAF'])->where(['LAF IS NOT NULL'])->orderAsc('LAF')->limit(3)->toArray();
            $NtCheapLPG = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
            $NtCheapDL = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
            $NtCheapPDL = $ntTable->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
        }

        $allresults = json_encode(['Status'=>'00',
            'NSW'=>['U91'=>$nswCheapU91,'E10'=>$nswCheapE10,'P95'=>$nswCheapP95,'P98'=>$nswCheapP98,'DL'=>$nswCheapDL,'PDL'=>$nswCheapPDL,'LPG'=>$nswCheapLPG],
            'NT'=>['U91'=>$NtCheapU91,'E10'=>$NtCheapE10,'P95'=>$NtCheapP95,'P98'=>$NtCheapP98,'DL'=>$NtCheapDL,'PDL'=>$NtCheapPDL,'LPG'=>$NtCheapLPG,'LAF'=>$NtCheapLAF],
            'TAS'=>['U91'=>$TasCheapU91,'E10'=>$TasCheapE10,'P95'=>$TasCheapP95,'P98'=>$TasCheapP98,'DL'=>$TasCheapDL,'PDL'=>$TasCheapPDL,'LPG'=>$TasCheapLPG],
            'WA'=>['U91'=>$WaCheapU91,'P95'=>$WaCheapP95,'P98'=>$WaCheapP98,'DL'=>$WaCheapDL,'PDL'=>$WaCheapPDL,'LPG'=>$WaCheapLPG]]);

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(900)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);
    }

    /**
     * Individual state lookup method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function byState($state=null)
    {
        $this->autoRender=false;
        $stateList = ['QLD','NSW','ACT','VIC','TAS','SA','NT','WA'];
        if(in_array($state,$stateList)){
            $state = ucfirst(strtolower($state));
            try {
                $selectedTable = TableRegistry::getTableLocator()->get($state.'fuel')->find();
                if($selectedTable->count()<=5){
                    return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"01","Error"=>"Fuel info is updating now, please wait."]));
                }

                return $this->response->withType("application/json")->withStringBody(json_encode($selectedTable->find()->toArray()));
            } catch (Exception $e){
                $error='Caught exception: '. $e->getMessage()."\n";
            }
        } else {
            $errmsg = ['Status'=>'0F','Info'=>'State parameter is incorrect, only capital letters accepted'];
            return $this->response->withType("application/json")->withStringBody(json_encode($errmsg));
        }
    }
}
