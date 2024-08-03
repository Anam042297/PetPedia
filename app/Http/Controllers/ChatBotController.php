<?php

namespace App\Http\Controllers;
use BotMan\BotMan\BotMan;
// use BotMan\BotMan\BotManFactory;
// use BotMan\BotMan\Drivers\DriverManager;
// use Illuminate\Http\Request;
// use OpenAI\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        if (!$this->apiKey) {
            Log::error('OpenAI API key not set');
        } else {
            Log::info('OpenAI API key set: ' . $this->apiKey);
        }
    }

    //     public function handle()
//     {
//         $botman = app('botman');

    //         $botman->hears('{message}', function (BotMan $botman, $message) {
//             if ($message == 'hi') {
//                 $this->askName($botman);
//             } else {
//                 $response = $this->getOpenAIResponse($message);
//                 $botman->reply($response);
//             }
//         });

    //         $botman->listen();
//     }

        public function askName(BotMan $botman)
    {
        $botman->ask('Hello! What is your name?', function (Answer $answer) use ($botman) {
            $name = $answer->getText();
            $botman->reply('Nice to meet you, ' . $name);
        });
    }

    //     private function getOpenAIResponse($message)
// {
//     $client = new Client();

    //     Log::info('Sending request to OpenAI with API key: ' . $this->apiKey);

    //     try {
//         $response = $client->post('https://api.openai.com/v1/chat/completions', [
//             'json' => [
//                 'model' => 'gpt-3.5-turbo',
//                 'messages' => [
//                     [
//                         'role' => 'user',
//                         'content' => $message
//                     ]
//                 ],
//                 'max_tokens' => 150
//             ],
//             'headers' => [
//                 'Authorization' => 'Bearer ' . $this->apiKey,
//                 'Content-Type' => 'application/json'
//             ]
//         ]);

    //         $body = json_decode($response->getBody(), true);
//         Log::info('OpenAI response: ' . json_encode($body));

    //         return $body['choices'][0]['message']['content'];
//     } catch (RequestException $e) {
//         Log::error('Error while making request to OpenAI: ' . $e->getMessage());
//         Log::error('Exception trace: ' . $e->getTraceAsString());

    //         if ($e->hasResponse()) {
//             $response = $e->getResponse();
//             $statusCode = $response->getStatusCode();
//             $responseBody = $response->getBody()->getContents();
//             Log::error('Response status code: ' . $statusCode);
//             Log::error('Response body: ' . $responseBody);

    //             if ($statusCode == 429) {
//                 return 'Sorry, you have exceeded your API quota. Please try again later.';
//             }
//         }

    //         return 'Sorry, there was an error processing your request.';
//     }
// }
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function (BotMan $botman, $message) {
            Log::info('Received message: ' . $message);
            if ($message == 'hi') {
                $this->askName($botman);
            } elseif ($this->isPetRelated($message)) {
                Log::info('Message is pet-related.');
                $response = $this->getOpenAIResponse($message);
                $botman->reply($response);
            } else {
                Log::info('Message is not pet-related.');
                $botman->reply("I'm here to help with pet-related queries. Please ask something about pets.");
            }
        });

        $botman->listen();
    }

    private function isPetRelated($message)
    {
        // Simple keyword-based check for pet-related queries
        $petKeywords = ['pet', 'dog','dogs', 'cat', 'cats', 'animal', 'puppy',
         'kitten', 'breed', 'vet', 'pet food', 'pet care','bird care', 'bird grooming',
          'bird health', 'bird breeds', 'parrots', 'canaries', 'parakeets', 
          'bird cages', 'bird food', 'bird toys', 'bird behavior', 'bird training'];

        foreach ($petKeywords as $keyword) {
            if (stripos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    private function getOpenAIResponse($message)
    {
        $client = new  Client();

        Log::info('Sending request to OpenAI with API key: ' . $this->apiKey);

        try {
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'json' => [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => $message
                        ]
                    ],
                    'max_tokens' => 150
                ],
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json'
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            Log::info('OpenAI response: ' . json_encode($body));

            return $body['choices'][0]['message']['content'];
        } catch (RequestException $e) {
            Log::error('Error while making request to OpenAI: ' . $e->getMessage());
            Log::error('Exception trace: ' . $e->getTraceAsString());

            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $responseBody = $response->getBody()->getContents();
                Log::error('Response status code: ' . $statusCode);
                Log::error('Response body: ' . $responseBody);

                if ($statusCode == 429) {
                    return 'Sorry, you have exceeded your API quota. Please try again later.';
                }
            }

            return 'Sorry, there was an error processing your request.';
        }
    }
}
