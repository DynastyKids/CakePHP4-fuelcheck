<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;
use http\Exception\BadQueryStringException;
use Symfony\Component\Finder\Exception\AccessDeniedException;

/**
 * Info Controller
 *
 * @property \App\Model\Table\InfoTable $Info
 * @method \App\Model\Entity\Info[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class InfoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $info = $this->paginate($this->Info);

        $this->set(compact('info'));
    }

    /**
     * Data method
     *
     * This method allow user to get all data that available with its available privileges
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function data()
    {
        // Universal Access privilege verify
        $requestuser = $this->request->getQuery('user');
        $requestkey = $this->request->getQuery('key');
        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->build();

        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '400', 'Info' => 'Your access path / key is incorrect']));
        }
        $path = $this->request->getUri();
        $url = $path->getScheme() . '://' . $path->getHost();
        if ($path->getPort() == null) {
            $url = $url . $path->getPath() . "?user=" . $requestuser;
        } else {
            $url = $url . ":" . $path->getPort() . $path->getPath() . "?user=" . $requestuser;
        }
        $userinfo = TableRegistry::getTableLocator()->get('Users')->find()->where(['expiretime' >= date("Y-m-d"), 'userinfo' => $requestuser]);
        if ($userinfo->count() < 1) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'Your account does not exist / has expired']));
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'Your access path / key is incorrect']));
        }
        // End of verify

        // Check if user have corresponding state key right
        $resultdata = '';
        $resultdata->NSW =TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'NSW'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code','LAF'])->toArray();
        $resultdata->TAS = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'TAS'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code','LAF','B20'])->toArray();
        $resultdata->WA = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'WA'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code','B20'])->toArray();
        $resultdata->NT = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'NT'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code'])->toArray();
        $resultdata->QLD = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'QLD'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code'])->toArray();
        $resultdata->SA = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'SA'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code'])->toArray();
        $resultdata->VIC = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'VIC'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code','LAF'])->toArray();
        $resultdata->ACT = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>'ACT'])
            ->selectAllExcept(TableRegistry::getTableLocator()->get('Allstations'),['id','code','LAF'])->toArray();
//        debug($resultdata);

        $allresults = json_encode(['Status' => '00', 'ACT' => $resultdata->ACT, 'NSW' => $resultdata->NSW,
            'NT' => $resultdata->NT, 'QLD' => $resultdata->QLD, 'SA' => $resultdata->SA, 'TAS' => $resultdata->TAS,
            'VIC' => $resultdata->VIC, 'WA' => $resultdata->WA]);
        $this->autoRender = false;
        return $this->response->withType("application/json")->withStringBody($allresults);
    }


    public function cheapinfo()
    {
        // Universal Access privilege verify
        $requestuser = $this->request->getQuery('user');
        $requestkey = $this->request->getQuery('key');
        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->build();

        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '400', 'Info' => 'Your access path / key is incorrect']));
        }
        $path = $this->request->getUri();
        $url = $path->getScheme() . '://' . $path->getHost();
        if ($path->getPort() == null) {
            $url = $url . $path->getPath() . "?user=" . $requestuser;
        } else {
            $url = $url . ":" . $path->getPort() . $path->getPath() . "?user=" . $requestuser;
        }
        $userinfo = TableRegistry::getTableLocator()->get('Users')->find()->where(['expiretime' >= date("Y-m-d"), 'userinfo' => $requestuser]);
        if ($userinfo->count() < 1) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'You account does not exist / has expired']));
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'Your access path / key is incorrect']));
        }
        // End of verify

        $this->autoRender = false;

        $fuelnames = ['U91','E10','P95','P98','LPG','DL','PDL'];
        $statenames = ['NSW','TAS','WA','SA','NT','QLD','VIC','ACT'];
        $allresults = ['Status' => '00'];
        foreach ($statenames as $statename){
            $allresults[$statename]=[];
            foreach ($fuelnames as $fuelname){
                $allresults[$statename][$fuelname]=TableRegistry::getTableLocator()->get('Allstations')->find()
                    ->select(['brand', 'name', 'address','suburb','postcode', 'loc_lat', 'loc_lng', $fuelname])
                    ->where(['state'=>$statename,$fuelname.' IS NOT NULL'])->orderAsc($fuelname)->limit(25)->toArray();
            }
        }

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(900)->build();
        return $this->response->withType("application/json")->withStringBody(json_encode($allresults));
    }

    public function cheaptable()
    {
        $fuelnames = ['U91','E10','P95','P98','LPG','DL','PDL'];
        $statenames = ['NSW','TAS','WA','SA','NT','QLD','VIC','ACT'];
        $allresults = ['Status' => '00'];
        foreach ($statenames as $statename){
            $allresults[$statename]=[];
            foreach ($fuelnames as $fuelname){
                $allresults[$statename][$fuelname]=TableRegistry::getTableLocator()->get('Allstations')->find()
                    ->select(['brand', 'name', 'address','suburb','postcode', 'loc_lat', 'loc_lng', $fuelname])
                    ->where(['state'=>$statename,$fuelname.' IS NOT NULL'])->orderAsc($fuelname)->limit(25)->toArray();
            }
        }
        $this->set(compact('allresults'));
    }

    /**
     * Individual state lookup method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function state($state = null)
    {
        // Universal Access privilege verify
        $requestuser = $this->request->getQuery('user');
        $requestkey = $this->request->getQuery('key');
        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->build();

        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '400', 'Info' => 'Your access path / key is incorrect']));
        }
        $path = $this->request->getUri();
        $url = $path->getScheme() . '://' . $path->getHost();
        if ($path->getPort() == null) {
            $url = $url . $path->getPath() . "?user=" . $requestuser;
        } else {
            $url = $url . ":" . $path->getPort() . $path->getPath() . "?user=" . $requestuser;
        }
        $userinfo = TableRegistry::getTableLocator()->get('Users')->find()->where(['expiretime' >= date("Y-m-d"), 'userinfo' => $requestuser]);
        if ($userinfo->count() < 1) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'You account does not exist / has expired']));
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'Your access path / key is incorrect']));
        }
        // End of verify

        $this->autoRender = false;
        $stateList = ['QLD', 'NSW', 'ACT', 'VIC', 'TAS', 'SA', 'NT', 'WA'];
        if (in_array($state, $stateList)) {
            if ($userinfo->toArray()[0][$state] < 1) {
                return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '403', 'Info' => 'You account has no privilege to access this data']));
            }
            $selectedTable = TableRegistry::getTableLocator()->get('Allstations')->find()->where(['state'=>strtoupper($state)]);
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '00', strtoupper($state) => $selectedTable->find()->toArray()]));
        } else {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '400', 'Info' => 'The state parameter is incorrect']));
        }
    }
}
