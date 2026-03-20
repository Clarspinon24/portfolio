<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = [
    'name',
    'email',
    'password',
    'last_seen_at', 
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'last_seen_at'      => 'datetime', 
    ];
    public function isOnline(): bool
    {
    // Considéré en ligne si actif dans les 5 dernières minutes
    return $this->last_seen_at && $this->last_seen_at->gt(now()->subMinutes(5));
    }

    public function messages()
    {
    return $this->hasMany(\App\Models\Message::class, 'sender_id');
    }

    // Récupère la liste des utilisateurs avec qui on a eu une conversation
    public function conversations()
    {
    $sentTo = \App\Models\Message::where('sender_id', $this->id)
        ->select('receiver_id as user_id')
        ->distinct();

    $receivedFrom = \App\Models\Message::where('receiver_id', $this->id)
        ->select('sender_id as user_id')
        ->distinct();

    $userIds = $sentTo->union($receivedFrom)->pluck('user_id');

    return \App\Models\User::whereIn('id', $userIds)->get();
    }

    }



