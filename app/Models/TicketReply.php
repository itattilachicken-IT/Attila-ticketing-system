<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{

         public function ticketing()
        {
            return this->belongsTo(Ticketing::class,'ticket_id');
        }
        

        public function user()
        {
            return this->belongsTo(User::class);
        }
        
    
}
