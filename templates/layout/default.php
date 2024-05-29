<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
        <?= "- DynastyFuel" ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
<!--    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6124120549237365"-->
<!--            crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/core.min.js"
            integrity="sha512-t8vdA86yKUE154D1VlNn78JbDkjv3HxdK/0MJDMBUXUjshuzRgET0ERp/0MAgYS+8YD9YmFwnz6+FWLz1gRZaw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac.min.js"
            integrity="sha512-tLNkZ/sTmmvq8RDIGCLU3ZzUYSixlGQxpL0X1LWFnTBdvw0SGurLkjAIh0CtG0oQ/1Yt6MaDiI8Gif05JZqEyQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/sha1.min.js"
            integrity="sha512-NHw1e1pc4RtmcynK88fHt8lpuetTUC0frnLBH6OrjmKGNnwY4nAnNBMjez4DRr9G1b+NtufOXLsF+apmkRCEIw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/hmac-sha1.min.js"
            integrity="sha512-OahNHQh8EnqAptVvXgLLIT3LOv+irJSkED9oyUvGvh1MULTHriuXGIk8RHFfRffj5ejGREfE9IRWoBCPSZ5XGw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">DynastyFuel</span>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= $this->Url->build('/') ?>">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build(['controller'=>'pages','action'=>'newtable'])?>">List view</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Fuel type
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl'])?>">All</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','U91'])?>">Unleaded 91</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','E10'])?>">Unleaded 94 / E10</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','P95'])?>">Premium Unleaded 95</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','P98'])?>">Premium Unleaded 98</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','DL'])?>">Diesel</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','PDL'])?>">Premium Diesel</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','LPG'])?>">LPG</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','EV'])?>">Electric</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="https://dynastykids.github.io/React-FuelCheck/">Mirrored MapView</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Price Trend (In Next Version)</a></li>
                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">About</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a></li>
            </ul>
            <form class="d-flex" id="navbarEnd">
<!--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-success" type="submit">Search</button>-->
            </form>
        </div>
    </div>
</nav>
<?= $this->Flash->render() ?>
<?= $this->fetch('content') ?>

<!-- About Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">About</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                This is a fuel checker web App build by Dynastykids.<br><br>
                It's an open source project and currently available for checking Perth Metro, New South Wales and Tasmaina's fuel price.
                And seeking if there has any chance to accessing other states data and adding to this site.<br><br>

                NSW's data are provided by <a href="https://api.nsw.gov.au/">API.NSW</a> and supported by
                <a href="https://www.customerservice.nsw.gov.au/">Department of Customer Service</a><br>

                Tasmania & Canberra areas data are provided by <a href="https://api.nsw.gov.au/">API.NSW</a><br>

                Western Australia's data are provided by <a href="https://www.fuelwatch.wa.gov.au/">FuelWatch</a>
                and supported by <a href="https://www.dmirs.wa.gov.au/">Department of Mines, Industry Regulation and safety</a><br>

                North Territory's data are provided by <a href="https://myfuelnt.nt.gov.au/">MyFuel NT</a> and supported by
                <a href="https://consumeraffairs.nt.gov.au/">Northern Territory Consumer Affairs</a><br>

                South Australia's data are provided by <a href="https://www.cbs.sa.gov.au/">Office of Consumer and Business
                    Services</a> and <a href="https://www.sa.gov.au/">Government of South Australia</a><br>

                Queensland's data are provided by <a href="https://www.cbs.sa.gov.au/">Office of Consumer and Business
                    Services</a> and <a href="https://www.sa.gov.au/">Government of South Australia</a><br>

                <br><br>Project Avaiable on: <a href="https://github.com/DynastyKids/React-FuelCheck">GitHub</a><br>
                <small>Disclaimer: The information provided by React-FuelCheck / DynastyFuel ('we', 'us' or 'our') on
                    this website is for general information purposes. All information are provided in good faith but
                    not representation in any kind, express or implied, regarding the accuracy, adequacy, validity,
                    reliability, availability or completeness of any information holding on this Site.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

<style>
    body{
        margin: 0;
        min-height: 100vh;
    }

    /*html, body{*/
    /*    height: 100%;*/
    /*    margin: 0;*/
    /*}*/
</style>
</html>
