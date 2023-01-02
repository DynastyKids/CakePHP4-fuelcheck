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
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6124120549237365"
            crossorigin="anonymous"></script>
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
</head>
<body style="height: 100%;margin: 0">
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
                <li class="nav-item"><a class="nav-link" href="<?= $this->Url->build(['controller'=>'pages','action'=>'table'])?>">Table List view</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mapview
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','U91'])?>">Unleaded 91</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','E10'])?>">Unleaded 94 / E10</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','P95'])?>">Premium Unleaded 95</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','P98'])?>">Premium Unleaded 98</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','DL'])?>">Diesel</a></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','PDL'])?>">Premium Diesel</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?= $this->Url->build(['controller'=>'pages','action'=>'mapl','LPG'])?>">LPG</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="https://dynastykids.github.io/React-FuelCheck/">Mirrored MapView</a></li>
                <li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a></li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
