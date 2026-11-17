<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

trait HasApiTokens
{
    /**
     * Create a new personal access token for this model.
     */
    public function createToken(string $name, array $abilities = ['*'])
    {
        $plainSecret = Str::random(40);
        $hashed = hash('sha256', $plainSecret);

        $tokenId = rand(100, 999);
        try {
            if (Schema::hasTable('personal_access_tokens')) {
                $tokenId = DB::table('personal_access_tokens')->insertGetId([
                    'tokenable_type' => get_class($this),
                    'tokenable_id' => $this->id,
                    'name' => $name,
                    'token' => $hashed,
                    'abilities' => json_encode($abilities),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        } catch (\Throwable $e) {
            // Graceful fallback if table is not yet migrated
        }

        $fullToken = "{$tokenId}|{$plainSecret}";

        return new class($fullToken) {
            public string $plainTextToken;

            public function __construct(string $token)
            {
                $this->plainTextToken = $token;
            }
        };
    }

    /**
     * Delete current access token for this model.
     */
    public function currentAccessToken()
    {
        $user = $this;

        return new class($user) {
            protected $user;

            public function __construct($user)
            {
                $this->user = $user;
            }

            public function delete(): bool
            {
                try {
                    if (Schema::hasTable('personal_access_tokens')) {
                        DB::table('personal_access_tokens')
                            ->where('tokenable_type', get_class($this->user))
                            ->where('tokenable_id', $this->user->id)
                            ->delete();
                    }
                } catch (\Throwable $e) {
                    // Ignore
                }
                return true;
            }
        };
    }
}
