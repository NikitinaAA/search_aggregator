<?php

namespace App\Services\SocketClient;

use Socket\Raw\Exception as SocketException;
use Socket\Raw\Factory as SocketFactory;

class SocketClientService implements SocketClientInterface
{
    /**
     * @var
     */
    private $socket;

    /**
     * @var string
     */
    private static $protocol = 'tcp';

    /**
     * @var string
     */
    private static $binaryFormat = 'V';

    /**
     * @var int
     */
    private static $connectionTimeout = 100;

    /**
     * @var int
     */
    private static $readLength = 8192;

    /**
     * @param $address
     * @return bool|mixed
     * @throws SocketException
     */
    public function initConnection($address)
    {
        if (!isset($address['ip']) && !isset($address['port'])) {
            return false;
        }

        $address = self::$protocol . "://" . $address['ip'] . ":". $address['port'];

        $factory = new SocketFactory();
        $this->socket = $factory->createClient($address, self::$connectionTimeout);
    }

    /**
     * @param array $data
     * @return mixed|void
     * @throws SocketException
     */
    public function setRequestData(array $data)
    {
        $str = json_encode($data);
        $length = strlen($str);

        $requestData = pack(self::$binaryFormat, $length) . $str;

        $this->socket->write($requestData);
    }

    /**
     * @return bool|mixed
     * @throws SocketException
     */
    public function getResponseData()
    {
        $response = $this->socket->read(self::$readLength);

        if (!$response) {
            return false;
        }

        $responseData = $this->replaceResponse($response);

        $result = json_decode($responseData, true);

        $this->socket->close();

        return $result;
    }

    /**
     * @param $response
     * @return string
     */
    private function replaceResponse($response)
    {
        $search = preg_replace('#\{.*?\}#s', '', $response);

        return ltrim($response, $search);
    }
}
