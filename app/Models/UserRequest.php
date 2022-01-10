<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_agent_id',
        'ip',
    ];

    //region [RELATIONSHIPS]
    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }

    //endregion [RELATIONSHIPS]

    public static function log()
    {
        $userAgent = UserAgent::getModel(Request::userAgent());

        return UserRequest::query()
            ->create([
                'user_id' => auth()->user()->id ?? null,
                'user_agent_id' => $userAgent->id,
                'ip' => Request::ip(),
            ]);
    }

}
