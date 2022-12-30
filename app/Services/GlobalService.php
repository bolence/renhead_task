<?php namespace App\Services;


class GlobalService {

    /**
     * Undocumented function
     *
     * @param [type] $exception
     * @return void
     */
    public function log($exception)
    {
        info('Error durin creating a new travel payment ' . $exception->getCode() . ' on line ' . $exception->getLine() . ' with message ' . $exception->getMessage());
    }


    public function success_response($message = null, $response)
    {
        $merge_response = array_merge(['message' => $message], $response);
        return response()->json($merge_response, 200);
    }


    public function unsuccessful_reponse($message, $exception)
    {
        $this->log($exception);

        return response()->json([
            'message' => $message
        ], 400);
    }

}
