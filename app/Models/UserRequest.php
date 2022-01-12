<?php

namespace App\Models;

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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    //region [RELATIONSHIPS]
    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }

    //endregion [RELATIONSHIPS]

    public static function log(array $data)
    {
        $userAgent = UserAgent::getModel($data['user_agent_name'] ?? '');

        return UserRequest::query()
            ->create([
                'user_id' => $data['user_id'] ?? null,
                'user_agent_id' => $userAgent->id,
                'ip' => $data['ip'] ?? '',
                'headers' => json_encode($data['headers'] ?? []),
                'created_at' => $data['created_at']
            ]);
    }

}
