<x-layouts.public>
        <!-- Hero Section -->
    <section class="bg-base-200 py-12 sm:py-16 md:py-20 lg:py-24">
      <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <div class="max-w-4xl mx-auto text-center">
          <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold font-['Jolly_Lodger'] uppercase mb-6">
            <span class="text-base-content">Awards & </span>
            <span class="text-primary">Recognition</span>
          </h1>
          <p class="text-base-content/80 text-base sm:text-lg md:text-xl font-['Poppins'] leading-relaxed">
            More than just runs and wickets — it's about celebrating those standout moments.
            Here are the awards that will honor the best of the best!
          </p>
        </div>
      </div>
    </section>

    <!-- Awards Cards Section -->
    <section class="bg-base-100 py-12 sm:py-16 md:py-20">
      <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 max-w-6xl mx-auto">

          <!-- Champions Award -->
          <div class="card bg-base-200 shadow-xl border border-base-300 hover:border-primary transition-all duration-300">
            <div class="card-body">
              <div class="flex items-center gap-4 mb-4">
                <div class="avatar placeholder">
                  <div class="bg-primary text-primary-content rounded-full w-16 h-16">
                    <Icon name="mdi:trophy" class="text-3xl" />
                  </div>
                </div>
                <h2 class="card-title text-2xl md:text-3xl font-['Staatliches'] text-primary">Champions</h2>
              </div>
              <p class="text-base-content/80 font-['Poppins'] text-base md:text-lg">
                Awarded to the tournament-winning team
              </p>
              <div class="card-actions justify-end mt-4">
                <div class="badge badge-primary badge-outline">Team Award</div>
              </div>
            </div>
          </div>

          <!-- Runners-up Award -->
          <div class="card bg-base-200 shadow-xl border border-base-300 hover:border-primary transition-all duration-300">
            <div class="card-body">
              <div class="flex items-center gap-4 mb-4">
                <div class="avatar placeholder">
                  <div class="bg-accent text-accent-content rounded-full w-16 h-16">
                    <Icon name="mdi:medal" class="text-3xl" />
                  </div>
                </div>
                <h2 class="card-title text-2xl md:text-3xl font-['Staatliches'] text-accent">Runners-up</h2>
              </div>
              <p class="text-base-content/80 font-['Poppins'] text-base md:text-lg">
                Awarded to the teams with the 2nd and 3rd highest scores
              </p>
              <div class="card-actions justify-end mt-4">
                <div class="badge badge-accent badge-outline">Team Awards</div>
              </div>
            </div>
          </div>

          <!-- Player of the Tournament -->
          <div class="card bg-base-200 shadow-xl border border-base-300 hover:border-primary transition-all duration-300">
            <div class="card-body">
              <div class="flex items-center gap-4 mb-4">
                <div class="avatar placeholder">
                  <div class="bg-warning text-warning-content rounded-full w-16 h-16">
                    <Icon name="mdi:star-circle" class="text-3xl" />
                  </div>
                </div>
                <h2 class="card-title text-2xl md:text-3xl font-['Staatliches'] text-warning">Player of the Tournament</h2>
              </div>
              <p class="text-base-content/80 font-['Poppins'] text-base md:text-lg">
                The most outstanding player across all matches
              </p>
              <div class="card-actions justify-end mt-4">
                <div class="badge badge-warning badge-outline">Individual Award</div>
              </div>
            </div>
          </div>

          <!-- Best Performing Players -->
          <div class="card bg-base-200 shadow-xl border border-base-300 hover:border-primary transition-all duration-300">
            <div class="card-body">
              <div class="flex items-center gap-4 mb-4">
                <div class="avatar placeholder">
                  <div class="bg-success text-success-content rounded-full w-16 h-16">
                    <Icon name="mdi:account-star" class="text-3xl" />
                  </div>
                </div>
                <h2 class="card-title text-2xl md:text-3xl font-['Staatliches'] text-success">Best Performing Players</h2>
              </div>
              <p class="text-base-content/80 font-['Poppins'] text-base md:text-lg">
                Recognizing excellent individual performances
              </p>
              <div class="card-actions justify-end mt-4">
                <div class="badge badge-success badge-outline">Individual Awards</div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- Call to Action Section -->
    <section class="bg-base-200 py-12 sm:py-16 md:py-20">
      <div class="container mx-auto px-4 sm:px-6 md:px-8">
        <div class="card bg-base-100 shadow-xl border border-primary max-w-4xl mx-auto">
          <div class="card-body text-center py-8 md:py-12">
            <h2 class="card-title text-3xl sm:text-4xl md:text-5xl font-['Staatliches'] text-primary justify-center mb-4">
              Ready to Compete?
            </h2>
            <p class="text-base-content/80 font-['Poppins'] text-base md:text-lg mb-6">
              Register your team now and compete for these prestigious awards!
            </p>
            <div class="card-actions justify-center">
              <button class="btn btn-primary btn-lg font-['Poppins']">
                Register Your Team
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    </x-layouts.public>
