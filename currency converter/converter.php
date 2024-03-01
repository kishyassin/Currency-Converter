<?php
        $api_url = "https://v6.exchangerate-api.com/v6/b7b8a83748671bd9a16f8417/latest/mad";

        // Make the API request
        $response = file_get_contents($api_url);
        $data = json_decode($response, true);
        $ratesALL = $data['conversion_rates'];
        echo $ratesALL['USD'];
                ?>