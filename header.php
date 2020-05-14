<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Script panel</title>
     <link rel="stylesheet" href="addons/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="addons/all.css">
    <link rel="stylesheet" href="addons/css.css">
    <script src="addons/jquery.min.js"></script>
    <script src="addons/popper.min.js"></script>
    <script src="addons/bootstrap.min.js"></script>
</head>
<body>
<style>
    body{
        /*background: linear-gradient(to right, #fc00ff,#00dbde)*/
    }
    .form{
        display: flex;
        flex-direction: column;
        width: 500px;
        margin: 0 auto;
        margin-top: 200px;
        padding: 50px;
        -webkit-box-shadow: -1px 3px 16px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: -1px 3px 16px 0px rgba(0,0,0,0.75);
        box-shadow: -1px 3px 16px 0px rgba(0,0,0,0.75);
    }
    #table{
        text-align: center;
    }
    .group{
        text-align: center;
    }
    .panel{
        padding: 25px;
    }
    .alert-success, .alert-danger{
        margin-top: 15px;
    }
    .logo{
        color:#fff;
    }
    .tilte_pc_block{
        font-size: 25px;
        display: block;
        text-align: center;
        color: #fff;
    }
    table.dataTable thead .sorting:before, table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:before, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:before, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:before, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:before, table.dataTable thead .sorting_desc_disabled:after {
        position: absolute;
        bottom: 0.3em !important;
        display: block;
        opacity: .3;
    }
    .choice_check{
        text-align: center;
    }
    .choice_check input{
        cursor: pointer;
    }
    .block_element{
        margin-bottom: 25px;
    }
    .inputs {
        display: flex;
        justify-content: space-evenly;
        align-items: baseline;
    }

    .inputs .form-group {
        width: 45%;
    }
    .group {
        display: flex;
        justify-content: space-between;
    }
    .error{
        border: 1px solid red;
    }
    #table{
        width: 100%;
    }
    .description{
        text-align: center;
    }
    .description ul li{
        display: inline-block;
        color: #fff;
    }
    .description_text{
        padding: 5px;
        border-radius: 8px;
        color: #fff;
    }
    .badge-warn{
        background: #754ec1;
    }
</style>
