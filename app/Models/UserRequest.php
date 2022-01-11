<?php

namespace App\Models;

use App\Helpers\Logger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_agent_id',
        'ip',
        'headers',
        'created_at',
    ];

    //region [RELATIONSHIPS]
    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }

    //endregion [RELATIONSHIPS]

    public static function log(Logger $logger)
    {
        $userAgent = UserAgent::getModel($logger->getUserAgentName());
        $userId = $logger->getUserId();

        return UserRequest::query()
            ->create([
                'user_id' => $userId,
                'user_agent_id' => $userAgent->id,
                'ip' => $logger->getIp(),
                'headers' => json_encode($logger->getHeaders()),
                'created_at' => $logger->getCreatedAt()
            ]);
    }

}
