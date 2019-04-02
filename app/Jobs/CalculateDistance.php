<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateDistance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var array $from 起始位置 */
    protected $from;

    /** @var array $to 结束位置 */
    protected $to;

    /** @var int $id 数据ID */
    protected $id;

    /** @var int $tries 最大尝试次数 */
    public $tries = 5;

    /**
     * Create a new job instance
     *
     * CalculateDistance constructor.
     * @param $from
     * @param $to
     * @param $id
     *
     * @return void
     */
    public function __construct($from, $to, $id)
    {
        $this->from = $from;
        $this->to = $to;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $response = $client->get('https://apis.map.qq.com/ws/distance/v1/' . http_build_query([
                'mode' => 'walking',
                'from' => $this->from[1]. ',' . $this->from[0],
                'to' => $this->to[1]. ',' . $this->to[0],
                'key' => config('game.apps.tencent_map_key')
            ])
        );

        $distance = json_decode($response->getBody(), true)['results']['elements'][0]['distance'];

        Log::debug('Response From Tencent Map Api', [
            'id' => $this->id,
            'Response' => $response
        ]);

        if ($distance <= config('game.rules.min_distance')) {
            DB::table('card_user')->where('id', $this->id)->update(['valid' => 1]);
        }
    }
}
