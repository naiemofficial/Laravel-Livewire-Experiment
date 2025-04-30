<?php
namespace App\Helpers;

use \Illuminate\Http\JsonResponse;
use Illuminate\Routing\ResponseFactory;

class Response {
    // Prepare the JSON Response
    public static function prepare(JsonResponse|ResponseFactory $response, array $preference = []){
        $storage = [
            'success'   => ['data' => [], 'alias' => ['successes']],
            'error'     => ['data' => [], 'alias' => ['errors']],
            'warning'   => ['data' => [], 'alias' => ['warnings']],
            'info'      => ['data' => [], 'alias' => ['infos']],
            'danger'    => ['data' => [], 'alias' => ['dangers']],
            'primary'   => ['data' => [], 'alias' => ['primaries']],
            'secondary' => ['data' => [], 'alias' => ['secondaries']],
            'pending'   => ['data' => [], 'alias' => ['pendings']],
            'unknown'   => ['data' => [], 'alias' => ['unknowns']]
        ];

        $final_storage = [];

        if($response->getData()) {
            $response_data = $response->getData();
            foreach($response_data as $key => $value){
                $final_message = '';
                $key_name = null;
                // Detect the key name
                if(array_key_exists($key, $storage)) {
                    $key_name = $key;
                }

                if(empty($key_name)){
                    foreach($storage as $storage_key => $storage_value){
                        if(in_array($key, $storage_value['alias'])){
                            $key_name = $storage_key;
                            break;
                        }
                    }
                }


                if(!empty($key_name)){
                    // Bucketing the message
                    if (is_string($value)) {
                        $final_message = $value;
                    } else if (is_array($value)) {
                        foreach ($value as $index => $message) {
                            if (is_string($message)) {
                                $final_message = $message;
                            } else if (is_array($message) && (
                                    (isset($message['highlight']) || isset($message['title'])) &&
                                    (isset($message['text']) || isset($message['message']) || isset($message['msg']))
                                )) {
                                $formatted_response = self::formatted_response($message, $storage, $key_name, $preference);
                                // Store Formatted Message
                                if(!empty($formatted_response)){
                                    $final_message = $formatted_response;
                                }
                            } else {
                                // Convert whole value to string
                                $final_message = (string) $message;
                            }
                        }
                    } else {
                        // Convert whole value to string
                        $final_message = (string) $value;
                    }


                    $storage[$key_name]['data'][] = $final_message;

                    $final_storage[] = [
                        'key' => $key_name,
                        'message' => $final_message,
                    ];
                }
            }
        }

        if(isset($preference['return']) && $preference['return'] == 'storage'){
            // return and remove those storage key which data array is 0
            foreach ($storage as $key => $value) {
                if (empty($value['data'])) {
                    unset($storage[$key]);
                }
            }
            return $storage;
        }

        // Return final storage
        return $final_storage;
    }


    // Format Response (Strip tags, Escape HTML)
    private function formatted_response(array $response, array &$storage, string $key_name, array $preference = []){
        foreach ($response as $key => $message) {
            // Strip tags from the message parts
            $highlighted_text = strip_tags($message['highlight'] ?? $message['title'] ?? '');
            $highlighted_text = strlen($highlighted_text) > 0 ? $highlighted_text : '';

            $message_text = strip_tags($message['text'] ?? $message['message'] ?? $message['msg'] ?? '');
            $message_text = strlen($message_text) > 0 ? $message_text : '';

            // Format message with optional htmlspecialchars if preference is set
            $formatted_message = '';
            if(strlen($highlighted_text) > 0 && strlen($message_text) > 0){
                $formatted_message = '<b>' . htmlspecialchars($highlighted_text, ENT_QUOTES, 'UTF-8') . ':</b> ' . htmlspecialchars($message_text, ENT_QUOTES, 'UTF-8');
            }

            // Only add to storage if message is not empty
            if(strlen($formatted_message) > 1){
                return $storage[$key_name]['data'][] = $formatted_message;
            }
            return null;
        }
    }


    // Flash the message to view in frontend
    public static function visualize(string $template, JsonResponse|ResponseFactory|array $request, array $preference = [])
    {
        if($request instanceof JsonResponse || $request instanceof ResponseFactory){
            $processed_data = self::prepare($request, $preference);
        } else {
            $processed_data = $request;
        }

        if(boolval($preference['session-flash'] ?? null)){
            session()->flash('template', $template);
            session()->flash($template, $processed_data);
        }
    }
}
