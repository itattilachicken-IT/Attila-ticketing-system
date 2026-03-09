<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ticket extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes.
     */
    protected $fillable = [
        'guest_name',
        'guest_email',
        'guest_phone',
        'guest_location',
        'title',
        'description',
        'priority',
        'help_topic',
        'status',
        'user_id',
        'assigned_to',
    ];

    /**
     * Ticket creator (registered user).
     * Will be NULL for guest tickets.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Assigned staff member.
     */
    public function assignedStaff()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Default values.
     */
    protected $attributes = [
        'status'   => 'open',
        'priority' => 'low',
    ];

  public function messages()
{
    return $this->hasMany(TicketMessage::class)->latest();
}  

}