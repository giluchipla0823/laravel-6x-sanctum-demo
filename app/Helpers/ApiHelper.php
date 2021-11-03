<?php

namespace App\Helpers;

class ApiHelper
{
    CONST IDX_STR_API_JSON = 'jsonapi';
    CONST IDX_STR_API_VERSION = 'version';
    CONST IDX_STR_API_NAME = 'name';
    CONST IDX_STR_API_SUMMARY = 'summary';
    CONST IDX_STR_JSON_CODE = "code";
    CONST IDX_STR_JSON_MESSAGE = "message";
    CONST IDX_STR_JSON_ERRORS = "errors";
    CONST IDX_STR_JSON_DATA = "data";
    CONST MSG_SUCCESSFUL_OPERATION = 'Successful operation.';

    private static $response = array(
        self::IDX_STR_API_JSON => array(
            self::IDX_STR_API_VERSION => '1.0.0',
            self::IDX_STR_API_NAME => 'Bookstore Api',
            self::IDX_STR_API_SUMMARY => 'Api for obtain information about books, authors, publishers and genres.',
        )
    );

    /**
     * Estructura de respuesta JSON.
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @param array $extras
     * @return array
     */
    public static function makeResponse($data, string $message, int $code, array $extras = []): array
    {
        $response = self::$response;
        $response[self::IDX_STR_JSON_CODE] = $code;
        $response[self::IDX_STR_JSON_MESSAGE] = $message;

        if(is_array($data) || is_object($data)){
            $response[self::IDX_STR_JSON_DATA] = $data;
        }

        foreach ($extras as $key => $value){
            $response[$key] = $value;
        }

        return $response;
    }
}
