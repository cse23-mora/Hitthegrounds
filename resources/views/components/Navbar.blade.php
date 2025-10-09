 <div class="navbar bg-base-100 border-b border-base-300 px-2 sm:px-4 md:px-6">
    <div class="navbar-start">
      <!-- Mobile Menu Dropdown -->
      <div class="dropdown lg:hidden">
        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </div>
        <ul
          tabindex="0"
          class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow border border-base-300">
          <li><a href="/" class="{{ request()->routeIs('home') ? 'active text-primary' : 'text-base-content' }}">Home</a></li>
          <li><a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'active text-primary' : 'text-base-content' }}">Registrations</a></li>
          <li><a href="{{ route('timeline') }}" class="{{ request()->routeIs('timeline') ? 'active text-primary' : 'text-base-content' }}">Timeline</a></li>
          <li><a href="{{ route('awards') }}" class="{{ request()->routeIs('awards') ? 'active text-primary' : 'text-base-content' }}">Awards</a></li>
          {{-- <li><a href="{{ route('partners') }}" class="{{ request()->routeIs('partners') ? 'active text-primary' : 'text-base-content' }}">Partners</a></li> --}}
          <li><a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active text-primary' : 'text-base-content' }}">Gallery</a></li>
          <li><a href="{{ route('support') }}" class="{{ request()->routeIs('support') ? 'active text-primary' : 'text-base-content' }}">Support</a></li>
        </ul>
      </div>

      <!-- Logo -->
      <a class="btn btn-ghost text-sm sm:text-lg md:text-xl lg:text-2xl font-black normal-case px-1 sm:px-4">
        <span class="text-base-content">HIT</span>
        <span class="text-primary ml-1">THE</span>
     
        <span class="text-base-content ml-1 xs:hidden sm:inline">GROUNDS</span>
    
      </a>
    </div>

    <!-- Desktop Menu -->
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1 gap-2 xl:gap-4">
        <li><a href="/" class="{{ request()->routeIs('home') ? 'active text-primary' : 'text-base-content' }}">Home</a></li>
          <li><a href="{{ route("register") }}" class="{{ request()->routeIs('register') ? 'active text-primary' : 'text-base-content' }}">Registrations</a></li>
          <li><a href="{{ route("timeline") }}" class="{{ request()->routeIs('timeline') ? 'active text-primary' : 'text-base-content' }}">Timeline</a></li>
          <li><a href="{{ route("awards") }}" class="{{ request()->routeIs('awards') ? 'active text-primary' : 'text-base-content' }}">Awards</a></li>
          {{-- <li><a href="{{ route("partners") }}" class="{{ request()->routeIs('partners') ? 'active text-primary' : 'text-base-content' }}">Partners</a></li> --}}
          <li><a href="{{ route("gallery") }}" class="{{ request()->routeIs('gallery') ? 'active text-primary' : 'text-base-content' }}">Gallery</a></li>
          <li><a href="{{ route("support") }}" class="{{ request()->routeIs('support') ? 'active text-primary' : 'text-base-content' }}">Support</a></li>
      </ul>
    </div>

    <!-- CTA Button -->
    <div class="navbar-end">
      <a href="{{ route('login') }}" class="btn btn-primary btn-sm sm:btn-md text-xs sm:text-sm md:text-base">
        <span class="hidden sm:inline">Company Login</span>
        <span class="sm:hidden">Login</span>
      </a>
    </div>
  </div>