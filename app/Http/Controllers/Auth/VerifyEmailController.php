<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Assurez-vous que l'utilisateur est de type MustVerifyEmail
        if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail) {
            if ($user->hasVerifiedEmail()) {
                return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
            }

            if ($user->markEmailAsVerified()) {
                event(new Verified($user));
            }
        } else {
            // Gérer le cas où l'utilisateur ne correspond pas au type attendu
            abort(403, 'Unauthorized action.');
        }

        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
