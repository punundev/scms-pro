@extends('layouts.app')

@section('content')
  <!-- Hero / Swiper -->
  <section id="home" class="relative">
    <div class="swiper mySwiper h-[60vh] md:h-[70vh]">
      <div class="swiper-wrapper">
        <!-- slide 1: image -->
        <div class="swiper-slide relative">
          <img
            src="https://scontent.fpnh18-6.fna.fbcdn.net/v/t39.30808-6/486381789_9708334435872500_6548513194613941562_n.jpg?stp=dst-jpg_s960x960_tt6&_nc_cat=104&ccb=1-7&_nc_sid=cc71e4&_nc_eui2=AeEplBOaboVq3oui0YMpwP1G38yoHCHsuhzfzKgcIey6HBphRyHVZl18yHJLPoxoIjZ6h487ZyxEHno04N5SvIv4&_nc_ohc=021nviBI3eoQ7kNvwHrRQHx&_nc_oc=AdlqGmyNajzs4GJZJfozUDnJTI8vEORlZ9WkSmggj7vfFYY4y5nTvrCbz5kFGKhmt50&_nc_zt=23&_nc_ht=scontent.fpnh18-6.fna&_nc_gid=oTuL6sqv3gKByszCZhOlMA&oh=00_AfiErdyA1izR2lujCyZb3bmdko_qjLqFHVaDMnNrY8lvQw&oe=691D68F0"
            alt="slide" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/30 flex items-center">
            <div class="max-w-4xl mx-auto px-6 text-white" data-aos="fade-up">
              <h1 class="text-3xl md:text-5xl font-bold">Wat Damnak Learning Centre</h1>
              <p class="mt-3 max-w-2xl">A community place for learning, culture and togetherness.</p>
              <div class="mt-4">
                <a href="#about" class="inline-block px-4 py-2 bg-indigo-600 rounded-md">Learn
                  More</a>
              </div>
            </div>
          </div>
        </div>

        <!-- slide 2: video -->
        <div class="swiper-slide relative">
          <video class="hero-video" autoplay muted loop playsinline>
            <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
          </video>
          <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end">
            <div class="max-w-4xl mx-auto px-6 pb-12 text-white" data-aos="fade-up">
              <h2 class="text-2xl md:text-4xl font-semibold">Activities & Classes</h2>
              <p class="mt-2">Join our workshops, classes and community events.</p>
            </div>
          </div>
        </div>

        <!-- slide 3: image -->
        <div class="swiper-slide relative">
          <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=1600&q=80&auto=format&fit=crop"
            alt="slide" class="w-full h-full object-cover" />
          <div class="absolute inset-0 bg-black/25 flex items-center">
            <div class="max-w-4xl mx-auto px-6 text-white" data-aos="fade-up">
              <h2 class="text-4xl md:text-6xl font-bold mb-4">Community & Culture</h2>
              <p class="mt-2">Celebrating local knowledge and traditions.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- pagination / navigation -->
      <div class="swiper-pagination"></div>
    </div>
  </section>

  <!-- News Section with Cool Cards -->
  <section id="news" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-4" data-aos="fade-up">Latest News</h2>
      <p class="text-gray-600 text-center mb-12 max-w-2xl mx-auto" data-aos="fade-up"
        data-aos-delay="100">
        Stay updated with the latest happenings and achievements at Wat Damnak Learning Centre
      </p>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- News Card 1 -->
        <div class="news-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up"
          data-aos-delay="100">
          <div class="relative overflow-hidden">
            <img
              src="https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2072&q=80"
              alt="Computer Lab" class="news-image w-full">
            <div class="news-date px-4 pt-4">Oct 10, 2023</div>
          </div>
          <div class="news-content px-4 pb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-3">New Computer Lab Opening
            </h3>
            <p class="text-gray-600 mb-4 line-clamp-3">
              We're excited to announce the opening of our new state-of-the-art computer lab,
              equipped with the latest technology to enhance our students' digital literacy skills.
            </p>
            <a href="#" class="read-more-btn">
              Read More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- News Card 2 -->
        <div class="news-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up"
          data-aos-delay="200">
          <div class="relative overflow-hidden">
            <img
              src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
              alt="Science Competition" class="news-image w-full">
            <div class="news-date px-4 pt-4">Sep 25, 2023</div>
          </div>
          <div class="news-content px-4 pb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-3">Student Achievements in
              National Competition</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">
              Congratulations to our students who won top honors in the National Science Competition,
              showcasing their exceptional knowledge and skills.
            </p>
            <a href="#" class="read-more-btn">
              Read More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>

        <!-- News Card 3 -->
        <div class="news-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up"
          data-aos-delay="300">
          <div class="relative overflow-hidden">
            <img
              src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
              alt="Parent Teacher Meeting" class="news-image w-full">
            <div class="news-date px-4 pt-4">Sep 15, 2023</div>
          </div>
          <div class="news-content px-4 pb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-3">Parent-Teacher Meeting
              Schedule</h3>
            <p class="text-gray-600 mb-4 line-clamp-3">
              The upcoming parent-teacher meetings have been scheduled. Please check the school
              notice board for your allocated time slot.
            </p>
            <a href="#" class="read-more-btn">
              Read More <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>

      <!-- View All News Button -->
      <div class="text-center mt-12" data-aos="fade-up">
        <a href="#"
          class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition duration-300 font-medium">
          View All News <i class="fas fa-newspaper ml-2"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- Activities & Events Section -->
  <section id="events" class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">Activities & Events</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="100">
          <div class="bg-blue-100 text-blue-800 p-3 rounded-lg mb-4">
            <p class="font-bold">October 15, 2023</p>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Annual Sports Day</h3>
          <p class="text-gray-600 mb-4">Join us for a day of fun, games, and healthy
            competition.</p>
          <a href="#" class="text-blue-600 font-medium hover:underline">Learn
            More</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="200">
          <div class="bg-blue-100 text-blue-800 p-3 rounded-lg mb-4">
            <p class="font-bold">November 5, 2023</p>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Science Fair</h3>
          <p class="text-gray-600 mb-4">Showcasing innovative projects from our
            talented students.</p>
          <a href="#" class="text-blue-600 font-medium hover:underline">Learn
            More</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="300">
          <div class="bg-blue-100 text-blue-800 p-3 rounded-lg mb-4">
            <p class="font-bold">December 20, 2023</p>
          </div>
          <h3 class="text-xl font-bold mb-3 text-gray-800">Winter Concert</h3>
          <p class="text-gray-600 mb-4">Enjoy performances by our music and drama
            students.</p>
          <a href="#" class="text-blue-600 font-medium hover:underline">Learn
            More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Staff Section -->
  <section id="staff" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">Our Dedicated Staff
      </h2>

      <div class="swiper staffSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Principal" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Mr. Somchai</h4>
              <p class="text-blue-600 mb-2">Principal</p>
              <p class="text-gray-600">With over 20 years of experience in
                education, Mr. Somchai leads our school with vision and dedication.</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=761&q=80"
                alt="Teacher" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Ms. Naree</h4>
              <p class="text-blue-600 mb-2">Head of English Department</p>
              <p class="text-gray-600">Passionate about language education and
                student development.</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1544717390-1c8b4c5caf7b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Teacher" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Mr. Anan</h4>
              <p class="text-blue-600 mb-2">Science Teacher</p>
              <p class="text-gray-600">Dedicated to making science accessible and
                exciting for all students.</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80"
                alt="Teacher" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Ms. Srey</h4>
              <p class="text-blue-600 mb-2">Mathematics Teacher</p>
              <p class="text-gray-600">Making complex mathematical concepts simple
                and understandable.</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1551836026-d5c88ac5d691?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Teacher" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Mr. Vichea</h4>
              <p class="text-blue-600 mb-2">Art Teacher</p>
              <p class="text-gray-600">Inspiring creativity and artistic
                expression in our students.</p>
            </div>
          </div>
        </div>
        <div class="swiper-pagination mt-6"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>
    </div>
  </section>

  <!-- Top Students Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">Our Top Students</h2>

      <div class="swiper studentSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Student" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Sokha</h4>
              <p class="text-blue-600 mb-2">Grade 10 - Science</p>
              <p class="text-gray-600">Top scorer in National Science Olympiad
                2023</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Student" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Sreyneath</h4>
              <p class="text-blue-600 mb-2">Grade 11 - Arts</p>
              <p class="text-gray-600">Winner of National Essay Competition 2023
              </p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Student" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Rith</h4>
              <p class="text-blue-600 mb-2">Grade 9 - Mathematics</p>
              <p class="text-gray-600">Gold medalist in International Math
                Challenge</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=764&q=80"
                alt="Student" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Sophea</h4>
              <p class="text-blue-600 mb-2">Grade 12 - Literature</p>
              <p class="text-gray-600">Published poet and winner of Creative
                Writing Award</p>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center student-card">
              <img
                src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                alt="Student" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
              <h4 class="text-xl font-bold text-gray-800">Chan</h4>
              <p class="text-blue-600 mb-2">Grade 8 - Technology</p>
              <p class="text-gray-600">Developed award-winning mobile app for
                community service</p>
            </div>
          </div>
        </div>
        <div class="swiper-pagination mt-6"></div>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">About Wat Damnak
        Learning Centre</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div data-aos="fade-right">
          <h3 id="history" class="text-2xl font-bold mb-4 text-gray-800">Our History
          </h3>
          <p class="text-gray-700 mb-6">
            Founded in 2005, Wat Damnak Learning Centre has been at the forefront of providing quality
            education
            to students in our community. Our journey began with a small group of dedicated educators
            and has
            grown into a thriving educational institution serving hundreds of students each year.
          </p>
          <p class="text-gray-700">
            Over the years, we have continuously evolved our curriculum and teaching methodologies to
            meet
            the changing needs of our students and the demands of the modern world.
          </p>
        </div>
        <div data-aos="fade-left">
          <img
            src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80"
            alt="School History" class="w-full h-64 object-cover rounded-lg shadow-lg">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-12">
        <div data-aos="fade-right">
          <img
            src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
            alt="Mission and Vision" class="w-full h-64 object-cover rounded-lg shadow-lg">
        </div>
        <div data-aos="fade-left">
          <h3 id="mission" class="text-2xl font-bold mb-4 text-gray-800">Mission &
            Vision</h3>
          <p class="text-gray-700 mb-6">
            <strong>Our Mission:</strong> To provide a nurturing and inclusive learning environment that
            empowers
            students to achieve their full potential academically, socially, and emotionally.
          </p>
          <p class="text-gray-700">
            <strong>Our Vision:</strong> To be a leading educational institution that inspires lifelong
            learning,
            fosters innovation, and develops responsible global citizens.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  {{-- <section id="gallery" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12" data-aos="fade-up">Photo Gallery</h2>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <a href="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    data-fancybox="gallery" class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="School Building"
                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </a>

                <a href="https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    data-fancybox="gallery" class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in"
                    data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Students Learning"
                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </a>

                <a href="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80"
                    data-fancybox="gallery" class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in"
                    data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="Classroom"
                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </a>

                <a href="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                    data-fancybox="gallery" class="overflow-hidden rounded-lg shadow-lg" data-aos="zoom-in"
                    data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1523580494863-6f3031224c94?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80"
                        alt="School Event"
                        class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                </a>
            </div>
        </div>
    </section> --}}
@endsection

@push('scripts')
  <script></script>
@endpush
