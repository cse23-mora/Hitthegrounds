<x-layouts.public>
    <x-TimelineSection />
    <section class="bg-base-200 py-12 sm:py-16 md:py-20">
      <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <div class="max-w-5xl mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">

            <!-- Quick Stats Card -->
            <div class="card bg-base-100 shadow-lg border border-base-300">
              <div class="card-body text-center">
                <div class="bg-primary text-primary-content rounded-full w-16 h-16 shadow-lg flex items-center justify-center mx-auto mb-4">
                  <x-mary-icon name="s-calendar" class="w-8 h-8" />
                </div>
                <h3 class="text-xl font-['Staatliches'] text-base-content mb-2">Tournament Duration</h3>
                <p class="text-primary text-3xl font-['Staatliches']">1 Day</p>
                <p class="text-base-content/70 text-sm font-['Poppins'] mt-2">Full day of cricket action</p>
              </div>
            </div>

            <!-- Registration Period Card -->
            <div class="card bg-base-100 shadow-lg border border-base-300">
              <div class="card-body text-center">
                <div class="bg-success text-success-content rounded-full w-16 h-16 shadow-lg flex items-center justify-center mx-auto mb-4">
                  <x-mary-icon name="s-user-group" class="w-8 h-8" />
                </div>
                <h3 class="text-xl font-['Staatliches'] text-base-content mb-2">Registration Period</h3>
                <p class="text-success text-3xl font-['Staatliches']">54 Days</p>
                <p class="text-base-content/70 text-sm font-['Poppins'] mt-2">Oct 8 - Nov 30, 2025</p>
              </div>
            </div>

            <!-- Preparation Time Card -->
            <div class="card bg-base-100 shadow-lg border border-base-300">
              <div class="card-body text-center">
                <div class="bg-warning text-warning-content rounded-full w-16 h-16 shadow-lg flex items-center justify-center mx-auto mb-4">
                  <x-mary-icon name="s-rocket-launch" class="w-8 h-8" />
                </div>
                <h3 class="text-xl font-['Staatliches'] text-base-content mb-2">Preparation Time</h3>
                <p class="text-warning text-3xl font-['Staatliches']">13 Days</p>
                <p class="text-base-content/70 text-sm font-['Poppins'] mt-2">Nov 30 - Dec 13, 2025</p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
</x-layouts.public>