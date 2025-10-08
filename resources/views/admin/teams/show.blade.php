<x-layouts.admin>
    <div>
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-base-content">{{ $team->team_name }}</h1>
                    <p class="mt-2 text-base-content/70">Team Details & Members</p>
                </div>
                <a href="{{ route('admin.teams') }}" wire:navigate class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Back to Teams
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Team Info Card -->
            <div class="lg:col-span-1">
                <div class="card bg-base-100 shadow-sm border-base-300 border-1">
                    <div class="card-body">
                        <h2 class="card-title">Team Information</h2>
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="font-semibold">Team ID</p>
                                <p class="text-base-content/70">{{ $team->id }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Team Name</p>
                                <p class="text-base-content/70">{{ $team->team_name }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Company</p>
                                <p class="text-base-content/70">{{ $team->company?->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Captain Email</p>
                                <p class="text-base-content/70">{{ $team->captain_email }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Captain Phone</p>
                                <p class="text-base-content/70">{{ $team->captain_phone }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Total Members</p>
                                <p class="text-base-content/70">{{ $team->members->count() }}/12</p>
                            </div>
                            <div>
                                <p class="font-semibold">Captain</p>
                                <p class="text-base-content/70">{{ $team->captain()?->name ?? 'Not assigned' }}</p>
                            </div>
                            <div>
                                <p class="font-semibold">Status</p>
                                <div class="flex gap-2">
                                    @if($team->locked)
                                        <span class="badge badge-warning">Locked</span>
                                    @else
                                        <span class="badge badge-info">Open</span>
                                    @endif
                                    @if($team->approved)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-ghost">Pending</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold">Created</p>
                                <p class="text-base-content/70">{{ $team->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        @if(!$team->approved)
                        <div class="mt-4">
                            <livewire:admin.approve-team :team="$team" />
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Team Members Card -->
            <div class="lg:col-span-2">
                <div class="card bg-base-100 shadow-sm border-base-300 border-1">
                    <div class="card-body">
                        <h2 class="card-title">Team Members ({{ $team->members->count() }}/12)</h2>

                        <!-- Team Composition Progress -->
                        <div class="mb-4 p-4 bg-base-200 rounded-lg">
                            <h3 class="font-semibold mb-3">Team Composition</h3>

                            <!-- Progress Bars -->
                            <div class="space-y-3">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Male Players (Required: 6, Max: 9)</span>
                                        <span class="font-semibold {{ $team->getMaleCount() >= 6 ? 'text-success' : 'text-warning' }}">
                                            {{ $team->getMaleCount() }}/9
                                        </span>
                                    </div>
                                    <progress
                                        class="progress {{ $team->getMaleCount() >= 6 ? 'progress-success' : 'progress-warning' }} w-full"
                                        value="{{ $team->getMaleCount() }}"
                                        max="9"
                                    ></progress>
                                </div>

                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span>Female Players (Required: 2, Max: 3)</span>
                                        <span class="font-semibold {{ $team->getFemaleCount() >= 2 ? 'text-success' : 'text-warning' }}">
                                            {{ $team->getFemaleCount() }}/3
                                        </span>
                                    </div>
                                    <progress
                                        class="progress {{ $team->getFemaleCount() >= 2 ? 'progress-success' : 'progress-warning' }} w-full"
                                        value="{{ $team->getFemaleCount() }}"
                                        max="3"
                                    ></progress>
                                </div>
                            </div>

                            <!-- Validation Status -->
                            @if($team->members->count() > 0)
                            <div class="mt-3">
                                @if($team->isValidConfiguration())
                                    <div class="alert alert-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Team meets all requirements!</span>
                                    </div>
                                @elseif($team->meetsMinimumRequirements())
                                    <div class="alert alert-info">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                        </svg>
                                        <span>Team meets minimum requirements. Can add {{ 12 - $team->members->count() }} more player(s).</span>
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                        <span>
                                            Team doesn't meet requirements. Need:
                                            @if($team->getMaleCount() < 6) {{ 6 - $team->getMaleCount() }} more male player(s) @endif
                                            @if($team->getFemaleCount() < 2) {{ 2 - $team->getFemaleCount() }} more female player(s) @endif
                                        </span>
                                    </div>
                                @endif
                            </div>
                            @endif
                        </div>

                        <!-- Members Grid -->
                        @if($team->members->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                @foreach($team->members as $member)
                                    <div class="card bg-base-200 shadow-sm">
                                        <figure class="px-4 pt-4">
                                            <img
                                                src="{{ $member->picture ? Storage::url($member->picture) : ($member->gender === 'Female' ? '/placeholder/female.avif' : '/placeholder/male.avif') }}"
                                                alt="{{ $member->name }}"
                                                class="rounded-lg h-32 w-32 object-cover"
                                            />
                                        </figure>
                                        <div class="card-body p-4">
                                            <h3 class="font-semibold text-sm">{{ $member->name }}</h3>
                                            <p class="text-xs text-base-content/70">{{ $member->gender }}</p>
                                            <div class="flex gap-1 flex-wrap mt-1">
                                                @if($member->is_captain)
                                                    <span class="badge badge-primary badge-xs">Captain</span>
                                                @else
                                                    <span class="badge badge-ghost badge-xs">Member</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 mx-auto opacity-50">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                <p class="mt-4 text-base-content/70">No members added yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>
