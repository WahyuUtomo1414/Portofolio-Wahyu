<x-layouts.public 
    :title="$profile['name'] . ' — ' . $profile['role']"
    :description="$profile['bio']">

    <!-- 1. Hero Section -->
    <x-home.hero :profile="$profile" :stats="$stats" />

    <!-- 2. Tech Stack Marquee Running Banner -->
    <x-home.skills :skills="$skills" />

    <!-- 3. Section 01: Featured Projects -->
    <x-home.featured-projects :projects="$featured_projects" />

    <!-- 4. Section 02: Career & Education Experience -->
    <x-home.experience :experiences="$experiences" />

    <!-- 5. Section 03: Core Development Values -->
    <x-home.about-preview :values="$values" />

    <!-- 6. Section 04: Contact CTA & Direct Form -->
    <x-home.contact-cta :profile="$profile" />

</x-layouts.public>
