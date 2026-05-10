<template>
  <!-- Dark themed Auth layout wrapper -->
  <div class="min-h-screen bg-[#0A0A0A] flex items-center justify-center px-4 relative overflow-hidden">
    <!-- Background glow -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute top-1/3 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full bg-accent/8 blur-[120px]" />
    </div>
    <!-- Subtle grid -->
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image:linear-gradient(rgba(157,255,32,.4) 1px,transparent 1px),linear-gradient(90deg,rgba(157,255,32,.4) 1px,transparent 1px);background-size:60px 60px;" />

    <div class="relative z-10 w-full max-w-md">
      <!-- Logo -->
      <div class="text-center mb-8">
        <a href="/en" class="inline-block">
          <img src="/img/logo-white.png" alt="ELDITECH" class="h-12 mx-auto" />
        </a>
      </div>

      <!-- Card -->
      <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-8 shadow-2xl">
        <slot />
      </div>

      <!-- Footer link -->
      <p class="text-center text-xs text-gray-600 mt-6">
        © {{ new Date().getFullYear() }} PT ELIAS DIGITAL TEKNOLOGI
      </p>
    </div>
  </div>
</template>
