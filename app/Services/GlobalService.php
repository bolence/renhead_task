<?php namespace App\Services;


class GlobalService {

    /**
     * Log exception in laravel daily log file
     *
     * @param Throwable $exception
     * @return void
     */
    public function log($exception, $message)
    {
        info($message . $exception->getCode() . ' on line ' . $exception->getLine() . ' with message ' . $exception->getMessage());
    }

    /**
     * Successfull response
     *
     * @param String $message
     * @param Object $response
     * @return Illuminate\Http\Response
     */
    public function success_response($message = null, $response)
    {
        $merge_response = array_merge(['message' => $message], $response);
        return response()->json($merge_response, 200);
    }

    /**
     * Unsuccessfull response
     *
     * @param String $message
     * @param Throwable $exception
     * @return \Illuminate\Http\Response
     */
    public function unsuccessful_reponse($message, $exception)
    {
        $this->log($exception, $message);

        return response()->json([
            'message' => $message
        ], 400);
    }

}
