<?php

use App\Models\User;
use App\Models\Company;
use App\Models\VerificationCode;
use App\Notifications\VerificationCodeNotification;
use App\Services\JWTService;
use Illuminate\Support\Facades\Notification;
use Livewire\Volt\Component;

new class extends Component {
    public string $company_name = '';
    public string $contact_person_name = '';
    public string $contact_email = '';
    public string $contact_person_phone = '';
    public string $verification_code = '';

    public bool $showVerification = false;
    public ?int $userId = null;

    public function register(): void
    {
        $validated = $this->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'contact_person_phone' => ['required', 'string', 'max:20'],
        ]);

        // Create company
        $company = Company::create([
            'name' => $validated['company_name'],
            'phone' => $validated['contact_person_phone'],
        ]);

        // Create user (company representative)
        $user = User::create([
            'name' => $validated['contact_person_name'],
            'email' => $validated['contact_email'],
            'company_id' => $company->id,
            'is_admin' => false,
        ]);
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

        // Mark email as verified
        $user = User::find($this->userId);
        $user->update(['email_verified_at' => now()]);

        // Generate JWT token
        $jwtService = new JWTService();
        $token = $jwtService->generateToken($user);

        // Store JWT token in cookie (httpOnly, secure)
        cookie()->queue('company_token', $token, config('app.jwt_ttl'), '/', null, true, true, false, 'strict');

        // Redirect to dashboard
        $this->redirect('/company/dashboard', navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    @if (!$showVerification)
        <form wire:submit="register" class="flex flex-col gap-6">
            <x-mary-input
                wire:model="company_name"
                label="{{ __('Company Name') }}"
                type="text"
                required
                autofocus
                placeholder="Enter company name"
            />

            <x-mary-input
                wire:model="contact_person_name"
                label="{{ __('Contact Person Name') }}"
                type="text"
                required
                placeholder="Enter contact person name"
            />

            <x-mary-input
                wire:model="contact_email"
                label="{{ __('Contact Email') }}"
                type="email"
                required
                autocomplete="email"
                placeholder="contact@company.com"
            />

            <x-mary-input
                wire:model="contact_person_phone"
                label="{{ __('Contact Person Phone') }}"
                type="tel"
                required
                placeholder="+1 (555) 123-4567"
            />

            <div class="flex items-center justify-end">
                <x-mary-button type="submit" class="btn-primary w-full">
                    {{ __('Register') }}
                </x-mary-button>
            </div>
        </form>

        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-base-content/70">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" wire:navigate class="link-primary btn-link">
                {{ __('Login here') }}
            </a>
        </div>
    @else
        <form wire:submit="verify" class="flex flex-col gap-6">
            <x-mary-input
                wire:model="verification_code"
                label="{{ __('Verification Code') }}"
                type="text"
                required
                autofocus
                placeholder="000000"
                maxlength="6"
                class="text-center text-2xl tracking-widest"
            />

            <div class="flex items-center justify-end">
                <x-mary-button type="submit" class="btn-primary w-full">
                    {{ __('Verify & Continue') }}
                </x-mary-button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-sm text-base-content/70">
                {{ __('Code expires in 15 minutes') }}
            </p>
        </div>
    @endif
</div>
