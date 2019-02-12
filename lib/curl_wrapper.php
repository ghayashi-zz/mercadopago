<?php
/**
 * Rest wrapper for Curl executions
 */
class CURL_WRAPPER
{
    /**
     * POST Wrapper
     *
     * @param [string] $url
     * @param [array] $params
     * @return void
     */
    public function post($url, $params)
    {
        // convert params into json
        $params = json_encode($params);
        $curl = curl_init();

        // set curl options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $params,
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json",
            ),
        ));

        // execute curl
        $response = curl_exec($curl);
        $info = curl_getinfo($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "\ncURL Error #:" . $err;
            die('error on curl execution');
        }

        // add body if received
        $info['response_http_body'] = $response;

        return $info;
    }

    /**
     * GET Wrapper
     *
     * @param [string] $url
     * @param [array] $params
     * @return void
     */
    public function get($url)
    {
        // create curl resource
        $curl = curl_init();

        $headers = array(
            "accept: application/json",
            "content-type: application/json"
        );

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, $url);


        // execute curl
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            echo "\ncURL Error #:" . $err;
            die('error on curl execution');
        }

        return $response;

    }
}
