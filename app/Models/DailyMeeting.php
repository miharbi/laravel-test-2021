<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMeeting extends Model
{
    use HasFactory;

    /**
     * Fields that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'done',
        'doing',
        'blocking',
        'todo'
    ];

    protected $appends = [
        'is_listable'
    ];

    /**
     * A message belong to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsListableAttribute()
    {
        return !empty($this->done) || !empty($this->blocking) || !empty($this->todo) || !empty($this->doing);
    }
}
