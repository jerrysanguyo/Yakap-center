<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taguig Yakap Center</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-50 text-gray-700 font-body" x-data="scrollHandler()" x-init="init()" @scroll.window="onScroll">
    <nav class="flex items-center justify-between p-6 bg-white shadow-lg sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <img src="images/logoyakap.jpg" alt="Taguig Yakap Center Logo" class="h-10 w-10 rounded-full shadow-sm" />
            <span class="text-3xl font-extrabold text-blue-700 font-display tracking-wide">
                Taguig Yakap Center
            </span>
        </div>

        <div class="hidden md:flex space-x-8 text-lg font-medium">
            <template x-for="link in ['services', 'about', 'contact']" :key="link">
                <a :href="'#' + link" @click.prevent="scrollTo(link)" :class="(activeSection === link ? 'text-blue-700 underline underline-offset-4 ' : '') +
                'hover:text-blue-700 hover:underline underline-offset-4 transition-all duration-300'">
                    <span x-text="link.charAt(0).toUpperCase() + link.slice(1)"></span>
                </a>
            </template>
        </div>
    </nav>

    <section class="relative bg-gray-50 h-screen flex items-center justify-center overflow-hidden">
        <video autoplay muted loop playsinline class="absolute top-0 left-0 w-full h-full object-cover z-0">
            <source src="videos/yakacentervid.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="absolute inset-0 bg-gradient-to-r from-white/80 via-white/60 to-transparent"></div>
        <div class="relative z-10 max-w-4xl text-center px-6">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight font-roboto rounded-md"
                style="color: #ED1C24;">
                Yakap <span style="color: #F4CD27;">Center</span> For Children with Disabilities
            </h1>
            <p class="mt-6 text-lg text-gray-700 font-poppins">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
            <a href="#contact"
                class="mt-8 inline-block px-8 py-4 bg-blue-700 text-white font-semibold rounded-full shadow-md hover:bg-blue-800 hover:scale-105 transition-transform duration-300">
                Enroll Now
            </a>
        </div>
    </section>

    <section id="services" x-intersect:enter="activeSection = 'services'"
        class="py-20 px-6 md:px-20 bg-gradient-to-b from-white via-blue-50 to-white">
        <h2 class="text-5xl font-extrabold text-center text-blue-900 mb-20 tracking-wide">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 px-4 md:px-8 lg:px-12">
            <div
                class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 text-center border border-blue-100">
                <div
                    class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-stethoscope text-3xl text-blue-700"></i>
                </div>
                <h3 class="text-xl font-bold mt-14 mb-3 text-blue-800">Medical & Therapy Services</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    The Yakap Center provides essential medical and therapeutic interventions tailored to the individual
                    needs of children with disabilities. These include pediatric physical therapy to improve mobility
                    and motor skills, occupational therapy for daily functional independence, and speech therapy to
                    enhance communication abilities. The center also facilitates consultations with rehabilitation
                    doctors and developmental pediatricians, ensuring a holistic medical approach to each child’s
                    development and well-being.
                </p>
            </div>

            <div
                class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 text-center border border-blue-100">
                <div
                    class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-book-open text-3xl text-blue-700"></i>
                </div>
                <h3 class="text-xl font-bold mt-14 mb-3 text-blue-800">Educational Programs</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Education at the Yakap Center is specialized and inclusive, designed to accommodate varying learning
                    needs and developmental stages. Programs include the Early Intervention Program for younger children
                    to stimulate growth during formative years, and the Transition Program that prepares older children
                    for further education or integration into society. They also offer tailored instruction through the
                    Deaf/Hard of Hearing Program and the Braille Literacy Program, as well as a Pre-Vocational Program
                    that equips students with practical skills for independent living and future employment.
                </p>
            </div>

            <div
                class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 text-center border border-blue-100">
                <div
                    class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-palette text-3xl text-blue-700"></i>
                </div>
                <h3 class="text-xl font-bold mt-14 mb-3 text-blue-800">Creative & Developmental Facilities</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    To support holistic development, the Yakap Center features diverse creative and sensory facilities.
                    These include an E-Library and Multimedia Room to enhance cognitive and literacy development, as
                    well as spaces like an Arts & Crafts Room, Music Room, and Dance Studio to nurture expression and
                    creativity. The center also provides therapy-specific areas such as hydrotherapy pools and sensory
                    rooms, along with braille signage and accessibility features to ensure an inclusive environment for
                    all.
                </p>
            </div>

            <div
                class="relative bg-white p-8 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 text-center border border-blue-100">
                <div
                    class="absolute -top-10 left-1/2 transform -translate-x-1/2 w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-coffee text-3xl text-blue-700"></i>
                </div>
                <h3 class="text-xl font-bold mt-14 mb-3 text-blue-800">Livelihood Program</h3>
                <p class="text-gray-600 text-sm leading-relaxed">
                    The Yakap Center extends its services beyond therapy and education through the Equal Grounds
                    Café—its livelihood program. This initiative empowers individuals with disabilities by providing
                    real-world work experience in a supportive setting. Through hands-on roles in the café, participants
                    gain valuable skills in communication, service, and responsibility, helping them move toward
                    self-reliance and long-term employment opportunities.
                </p>
            </div>
        </div>
    </section>

    <section id="about" x-intersect:enter="activeSection = 'about'" class="relative overflow-hidden py-24 px-6">
        <img src="images/yakap.webp" alt="Taguig Yakap Center"
            class="absolute inset-0 w-full h-full object-cover opacity-70" />

        <div class="relative max-w-4xl mx-auto text-center z-10 animate-fade-up">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-800 mb-6  drop-shadow-lg" style="color: #ED1C24;">
                About Taguig Yakap Center</h2>
            <div class="w-24 h-1 bg-red-600 mx-auto mb-8 rounded-full"></div>
            <p
                class="text-gray-800 text-lg md:text-xl leading-relaxed px-4 md:px-0  backdrop-blur-sm p-6 rounded-2xl shadow-md">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            </p>
        </div>
    </section>

    <section id="mission-vision" class="p-10 md:p-20 bg-gradient-to-b from-white to-blue-50">
        <h2 class="text-5xl font-extrabold text-center text-blue-800 mb-16 font-roboto">
            Our Mission & Vision
        </h2>
        <div class="max-w-5xl mx-auto grid md:grid-cols-2 gap-12">
            <div
                class="bg-white p-10 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <h3 class="text-3xl font-bold text-blue-700 mb-6 font-poppins text-center">
                    Our Mission
                </h3>
                <p class="text-gray-600 text-lg leading-relaxed font-poppins text-center">
                    To empower individuals and organizations by providing innovative, reliable, and cutting-edge
                    solutions that drive success, inspire growth, and foster a positive impact on the global community.
                </p>
            </div>
            <div
                class="bg-white p-10 rounded-3xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300">
                <h3 class="text-3xl font-bold text-blue-700 mb-6 font-poppins text-center">
                    Our Vision
                </h3>
                <p class="text-gray-600 text-lg leading-relaxed font-poppins text-center">
                    To be a globally recognized leader in our industry, setting benchmarks of excellence, driving
                    transformative change, and making a lasting difference through innovation, collaboration, and
                    integrity.
                </p>
            </div>
        </div>
    </section>
    <footer class="p-6 bg-white text-center text-sm text-gray-500 font-poppins">
        © 2025 Information Technology. All rights reserved.
    </footer>
</body>

</html>