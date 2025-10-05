<?php

use App\Models\Company;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public function with(): array
    {
        return [
            'companies' => Company::withCount(['users', 'teams'])
                ->latest()
                ->paginate(10),
        ];
    }
}; ?>

<div>
    <div class="card bg-base-100 shadow-sm border-base-300 border-1">
        <div class="card-body">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company Name</th>
                            <th>Phone</th>
                            <th>Users</th>
                            <th>Teams</th>
                            <th>Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td class="font-semibold">{{ $company->name }}</td>
                                <td>{{ $company->phone ?? 'N/A' }}</td>
                                <td>{{ $company->users_count }}</td>
                                <td>{{ $company->teams_count }}</td>
                                <td>{{ $company->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-base-content/70">No companies found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</div>
