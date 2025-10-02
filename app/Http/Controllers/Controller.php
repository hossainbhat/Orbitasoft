<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendJson($statusCode = 200, $success = true, $code = 'A01', $payload = 'Successful!', $type = 'success', $message = 'Successfully')
    {
        return response()->json([
            'success' => $success,
            'code'    => $code,
            'message' => $message,
            'payload' => $payload,
            'type'    => $type
        ], $statusCode);
    }


    public function sendValidationError($errors, $message = 'The given data was invalid.')
    {
        return $this->sendJson(422, false, config('rest.response.validation_error.code'), $errors, 'error', $message);
    }
  
    public function sendUnauthorizedError($errors, $message = 'Unauthorized Access.')
    {
        $errors = [
            'message' => [$message]
        ];
        return $this->sendJson(401, false, config('rest.response.unauthorized.code'), $errors, 'error', $message);
    }
 
    public function sendEmailVarifiedError($message = 'Please Verify your email address.')
    {
        $errors = [
            'message' => [$message]
        ];
        return $this->sendJson(307, false, config('rest.response.login.verify_email.code'), $errors, 'error', $message);
    }


    public function sendAddSuccess($data, $message = "Successfully Added")
    { 
        $payload = [
            'data' => $data
        ];
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }
   
    public function sendUpdateSuccess($data, $message = "Successfully Updated")
    {
        # code...   
        $payload = [
            'data' => $data
        ];
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendDeleteSuccess($data = [])
    {
        $payload = [
            'item' => $data
        ];
        $message = "Successfully deleted";
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendSuccess($payload, $message = "Success")
    {
        return $this->sendJson(200, true, config('rest.response.success.code'), $payload, 'success', $message);
    }

    public function sendInvalid($message = "Wrong email or password!")
    {
        $payload = [
            'message' => [$message]
        ];
        return $this->sendJson(403, false, config('rest.response.login.invalid.code'), $payload, 'error', $message);
    }


    public function sendNotFound($message = "Not found. Try another one")
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(404, false, config('rest.response.error.code'), $payload, 'error', $message);
    }

    public function sendError($message = 'Whoops, looks like something went wrong! Please try again.')
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(511, false, config('rest.response.error.code'), $payload, 'error');
    }
    
    public function sendPermissionError($message = 'Permission denied. Please contact your admin.')
    {
        $payload = [
            'message' => $message
        ];
        return $this->sendJson(403, false, config('rest.response.error.code'), $payload, 'error', $message);
    }

    public function isEmail($item)
    {
        # code...
        $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
        if (preg_match($pattern, $item) === 1) { // Email address
            return true;
        } else {
            return false;
        }
    }
 
}
