<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <style>
        body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        
        #shopping-cart table{width:100%;background-color:#F0F0F0;}
        #shopping-cart table td{background-color:#FFFFFF;}

        .txt-heading{
            padding: 10px 10px;
            border-radius: 2px;
            color: #FFF;
            background: #6aadf1;
            margin-bottom:10px;
        }
        a.btnRemoveAction{color:#D60202;border:0;padding:2px 10px;font-size:0.9em;}
        a.btnRemoveAction:visited{color:#D60202;border:0;padding:2px 10px;font-size:0.9em;}

        #btnEmpty {
            background-color: #ffffff;
            border: #FFF 1px solid;
            padding: 1px 10px;
            color: #ff0000;
            font-size: 0.8em;
            float: right;
            text-decoration: none;
            border-radius: 4px;
        }
        .btnAddAction{    background-color: #eb9e4f;
            border: 0;
            padding: 3px 10px;
            color: #ffffff;
            margin-left: 2px;
            border-radius: 2px;
        }
        #shopping-cart {margin-bottom:30px;}
        .cart-item {border-bottom: #79b946 1px dotted;padding: 10px;}
        #product-grid {margin-bottom:30px;}
        .product-item {	float:left;	background: #ffffff;margin:15px 10px;	padding:5px;border:#CCC 1px solid;border-radius:4px;}
        .product-item div{text-align:center;	margin:10px;}
        .product-price {
            color: #005dbb;
            font-weight: 600;
        }
        .product-image {height:100px;background-color:#FFF;}
        .clear-float{clear:both;}
        .demo-input-box{border-radius:2px;border:#CCC 1px solid;padding:2px 1px;}



    </style>


</head>

