<x-layouts.company>
    @php
        $user = \App\Helpers\CompanyAuth::user();
    @endphp

    <div>
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-base-content">Company Profile</h1>
            <p class="mt-2 text-base-content/70">Customize your company profile and information</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Edit Section -->
            <div class="lg:col-span-1">
                <livewire:company.edit-company-profile :company="$user->company" />
            </div>

            <!-- Preview Section -->
            <div class="lg:col-span-2">
                <livewire:company.company-profile-preview :company="$user->company" />
            </div>
        </div>
    </div>
</x-layouts.company>
