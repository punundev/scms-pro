@extends('layouts.app')

@section('content')
  <style>
    .card-hover {
      transition: all 0.3s ease;
    }

    .card-hover:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }

    .stat-card {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .program-card {
      border-left: 4px solid #3b82f6;
    }

    .floating {
      animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
      0% {
        transform: translate(0, 0px);
      }

      50% {
        transform: translate(0, -15px);
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
  </style>

  <!-- Hero Section -->
  <section class="hero-gradient text-white py-20">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">What We Do</h1>
        <p class="text-xl text-blue-100 mb-8">Empowering students through innovative education, comprehensive
          programs, and a nurturing environment that fosters growth and success.</p>
        <div class="flex flex-wrap justify-center gap-4">
          <a href="#programs"
            class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
            Explore Programs
          </a>
          <a href="#impact"
            class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-700 transition duration-300">
            See Our Impact
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center" data-aos="fade-up" data-aos-delay="100">
          <div class="stat-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <i class="fas fa-users text-2xl"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">500+</h3>
          <p class="text-gray-600">Students Enrolled</p>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="200">
          <div class="stat-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <i class="fas fa-chalkboard-teacher text-2xl"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">25+</h3>
          <p class="text-gray-600">Qualified Teachers</p>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="300">
          <div class="stat-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <i class="fas fa-book-open text-2xl"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">15+</h3>
          <p class="text-gray-600">Programs Offered</p>
        </div>
        <div class="text-center" data-aos="fade-up" data-aos-delay="400">
          <div class="stat-card w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 text-white">
            <i class="fas fa-graduation-cap text-2xl"></i>
          </div>
          <h3 class="text-3xl font-bold text-gray-800 mb-2">98%</h3>
          <p class="text-gray-600">Success Rate</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Programs Section -->
  <section id="programs" class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Our Educational Programs</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">We offer a diverse range of programs designed to meet the
          unique needs and aspirations of every student.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Program 1 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="100">
          <div class="h-48 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
            <i class="fas fa-book-reader text-white text-5xl"></i>
          </div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-graduation-cap text-blue-600"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800">Primary Education</h3>
            </div>
            <p class="text-gray-600 mb-4">Building strong foundations in literacy, numeracy, and critical
              thinking skills for young learners.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Age 6-11 years
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Comprehensive curriculum
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Creative learning methods
              </li>
            </ul>
            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
              Learn More
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>
        </div>

        <!-- Program 2 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="200">
          <div class="h-48 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
            <i class="fas fa-laptop-code text-white text-5xl"></i>
          </div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-desktop text-green-600"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800">Secondary Education</h3>
            </div>
            <p class="text-gray-600 mb-4">Preparing students for higher education with advanced subjects and
              career guidance.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Age 12-18 years
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                STEM-focused learning
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                University preparation
              </li>
            </ul>
            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
              Learn More
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>
        </div>

        <!-- Program 3 -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="300">
          <div class="h-48 bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center">
            <i class="fas fa-language text-white text-5xl"></i>
          </div>
          <div class="p-6">
            <div class="flex items-center mb-4">
              <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                <i class="fas fa-globe text-purple-600"></i>
              </div>
              <h3 class="text-xl font-bold text-gray-800">Language Courses</h3>
            </div>
            <p class="text-gray-600 mb-4">Master English, French, and other languages with our immersive
              language programs.</p>
            <ul class="space-y-2 mb-6">
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                All age groups
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Native-speaking teachers
              </li>
              <li class="flex items-center text-gray-600">
                <i class="fas fa-check text-green-500 mr-2"></i>
                Cultural immersion
              </li>
            </ul>
            <a href="#" class="text-blue-600 font-semibold hover:text-blue-700 flex items-center">
              Learn More
              <i class="fas fa-arrow-right ml-2"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Teaching Methodology -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="flex flex-col lg:flex-row items-center gap-12">
        <div class="lg:w-1/2" data-aos="fade-right">
          <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Our Teaching Methodology</h2>
          <p class="text-gray-600 mb-8 text-lg">We believe in innovative, student-centered approaches that make
            learning engaging and effective.</p>

          <div class="space-y-6">
            <div class="flex items-start">
              <div class="bg-blue-100 p-3 rounded-lg mr-4">
                <i class="fas fa-handshake text-blue-600 text-xl"></i>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Interactive Learning</h3>
                <p class="text-gray-600">Students actively participate in lessons through discussions,
                  projects, and hands-on activities.</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="bg-green-100 p-3 rounded-lg mr-4">
                <i class="fas fa-puzzle-piece text-green-600 text-xl"></i>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Problem-Based Approach</h3>
                <p class="text-gray-600">We challenge students with real-world problems to develop critical
                  thinking and solution-finding skills.</p>
              </div>
            </div>

            <div class="flex items-start">
              <div class="bg-purple-100 p-3 rounded-lg mr-4">
                <i class="fas fa-users text-purple-600 text-xl"></i>
              </div>
              <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Collaborative Environment</h3>
                <p class="text-gray-600">Teamwork and peer learning are encouraged to build communication
                  and social skills.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="lg:w-1/2" data-aos="fade-left">
          <div class="relative">
            <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 text-white floating">
              <div class="text-center">
                <i class="fas fa-lightbulb text-5xl mb-6"></i>
                <h3 class="text-2xl font-bold mb-4">Innovation in Education</h3>
                <p class="text-blue-100">We continuously evolve our teaching methods to incorporate the
                  latest educational research and technology.</p>
              </div>
            </div>

            <!-- Floating elements -->
            <div class="absolute -top-4 -right-4 bg-yellow-400 text-gray-800 p-4 rounded-xl shadow-lg">
              <i class="fas fa-star text-xl"></i>
            </div>
            <div class="absolute -bottom-4 -left-4 bg-green-400 text-white p-4 rounded-xl shadow-lg">
              <i class="fas fa-trophy text-xl"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Extracurricular Activities -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Beyond the Classroom</h2>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">We offer diverse extracurricular activities to help
          students discover their passions and develop well-rounded personalities.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-md text-center card-hover" data-aos="fade-up" data-aos-delay="100">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-music text-red-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mb-2">Music & Arts</h3>
          <p class="text-gray-600">Choir, instrumental lessons, drawing, and painting classes.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center card-hover" data-aos="fade-up" data-aos-delay="200">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-running text-blue-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mb-2">Sports</h3>
          <p class="text-gray-600">Football, basketball, volleyball, and traditional games.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center card-hover" data-aos="fade-up" data-aos-delay="300">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-robot text-green-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mb-2">STEM Club</h3>
          <p class="text-gray-600">Robotics, coding, and science experiments.</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md text-center card-hover" data-aos="fade-up" data-aos-delay="400">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-hands-helping text-purple-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mb-2">Community Service</h3>
          <p class="text-gray-600">Environmental projects and community outreach programs.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Impact Section -->
  <section id="impact" class="py-16 bg-gradient-to-r from-blue-600 to-purple-700 text-white">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Our Impact</h2>
        <p class="text-xl text-blue-100 max-w-3xl mx-auto">See how our programs are transforming lives and creating
          opportunities for our students.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <div data-aos="fade-right">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-user-graduate text-2xl"></i>
              </div>
              <div>
                <h3 class="text-2xl font-bold">Student Success Stories</h3>
                <p class="text-blue-100">Hear from our alumni</p>
              </div>
            </div>
            <p class="text-blue-100 mb-6">"The language program at Wat Damnak gave me the confidence to pursue
              my dream of studying abroad. Today, I'm a university student in Australia!"</p>
            <div class="flex items-center">
              <div class="w-12 h-12 bg-yellow-400 rounded-full mr-4"></div>
              <div>
                <p class="font-semibold">Sophea Chan</p>
                <p class="text-blue-200 text-sm">Class of 2021</p>
              </div>
            </div>
          </div>
        </div>

        <div data-aos="fade-left">
          <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 border border-white/20">
            <div class="flex items-center mb-6">
              <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-chart-line text-2xl"></i>
              </div>
              <div>
                <h3 class="text-2xl font-bold">Community Impact</h3>
                <p class="text-blue-100">Making a difference</p>
              </div>
            </div>
            <p class="text-blue-100 mb-6">Our students have initiated community projects that have benefited
              over 2,000 local residents, from environmental cleanups to educational workshops.</p>
            <div class="bg-white/10 rounded-lg p-4">
              <div class="flex justify-between text-center">
                <div>
                  <p class="text-2xl font-bold">15+</p>
                  <p class="text-blue-200 text-sm">Projects</p>
                </div>
                <div>
                  <p class="text-2xl font-bold">2,000+</p>
                  <p class="text-blue-200 text-sm">People Impacted</p>
                </div>
                <div>
                  <p class="text-2xl font-bold">5</p>
                  <p class="text-blue-200 text-sm">Awards</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="py-16 bg-white">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Join Our Learning Community</h2>
        <p class="text-xl text-gray-600 mb-8">Discover how our programs can help you or your child achieve
          educational success and personal growth.</p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <a href="#"
            class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
            Enroll Now
          </a>
          <a href="#"
            class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-50 transition duration-300">
            Schedule a Visit
          </a>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script></script>
@endpush
