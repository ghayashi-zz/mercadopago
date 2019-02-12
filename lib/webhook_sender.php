<?php
require 'curl_wrapper.php';

/**
 * WEBHOOK SENDER
 */
class WEBHOOK_SENDER
{
    // CURL Wrapper
    private $curl = null;
    private $debug = false;

    public function __construct( $debug = false )
    {
        // initialize rest_wrapper
        $this->curl = new CURL_WRAPPER();
        $this->debug = $debug;
    }

    /**
     * SEND Webhook Notification for URL
     *
     * @param [string] $notification_url
     * @return bool
     */
    public function send($notification_url, $body = false )
    {
        // execute POST
        $body = !$body ? $this->create_body() : $body;
        $response = $this->curl->post($notification_url, $body);

        if ( $this->debug ) {
            $this->debug($response);
        }

        // validate RESPONSE
        if ($response['http_code'] == 200 || $response['http_code'] == 201) {
            return true;
        }

        return false;
    }

    /**
     * Create Webhook Body to be sent
     *
     * @return void
     */
    public function create_body()
    {
        return array();
    }

    /**
     * Debug purpouses
     *
     * @param [string] $response
     * @return void
     */
    private function debug($response) {
        print '<pre>Http Response Code: ';
        print_r($response['http_code']);
        print '<br>Http Execution time: ';
        print_r($response['total_time']);
        print '<br>Http Response Body: ';
        print_r($response['response_http_body']);
        print '</pre>';
    }
}
