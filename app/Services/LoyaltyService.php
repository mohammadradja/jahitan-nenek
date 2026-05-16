<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class LoyaltyService
{
    /**
     * Calculate and award points based on order total.
     * Default: 1 point for every Rp 10.000 spent.
     */
    public static function awardPoints(Order $order): void
    {
        if (!$order->user_id) {
            return;
        }

        $user = User::find($order->user_id);
        if (!$user) {
            return;
        }

        // Formula: 1 point per 10k IDR
        $pointsEarned = floor($order->total_price / 10000);

        if ($pointsEarned > 0) {
            $user->increment('loyalty_points', $pointsEarned);
            
            Log::info("Loyalty: Awarded {$pointsEarned} points to User #{$user->id} for Order #{$order->id}");
        }
    }

    /**
     * Deduct points (for redemption or cancellation).
     */
    public static function deductPoints(User $user, int $points, string $reason = ''): void
    {
        if ($user->loyalty_points >= $points) {
            $user->decrement('loyalty_points', $points);
            Log::info("Loyalty: Deducted {$points} points from User #{$user->id}. Reason: {$reason}");
        }
    }
}
