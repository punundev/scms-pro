@extends('layouts.app')

@section('content')
  <style>
    .history-gradient {
      background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
    }

    .dark .history-gradient {
      background: linear-gradient(135deg, #020617 0%, #1e3a8a 100%);
    }

    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .dark .card-hover:hover {
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
    }

    .mission-card {
      border-top: 4px solid #3b82f6;
    }

    .vision-card {
      border-top: 4px solid #10b981;
    }

    .values-card {
      border-top: 4px solid #8b5cf6;
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0% {
        transform: translate(0, 0px);
      }

      50% {
        transform: translate(0, -10px);
      }

      100% {
        transform: translate(0, -0px);
      }
    }

    .gradient-text {
      background: linear-gradient(135deg, #1e3a8a, #3b82f6);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .dark .gradient-text {
      background: linear-gradient(135deg, #60a5fa, #3b82f6);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }

    .timeline-item {
      position: relative;
      padding-left: 2rem;
    }

    .timeline-item::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0.5rem;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #3b82f6;
    }

    .timeline-item::after {
      content: '';
      position: absolute;
      left: 5px;
      top: 1.5rem;
      width: 2px;
      height: calc(100% - 1rem);
      background: #e5e7eb;
    }

    .dark .timeline-item::after {
      background: #374151;
    }

    .timeline-item:last-child::after {
      display: none;
    }

    .team-card {
      transition: all 0.3s ease;
    }

    .team-card:hover .team-image {
      transform: scale(1.05);
    }

    .team-image {
      transition: transform 0.3s ease;
    }
  </style>

  <!-- Hero Section -->
  <section class="hero-gradient text-white py-20">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Who I Am</h1>
        <p class="text-xl text-blue-100 mb-8">Discover our story, our mission, and the passionate team behind
          Wat Damnak Learning Centre - dedicated to transforming lives through education since 2005.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="#history"
            class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
            Our History
          </a>
          <a href="#mission"
            class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition duration-300">
            Mission & Vision
          </a>
          <a href="#team"
            class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition duration-300">
            Meet Our Team
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Introduction Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="flex flex-col lg:flex-row items-center gap-12">
        <div class="lg:w-1/2" data-aos="fade-right">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Our Identity & Purpose</h2>
          <p class="text-gray-600 mb-6 text-lg">Wat Damnak Learning Centre is more than just an
            educational
            institution - we are a community dedicated to nurturing young minds and empowering future
            leaders.</p>
          <p class="text-gray-600 mb-8">Founded in 2005, we have grown from a small community
            initiative to a
            respected learning center that has impacted thousands of students in Siem Reap and beyond.</p>

          <div class="grid grid-cols-2 gap-6">
            <div class="text-center">
              <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-heart text-blue-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Passionate</h3>
              <p class="text-gray-600 text-sm">About education</p>
            </div>
            <div class="text-center">
              <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-hand-holding-heart text-green-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Committed</h3>
              <p class="text-gray-600 text-sm">To our community</p>
            </div>
            <div class="text-center">
              <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-lightbulb text-purple-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Innovative</h3>
              <p class="text-gray-600 text-sm">In our approach</p>
            </div>
            <div class="text-center">
              <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-users text-yellow-600 text-2xl"></i>
              </div>
              <h3 class="font-semibold text-gray-800">Inclusive</h3>
              <p class="text-gray-600 text-sm">For all students</p>
            </div>
          </div>
        </div>

        <div class="lg:w-1/2" data-aos="fade-left">
          <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
              <h3 class="text-2xl font-bold mb-4">Our Philosophy</h3>
              <p class="text-blue-100 mb-6">We believe that every child deserves access to quality
                education that not only builds academic skills but also develops character, creativity,
                and critical thinking.</p>
              <div class="space-y-4">
                <div class="flex items-center">
                  <i class="fas fa-check-circle text-yellow-300 mr-3"></i>
                  <span>Holistic development approach</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-check-circle text-yellow-300 mr-3"></i>
                  <span>Student-centered learning</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-check-circle text-yellow-300 mr-3"></i>
                  <span>Cultural preservation</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-check-circle text-yellow-300 mr-3"></i>
                  <span>Community engagement</span>
                </div>
              </div>
            </div>
            <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-white/10 rounded-full floating"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- History Section -->
  <section id="history" class="py-16 history-gradient text-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Our History</h2>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">From humble beginnings to a beacon of education in
          Siem Reap - our journey through the years.</p>
      </div>

      <div class="max-w-4xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div data-aos="fade-right">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 h-full">
              <h3 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-seedling mr-3 text-green-300"></i>
                Our Beginnings
              </h3>
              <p class="text-blue-100 mb-6">Wat Damnak Learning Centre started in 2005 as a small
                initiative within the temple grounds, offering basic English classes to local children
                who had limited access to education.</p>
              <p class="text-blue-100">With just 2 teachers and 35 students, we began our mission to
                provide quality education to the community, focusing on language skills and cultural
                preservation.</p>
            </div>
          </div>

          <div data-aos="fade-left">
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20 h-full">
              <h3 class="text-2xl font-bold mb-6 flex items-center">
                <i class="fas fa-chart-line mr-3 text-yellow-300"></i>
                Growth & Expansion
              </h3>
              <p class="text-blue-100 mb-6">By 2010, we had expanded our programs to include computer
                literacy, arts, and vocational training, responding to the growing needs of our
                community.</p>
              <p class="text-blue-100">We moved to a larger facility and increased our teaching staff to
                accommodate over 200 students, becoming a recognized educational institution in Siem
                Reap.</p>
            </div>
          </div>
        </div>

        <!-- Timeline -->
        <div class="mt-16" data-aos="fade-up">
          <h3 class="text-2xl font-bold text-center mb-8">Our Journey Timeline</h3>
          <div class="space-y-8">
            <div class="timeline-item" data-aos="fade-right">
              <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    2005</div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Foundation</h4>
                <p class="text-gray-600">Wat Damnak Learning Centre established with 35 students and 2
                  teachers, offering basic English classes.</p>
              </div>
            </div>

            <div class="timeline-item" data-aos="fade-left">
              <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    2010</div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Expansion</h4>
                <p class="text-gray-600">Moved to larger facility and expanded programs to include
                  computer literacy and vocational training.</p>
              </div>
            </div>

            <div class="timeline-item" data-aos="fade-right">
              <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    2015</div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Recognition</h4>
                <p class="text-gray-600">Received recognition from Ministry of Education for
                  excellence
                  in community-based education.</p>
              </div>
            </div>

            <div class="timeline-item" data-aos="fade-left">
              <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    2020</div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Digital Transformation</h4>
                <p class="text-gray-600">Implemented digital learning platforms and expanded STEM
                  programs to prepare students for the future.</p>
              </div>
            </div>

            <div class="timeline-item" data-aos="fade-right">
              <div class="bg-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center mb-3">
                  <div class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">
                    2023</div>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Today</h4>
                <p class="text-gray-600">Serving 500+ students with 25+ qualified teachers and
                  comprehensive educational programs.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission & Vision Section -->
  <section id="mission" class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Mission & Vision</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Guiding principles that shape our
          educational
          approach and future aspirations.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="mission-card bg-white rounded-xl shadow-lg p-8 card-hover" data-aos="fade-up" data-aos-delay="100">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Mission</h3>
          <p class="text-gray-600">To provide quality, accessible education that empowers students
            with
            knowledge, skills, and values to become responsible global citizens and leaders in their
            communities.</p>
        </div>

        <div class="vision-card bg-white rounded-xl shadow-lg p-8 card-hover" data-aos="fade-up" data-aos-delay="200">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-eye text-green-600 text-2xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Vision</h3>
          <p class="text-gray-600">To be a leading educational institution in Cambodia that transforms
            lives
            through innovative learning, cultural preservation, and community development.</p>
        </div>

        <div class="values-card bg-white rounded-xl shadow-lg p-8 card-hover" data-aos="fade-up" data-aos-delay="300">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
            <i class="fas fa-heart text-purple-600 text-2xl"></i>
          </div>
          <h3 class="text-2xl font-bold text-gray-800 mb-4">Our Values</h3>
          <ul class="space-y-3 text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
              Integrity and honesty
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
              Respect for diversity
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
              Excellence in education
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mr-2 mt-1"></i>
              Community responsibility
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section id="team" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Meet Our Team</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Passionate educators and staff dedicated to
          making a
          difference in students' lives.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Team Member 1 -->
        <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="100">
          <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <h3 class="text-xl font-bold">Sokha Chen</h3>
              <p class="text-blue-100">Director</p>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-4">Leading our centre with vision and dedication for over 10
              years,
              Sokha is passionate about educational accessibility.</p>
            <div class="flex space-x-3">
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Team Member 2 -->
        <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="200">
          <div class="h-64 bg-gradient-to-br from-green-400 to-green-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <h3 class="text-xl font-bold">Maly Seng</h3>
              <p class="text-green-100">Head of Academics</p>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-4">With 15 years of teaching experience, Maly develops our
              curriculum and ensures educational excellence.</p>
            <div class="flex space-x-3">
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Team Member 3 -->
        <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="300">
          <div class="h-64 bg-gradient-to-br from-purple-400 to-purple-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <h3 class="text-xl font-bold">Rithy Phan</h3>
              <p class="text-purple-100">STEM Coordinator</p>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-4">An engineer turned educator, Rithy brings innovation and
              hands-on
              learning to our science and technology programs.</p>
            <div class="flex space-x-3">
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Team Member 4 -->
        <div class="team-card bg-white rounded-xl shadow-lg overflow-hidden" data-aos="fade-up" data-aos-delay="400">
          <div class="h-64 bg-gradient-to-br from-yellow-400 to-yellow-600 relative overflow-hidden">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute bottom-4 left-4 text-white">
              <h3 class="text-xl font-bold">Sopheap Lim</h3>
              <p class="text-yellow-100">Language Program Head</p>
            </div>
          </div>
          <div class="p-6">
            <p class="text-gray-600 mb-4">Fluent in 4 languages, Sopheap leads our language department
              with
              cultural sensitivity and pedagogical expertise.</p>
            <div class="flex space-x-3">
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-blue-600 transition">
                <i class="fas fa-envelope"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mt-12" data-aos="fade-up">
        <a href="#"
          class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300 inline-flex items-center">
          View All Team Members
          <i class="fas fa-arrow-right ml-2"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="container mx-auto px-4 text-center" data-aos="fade-up">
      <h2 class="text-3xl md:text-4xl font-bold mb-6">Become Part of Our Story</h2>
      <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">Join our community of learners, educators, and
        changemakers dedicated to transforming education in Cambodia.</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="#"
          class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
          Enroll Today
        </a>
        <a href="#"
          class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition duration-300">
          Volunteer With Us
        </a>
        <a href="#"
          class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition duration-300">
          Support Our Mission
        </a>
      </div>
    </div>
  </section>
@endsection
