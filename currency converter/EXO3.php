<?php
include 'inputModulPro.php'
?>
<?php
    if (isset($_POST['ok']) && !empty($_POST['amount'])){
            // Make the API request
        $api_url = "https://v6.exchangerate-api.com/v6/b7b8a83748671bd9a16f8417/latest/{$_POST['from']}";
        $answer = file_get_contents($api_url); //string
        $data = json_decode($answer, true); // table 3D 
        $ratesALL = $data['conversion_rates']; //table 2D
        $rateOfTo = $ratesALL[$_POST['to']]; // value
        $result = $rateOfTo * $_POST['amount'];
    }
    else{
            // Make the API request
    $api_url = "https://v6.exchangerate-api.com/v6/b7b8a83748671bd9a16f8417/latest/mad";
    $answer = file_get_contents($api_url); //string
    $data = json_decode($answer, true); // table 3D 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: content-box;
        }
        form{
            backdrop-filter: blur(7px);
            background-color: rgb(20, 20, 30, 0.8);
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        body {
            background-image: url('ideogram.jpeg');
            background-size: contain;
            min-height: 100vh;
        }

        .container  {
            padding: 1rem;
            border-radius: 1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #ccc;
            height: 22rem;
            width:25rem;
        }

        .head,
        .body,
        .foot {
            background-color: white;
            display: block;
            padding: 1rem;
            border-radius: 1rem;
        }

        h2,
        h4 {
            text-align: center;
        }
        p{
            display: flex;
            justify-content:space-between;
            align-items:center;
            padding:0.5rem;
        }
        input{
            padding: 0.3rem;
            border: none;
            fill: none;
            outline: none;
            background-color: #ccc;
        }
        input[type='submit']{
            font-weight:bold;
            color:green;
            width: 100%;
            padding:0.5rem;
            border-radius:3px;
            cursor:pointer;
        }
        input[type='submit']:hover{
            background-color: #aaa;
        }
    </style>
</head>
<body>
    <?= formOpen() ?>
    <div class="container">
        <div class="head">
            <h2>Currency Exchange</h2>
        </div>
        <div class="body">
            <p>
                <span>
                    Convert From :    
                    <?= reservedSelect('from', $data['conversion_rates']) ?>
                </span>
                <?= reservedInputText('amount') ?>
            </p>
            <p>
                <span>
                    To :
                </span>  
                <?= reservedSelect('to', $data['conversion_rates']) ?>
            </p>
            <p>
                <?= inputSubmit('ok','Convert') ?>
            </p>
        </div>
        <div class="foot">
            <p>
                <span>Result</span>
                <input type="text" name="result" value='<?=isset($result)?$result:""?>' disabled>
            </p>
        </div>
    <?=formClose()?>
    </div>
</body>
</html>