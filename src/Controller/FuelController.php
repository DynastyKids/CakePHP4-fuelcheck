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
        $nswresults = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);
        $tasresults = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85']);
        $waresults = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85']);

        $allresults = json_encode(['Status'=>'00','NSW'=>$nswresults->toArray(),'TAS'=>$tasresults->toArray(),'WA'=>$waresults->toArray()]);

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(1500)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);

    }

    public function cheapInfo($key=null){
        $this->autoRender=false;
        $nswCheapU91 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
        $nswCheapE10 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
        $nswCheapP95 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
        $nswCheapP98 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
        $nswCheapLPG = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
        $nswCheapDL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
        $nswCheapPDL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

        $WaCheapU91 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
        $WaCheapP95 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
        $WaCheapP98 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
        $WaCheapLPG = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
        $WaCheapDL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
        $WaCheapPDL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

        $TasCheapU91 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
        $TasCheapE10 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
        $TasCheapP95 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
        $TasCheapP98 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
        $TasCheapLPG = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
        $TasCheapDL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
        $TasCheapPDL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();

        $allresults = json_encode(['Status'=>'00',
            'NSW'=>['U91'=>$nswCheapU91,'E10'=>$nswCheapE10,'P95'=>$nswCheapP95,'P98'=>$nswCheapP98,'DL'=>$nswCheapDL,'PDL'=>$nswCheapPDL,'LPG'=>$nswCheapLPG],
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
    public function wa($key=null)
    {
        $this->autoRender=false;
        $wacount = TableRegistry::getTableLocator()->get('Wafuel')->find()->count();
        if($wacount<=10){
            return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"01","Error"=>"Western Australia's fuel info is updating, please comeback few minutes later."]));
        }

        $waresults = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);

        return $this->response->withType("application/json")->withStringBody(json_encode($waresults));
    }

    public function nsw($key=null)
    {
        $this->autoRender=false;
        $nswcount = TableRegistry::getTableLocator()->get('Nswfuel')->find()->count();
        if($nswcount<=10){
            return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"01","Error"=>"Updating New South Wales fuel info, please comeback few minutes later."]));
        }
        
        $nswresults = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);
        
        return $this->response->withType("application/json")->withStringBody(json_encode($nswresults));
    }

    public function tas($key=null)
    {
        $this->autoRender=false;
        $tascount = TableRegistry::getTableLocator()->get('Tasfuel')->find()->count();
        if($tascount<=10){
            return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"01","Error"=>"Tasmania's fuel info is updating, please comeback few minutes later."]));
        }
        $tasresults = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','E10','P95','P98','DL','PDL','LPG','E85','B20']);

        return $this->response->withType("application/json")->withStringBody(json_encode($tasresults));
    }

    public function act($key=null)
    {
        $this->autoRender=false;
        // $actresults = TableRegistry::getTableLocator()->get('actfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);
        // return $this->response->withType("application/json")->withStringBody($actresults);

        return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"FF","Error"=>"Capital's fuel info resoruce is not available"]));
    }

    public function vic($key=null)
    {
        $this->autoRender=false;
        // $vicresults = TableRegistry::getTableLocator()->get('vicfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);
        // return $this->response->withType("application/json")->withStringBody($vicresults);

        return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"FF","Error"=>"Victoria's fuel info resoruce is not available"]));
    }

    public function sa($key=null)
    {
        $this->autoRender=false;
        // $saresults = TableRegistry::getTableLocator()->get('safuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);
        // return $this->response->withType("application/json")->withStringBody($saresults);

        return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"FF","Error"=>"South Australia's fuel info resoruce is not available"]));
    }

    public function nt($key=null)
    {
        $this->autoRender=false;
        // $ntresults = TableRegistry::getTableLocator()->get('ntfuel')->find()->select(['brand','name','address','loc_lat','loc_lng','U91','P95','P98','DL','PDL','LPG','E85','B20']);

        // return $this->response->withType("application/json")->withStringBody($ntresults);
        return $this->response->withType("application/json")->withStringBody(json_encode(["Status"=>"FF","Error"=>"North Territory's fuel info resoruce is not available"]));
    }
}
