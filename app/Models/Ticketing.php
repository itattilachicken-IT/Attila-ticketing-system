<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{
    public function ticketreply(){
        return this->hasMany(TicketReply::class,'ticket_id');

    }
       
        public function user()
        {
            return this->belongsTo(User::class);
        }
        
    }

