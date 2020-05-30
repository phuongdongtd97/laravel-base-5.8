<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/15/2019
 * Time: 11:18 PM
 */

namespace App\TraitHelpers;


trait ApiResponseTrait
{
    public function handleExcuteActionResponse($status, $message, $data = null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        return $response;

    }

    public function handleResourceResponse($status, $data = null, $message = null)
    {
        $response = [
            'status' => $status,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        if ($message) {
            $response['message'] = $message;
        }
        return $response;
    }

    public function handleResourcesResponse($status, $data = null, $message = null)
    {
        $response = [
            'status' => $status,
        ];
        if ($data) {
            $response['data'] = $data;
        }
        if ($message) {
            $response['message'] = $message;
        }
        return $response;
    }
}
