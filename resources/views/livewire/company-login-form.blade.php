<?php

use App\Models\User;
use App\Models\VerificationCode;
use App\Notifications\VerificationCodeNotification;
use App\Services\JWTService;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Component;

new class extends Component {
    public string $contact_email = '';
    public string $verification_code = '';

    public bool $showVerification = false;
    public ?int $userId = null;

    public function sendCode(): void
    {
        $this->validate([
            'contact_email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        // Find user by email
        $user = User::where('email', $this->contact_email)->first();

        if (!$user) {
            $this->addError('contact_email', 'No account found with this email address.');
            return;
        }

        $this->userId = $user->id;

        // Generate 6-digit verification code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store verification code
        VerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expires_at' => now()->addMinutes(15),
        ]);

        // Send verification email
        Notification::route('mail', $user->email)
            ->notify(new VerificationCodeNotification($code));

        $this->showVerification = true;
    }

    public function verify(): void
    {
        $this->validate([
            'verification_code' => ['required', 'string', 'size:6'],
        ]);

        $verificationCode = VerificationCode::where('user_id', $this->userId)
            ->where('code', $this->verification_code)
            ->where('is_used', false)
            ->where('expires_at', '>', now())
            ->first();

        if (!$verificationCode) {
            $this->addError('verification_code', 'Invalid or expired verification code.');
            return;
        }

        // Mark code as used
        $verificationCode->update(['is_used' => true]);

        // Get user
        $user = User::find($this->userId);

        // Generate JWT token
        $jwtService = new JWTService();
        $token = $jwtService->generateToken($user);

        // Store JWT token in cookie (httpOnly, secure)
        cookie()->queue('company_token', $token, config('app.jwt_ttl'), '/', null, true, true, false, 'strict');

        // Redirect to dashboard
        $this->redirect('/company/dashboard', navigate: true);
    }

    public function back(): void
    {
        $this->showVerification = false;
        $this->verification_code = '';
        $this->userId = null;
    }
}; ?>

<div>
    @if (!$showVerification)
        <!-- Email Input Form -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form wire:submit="sendCode" class="space-y-4">
                    <!-- Contact Email -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Email Address</span>
                        </label>
                        <input
                            type="email"
                            wire:model="contact_email"
                            class="input input-bordered w-full @error('contact_email') input-error @enderror"
                            placeholder="contact@company.com"
                            required
                            autofocus
                        />
                        @error('contact_email')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            Send Verification Code
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-sm text-base-content/70">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="link link-primary">Register here</a>
                    </p>
                </div>
            </div>
        </div>
    @else
        <!-- Verification Form -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h3 class="card-title text-center justify-center">Verify Your Email</h3>
                <p class="text-center text-base-content/70 mb-4">
                    We've sent a 6-digit verification code to {{ $contact_email }}
                </p>

                <form wire:submit="verify" class="space-y-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Verification Code</span>
                        </label>
                        <input
                            type="text"
                            wire:model="verification_code"
                            class="input input-bordered w-full text-center text-2xl tracking-widest @error('verification_code') input-error @enderror"
                            placeholder="000000"
                            maxlength="6"
                            required
                            autofocus
                        />
                        @error('verification_code')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            Verify & Login
                        </button>
                    </div>

                    <div class="form-control">
                        <button type="button" wire:click="back" class="btn btn-ghost w-full">
                            Back to Email
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-sm text-base-content/70">
                        Code expires in 15 minutes
                    </p>
                </div>
            </div>
        </div>
    @endif
</div>
