<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Database\Exception\DatabaseException;
use Cake\ORM\TableRegistry;
use http\Exception\BadQueryStringException;
use http\Exception\BadUrlException;
use mysql_xdevapi\Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use function PHPUnit\Framework\throwException;

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
    public function index($key = null)
    {
        $this->autoRender = false;
        $nswresults = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $tasresults = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85']);
        $waresults = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'LAF']);
        $ntresults = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $qldresults = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $saresults = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $vicresults = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $actresults = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);

        $allresults = json_encode(['Status' => '01', 'Info' => "This access entry will be disabled after 2022/May/01", 'NSW' => $nswresults->toArray(), 'TAS' => $tasresults->toArray(), 'WA' => $waresults->toArray(), 'NT' => $ntresults->toArray(), 'QLD' => $qldresults->toArray(), 'SA' => $saresults->toArray(), 'VIC' => $vicresults->toArray(), 'ACT' => $actresults->toArray()]);

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(1500)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);

//        return throw new BadUrlException();
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
        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            throw new AccessDeniedException("Missing username / key query");
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
            throw new AccessDeniedException("Your account does not exist / has expired");
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            throw new AccessDeniedException("Your access path / key is incorrect");
        }
        // End of verify

        // Check if user have corresponding state key right
        $resultdata = [];
        $nswdata = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $tasresult = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85']);
        $waresult = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'LAF']);
        $ntresult = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $qldresult = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $saresult = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20', 'LAF']);
        $vicresult = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        $actresult = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'suburb', 'state', 'postcode', 'loc_lat', 'loc_lng', 'U91', 'E10', 'P95', 'P98', 'DL', 'PDL', 'LPG', 'E85', 'B20']);
        if ($userinfo->toArray()[0]['NSW']) {
            array_push($resultdata, $nswdata->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['TAS']) {
            array_push($resultdata, $tasresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['WA']) {
            array_push($resultdata, $waresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['NT']) {
            array_push($resultdata, $ntresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['QLD']) {
            array_push($resultdata, $qldresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['SA']) {
            array_push($resultdata, $saresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['VIC']) {
            array_push($resultdata, $vicresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        if ($userinfo->toArray()[0]['ACT']) {
            array_push($resultdata, $actresult->toArray());
        } else {
            array_push($resultdata, []);
        }
        $allresults = json_encode(['Status' => '00', 'NSW' => $resultdata[0], 'TAS' => $resultdata[1], 'WA' => $resultdata[2], 'NT' => $resultdata[3], 'QLD' => $resultdata[4],
            'SA' => $resultdata[5], 'VIC' => $resultdata[6], 'ACT' => $resultdata[7]]);

        $this->autoRender = false;
        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(1500)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);
    }


    public function cheapinfo()
    {
        // Universal Access privilege verify
        $requestuser = $this->request->getQuery('user');
        $requestkey = $this->request->getQuery('key');
        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            throw new AccessDeniedException("Missing username / key query");
        }
        $path = $this->request->getUri();
        $url = $path->getScheme() . '://' . $path->getHost();
        if ($path->getPort()==null) {
            $url = $url . $path->getPath() . "?user=" . $requestuser;
        } else {
            $url = $url . ":" . $path->getPort() . $path->getPath() . "?user=" . $requestuser;
        }
        $userinfo = TableRegistry::getTableLocator()->get('Users')->find()->where(['expiretime' >= date("Y-m-d"), 'userinfo' => $requestuser]);
        if ($userinfo->count() < 1) {
            throw new AccessDeniedException("Your account does not exist / has expired");
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            throw new AccessDeniedException("Your access path / key is incorrect");
        }
        // End of verify

        $this->autoRender = false;
        $nswcluster = $tascluster = $wacluster = $sacluster = $ntcluster = $qldcluster = $viccluster = $actcluster = [];

        if ($userinfo->toArray()[0]['NSW'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Nswfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();
            $nswcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['TAS'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Tasfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
            $tascluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['WA'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Wafuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();
            $wacluster = ['U91' => $U91,'E10'=>$E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['SA'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Safuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

            $sacluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['NT'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(3)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(3)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(3)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(3)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(3)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(3)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(3)->toArray();
            $LAF = TableRegistry::getTableLocator()->get('Ntfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LAF'])->where(['LAF IS NOT NULL'])->orderAsc('LAF')->limit(3)->toArray();

            $ntcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG, 'LAF' => $LAF];
        }
        if ($userinfo->toArray()[0]['QLD'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Qldfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

            $qldcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['VIC'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Vicfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

            $viccluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }
        if ($userinfo->toArray()[0]['ACT'] > 0) {
            $U91 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'U91'])->where(['U91 IS NOT NULL'])->orderAsc('U91')->limit(5)->toArray();
            $E10 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'E10'])->where(['E10 IS NOT NULL'])->orderAsc('E10')->limit(5)->toArray();
            $P95 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P95'])->where(['P95 IS NOT NULL'])->orderAsc('P95')->limit(5)->toArray();
            $P98 = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'P98'])->where(['P98 IS NOT NULL'])->orderAsc('P98')->limit(5)->toArray();
            $LPG = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'LPG'])->where(['LPG IS NOT NULL'])->orderAsc('LPG')->limit(5)->toArray();
            $DL = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'DL'])->where(['DL IS NOT NULL'])->orderAsc('DL')->limit(5)->toArray();
            $PDL = TableRegistry::getTableLocator()->get('Actfuel')->find()->select(['brand', 'name', 'address', 'loc_lat', 'loc_lng', 'PDL'])->where(['PDL IS NOT NULL'])->orderAsc('PDL')->limit(5)->toArray();

            $actcluster = ['U91' => $U91, 'E10' => $E10, 'P95' => $P95, 'P98' => $P98, 'DL' => $DL, 'PDL' => $PDL, 'LPG' => $LPG];
        }

        $allresults = json_encode(['Status' => '00', 'NSW' => $nswcluster, 'TAS' => $tascluster, 'NT' => $ntcluster, 'SA' => $sacluster, 'WA' => $wacluster, 'QLD' => $qldcluster, 'VIC' => $viccluster, 'ACT' => $actcluster]);

        $this->response = $this->response->cors($this->request)->allowOrigin(['*'])->allowMethods(['GET'])->allowCredentials()->maxAge(900)->build();
        return $this->response->withType("application/json")->withStringBody($allresults);
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
        if ($this->request->getQuery('user') == null || $this->request->getQuery('key') == null) {
            throw new AccessDeniedException("Missing username / key query");
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
            throw new AccessDeniedException("Your account does not exist / has expired");
        }
        $res = hash_hmac("sha1", $url, (date("Ymd") . $userinfo->toArray()[0]['userkey']));
        if ($res != $requestkey) {
            throw new AccessDeniedException("Your access path / key is incorrect");
        }
        // End of verify

        $this->autoRender = false;
        $stateList = ['QLD', 'NSW', 'ACT', 'VIC', 'TAS', 'SA', 'NT', 'WA'];
        if (in_array($state, $stateList)) {
            if ($userinfo->toArray()[0][$state] < 1) {
                throw new AccessDeniedException("You accound has no privilege to access this data");
            }
            $state = ucfirst(strtolower($state));
            $selectedTable = TableRegistry::getTableLocator()->get($state . 'fuel')->find();
            return $this->response->withType("application/json")->withStringBody(json_encode(['Status' => '00', strtoupper($state) => $selectedTable->find()->toArray()]));
        } else {
            throw new BadQueryStringException("The state parameter is incorrect");
        }
    }
}
