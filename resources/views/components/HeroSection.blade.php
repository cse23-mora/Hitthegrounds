<div
    class="hero min-h-screen relative overflow-hidden bg-cover bg-center bg-no-repeat"
    style="background-image: url('/hero.avif');">
    <!-- Dark overlay/vignette -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-transparent to-black/80"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-transparent to-black/60"></div>

    <!-- Main content -->
    <div class="hero-content relative lg:absolute lg:left-8 xl:left-16 2xl:left-24 lg:top-16 xl:top-20 2xl:top-24 flex-col items-start gap-8 sm:gap-10 md:gap-12 w-full max-w-full lg:max-w-2xl xl:max-w-3xl z-10 px-4 sm:px-6 md:px-8 lg:px-0 py-12 sm:py-16 lg:py-0">
      <div class="flex flex-col gap-6 sm:gap-8">
        <!-- Main heading -->
        <h1 class="w-full" data-aos="fade-up" data-aos-duration="500">
          <span class="text-white dark:text-base-content text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-normal font-['Jolly_Lodger'] uppercase leading-tight">Hit </span>
          <span class="text-primary text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-normal font-['Jolly_Lodger'] uppercase leading-tight">The </span>
          <span class="text-white dark:text-base-content text-5xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-normal font-['Jolly_Lodger'] uppercase leading-tight">Grounds </span>
        </h1>

        <!-- Description -->
        <p class="text-white dark:text-base-content text-sm sm:text-base md:text-lg lg:text-xl xl:text-2xl font-medium font-['Poppins'] leading-relaxed max-w-prose" data-aos="zoom-in" >
          Join us for Hit the Grounds – the annual cricket tournament organized by the Department of Computer Science and Engineering of the University of Moratuwa. Where the spirit from the university meets the drive from the industry, it's more than just a game, it's where passion and excellence collide!
        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6">
          <button class="btn btn-neutral btn-md sm:btn-md lg:btn-lg font-['Poppins'] w-full sm:w-auto min-h-12">
            <span class="hidden sm:inline">View Tournament Schedule</span>
            <span class="sm:hidden">View Schedule</span>
          </button>
          <button class="btn btn-primary btn-md sm:btn-md lg:btn-lg font-['Poppins'] w-full sm:w-auto min-h-12">
            Register
          </button>
        </div>
      </div>

      <!-- Stats section -->
      <div class="stats stats-vertical sm:stats-horizontal shadow-xl bg-base-100/10 backdrop-blur-sm w-full sm:w-auto lg:min-w-2xl">
        <div class="stat place-items-center py-4 sm:py-6">
          <div class="stat-value text-white font-['Staatliches'] text-4xl sm:text-5xl lg:text-6xl" data-count="20">0+</div>
          <div class="stat-title text-white dark:text-base-content font-['Poppins'] text-sm sm:text-base">Teams</div>
        </div>
        <div class="stat place-items-center py-4 sm:py-6">
          <div class="stat-value text-white font-['Staatliches'] text-4xl sm:text-5xl lg:text-6xl" data-count="300">0+</div>
          <div class="stat-title text-white dark:text-base-content font-['Poppins'] text-sm sm:text-base">Participants</div>
        </div>
        <div class="stat place-items-center py-4 sm:py-6">
          <div class="stat-value text-white font-['Staatliches'] text-4xl sm:text-5xl lg:text-6xl" data-count="100">0%</div>
          <div class="stat-title text-white dark:text-base-content font-['Poppins'] text-sm sm:text-base">Entertainment</div>
        </div>
      </div>
    </div>

    <!-- Player image - positioned on the right, hidden on mobile/tablet -->
    <img
      class="absolute right-0 lg:right-8 xl:right-16 2xl:right-32 top-0 h-full object-contain hidden lg:block opacity-90"
      src="/player.avif"
      alt="Cricket player"
    data-aos="fade-left" data-aos-duration="2000" data-aos-delay="500" data-aos-offset="200"
      />
  </div>

  <script>
document.addEventListener('DOMContentLoaded', function() {
  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-count'));
    const isPercentage = element.textContent.includes('%');
    const hasPlus = element.textContent.includes('+');
    let current = 0;
    const increment = target / 50; // Duration control
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      
      const suffix = isPercentage ? '%' : (hasPlus ? '+' : '');
      element.textContent = Math.floor(current) + suffix;
    }, 40); // Speed control (40ms = smooth animation)
  }

  // Intersection Observer for triggering animation when in view
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const counters = entry.target.querySelectorAll('[data-count]');
        counters.forEach(counter => {
          if (!counter.classList.contains('animated')) {
            counter.classList.add('animated');
            animateCounter(counter);
          }
        });
      }
    });
  }, { threshold: 0.5 });

  // Observe the stats container
  const statsContainer = document.querySelector('.stats');
  if (statsContainer) {
    observer.observe(statsContainer);
  }
});
</script>