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
        $resultdata = [];
        $nswresult = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $tasresult = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85']);
        $waresult = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'LAF']);
        $ntresult = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $qldresult = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $saresult = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $vicresult = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $actresult = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);

        $statenames = ['Nsw','Tas','Wa','Sa','Nt','Qld','Vic','Act'];
        foreach ($statenames as $statename){
            if($userinfo->toArray()[0][strtoupper($statename)]){
                array_push($resultdata, ${strtolower($statename).'result'}->toArray());
            } else {
                array_push($resultdata, []);
            }
        }

        $allresults = json_encode(['Status' => '00', 'NSW' => $resultdata[0], 'TAS' => $resultdata[1], 'WA' => $resultdata[2], 'NT' => $resultdata[3], 'QLD' => $resultdata[4],
            'SA' => $resultdata[5], 'VIC' => $resultdata[6], 'ACT' => $resultdata[7]]);

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

        $statenames = ['Nsw','Tas','Wa','Sa','Nt','Qld','Vic','Act'];
        $allresults = ['Status' => '00'];
        foreach ($statenames as &$statename){
            if ($userinfo->toArray()[0][strtoupper($statename)] >0){
                ${$statename.'cluster'}=[];
                foreach ($fuelnames as &$fuelname){
                    ${$statename.'cluster'}[$fuelname]=TableRegistry::getTableLocator()->get($statename.'fuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where([$fuelname.' IS NOT NULL'])->orderAsc($fuelname)->limit(10)->toArray();
                }
                $allresults[strtoupper($statename)] = ${$statename.'cluster'};
            }
        }

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(900)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);
    }

    public function cheaptable()
    {
        $fuelnames = ['U91','E10','P95','P98','LPG','DL','PDL'];
        $statenames = ['Nsw','Tas','Wa','Sa','Nt','Qld','Vic','Act'];
        $allresults = ['Status' => '00'];
        foreach ($statenames as &$statename){
            ${$statename.'cluster'}=[];
            foreach ($fuelnames as &$fuelname){
                ${$statename.'cluster'}[$fuelname]=TableRegistry::getTableLocator()->get($statename.'fuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where([$fuelname.' IS NOT NULL'])->orderAsc($fuelname)->limit(10)->toArray();
            }
            $allresults[strtoupper($statename)] = ${$statename.'cluster'};
        }

        $this->set(compact('allresults', 'Nswcluster'));
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
            $state = ucfirst(strtolower($state));
            $selectedTable = TableRegistry::getTableLocator()->get($state . 'fuel')->find();
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '00', strtoupper($state) => $selectedTable->find()->toArray()]));
        } else {
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '400', 'Info' => 'The state parameter is incorrect']));
        }
    }
}
