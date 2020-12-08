<?php
/**
 * Created by PhpStorm.
 * User: mxgel
 * Date: 11/14/16
 * Time: 2:27 AM
 */

namespace Epmnzava\Pesapal\OAuth;


/**
 * Class OAuthSignatureMethod
 *
 * @package Epmnzava\Pesapal\OAuth
 */
class OAuthSignatureMethod
{
    /**
     * @param $request
     * @param $consumer
     * @param $token
     * @param $signature
     *
     * @return bool
     */
    public function check_signature(&$request, $consumer, $token, $signature)
    {
        $built = $this->build_signature($request, $consumer, $token);

        return $built == $signature;
    }
}