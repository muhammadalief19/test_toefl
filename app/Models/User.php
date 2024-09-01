<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'target_id',
        'full_name',
        'phone_number',
        'date_of_birth',
        'registration_date',
        'profile_picture',
        'status',
        'prodi',
        'nrp',
        'role',
        'is_verified_register',
        'otp_register',
        'is_verified_forgot',
        'otp_forgot',
        'otp_forgot_expired_at',
        'otp_register_expired_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function target()
    {
        return $this->belongsTo(Target::class);
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role', '_id');
    }

    public function assessment() {
        return $this->hasMany(Assesmen::class, 'user_id', '_id');
    }

    public function learningProfile() {
        return $this->hasMany(LearningProfile::class, 'user_id', '_id');
    }

    public function learningHistory() {
        return $this->hasMany(LearningHistory::class, 'user_id', '_id');
    }

    public function preference() {
        return $this->hasMany(Preference::class, 'user_id', '_id');
    }

    public function recommendation() {
        return $this->hasMany(Recommendation::class, 'user_id', '_id');
    }

    public function quizAnswer() {
        return $this->hasMany(QuizAnswer::class, 'user_id', '_id');
    }

    public function topic() {
        return $this->hasMany(Topic::class, 'user_id', '_id');
    }

    public function post() {
        return $this->hasMany(Post::class, 'posted_by', '_id');
    }

    public function comment() {
        return $this->hasMany(Comment::class, 'commented_by', '_id');
    }

    public function privateMessageSend() {
        return $this->hasMany(PrivateMessage::class, 'sender_id', '_id');
    }

    public function privateMessageAccept() {
        return $this->hasMany(PrivateMessage::class, 'recipient_id', '_id');
    }

    public function activityLog() {
        return $this->hasMany(ActivityLog::class, 'user_id', '_id');
    }

    public function payment() {
        return $this->hasMany(Payment::class, 'user_id', '_id');
    }

    public function notification() {
        return $this->hasMany(Notification::class, 'user_id', '_id');
    }
}
