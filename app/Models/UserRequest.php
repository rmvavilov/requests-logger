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
    ];

    //region [RELATIONSHIPS]
    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }

    //endregion [RELATIONSHIPS]

    public static function log()
    {
        $userAgent = UserAgent::getModel(request()->userAgent());
        $userId = request()->get('userId');

        return UserRequest::query()
            ->create([
                'user_id' => $userId,
                'user_agent_id' => $userAgent->id,
                'ip' => request()->ip(),
                'headers' => json_encode(request()->headers->all()),
            ]);
    }

}
