@extends('layouts.app')

@section('content')
    <!-- Contact Us Section -->
    <section id="contact" class=" bg-gray-100">
        <div class="hero-gradient text-white py-25">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center" data-aos="fade-up">
                    <h2 class="text-4xl md:text-5xl font-bold mb-6">Contact Us</h2>
                    <p class="text-xl text-blue-100 mb-8">Empowering students through innovative education,
                        comprehensive
                        programs, and a nurturing environment that fosters growth and success.</p>
                </div>
            </div>
        </div>
        <div class="container mx-auto mb-6 px-4">
            <div class="my-10 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-md p-5 border border-slate-300"
                    data-aos="fade">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Send Us a Message</h3>
                    <form class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-2 gap-x-4">
                            <div class="mb-2">
                                <label for="name" class="block text-gray-700 mb-2">Full
                                    Name</label>
                                <input type="text" id="name"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="mb-2">
                                <label for="email" class="block text-gray-700 mb-2">Email
                                    Address</label>
                                <input type="email" id="email"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea id="message" rows="5"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300 w-full">
                            Send Message
                        </button>
                    </form>
                </div>
                <div class="bg-white rounded-md p-5 border border-slate-300"
                    data-aos="fade">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Get In Touch</h3>
                    <div class="space-y-4">
                        <div class="flex gap-3 items-start">
                            <div
                                class="p-2 rounded-md border border-gray-200 text-indigo-600">
                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Address</h4>
                                <p class="text-gray-600">123 Education Street, Siem Reap,
                                    Cambodia</p>
                            </div>
                        </div>

                        <div class="flex gap-3 items-start">
                            <div
                                class="p-2 rounded-md border border-gray-200 text-indigo-600">
                                <i class="fas fa-phone text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Phone</h4>
                                <p class="text-gray-600">
                                    <a href="">+855 12 345 678</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div
                                class="p-2 rounded-md border border-gray-200 text-indigo-600">
                                <i class="fas fa-envelope text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Email</h4>
                                <p class="text-gray-600">
                                    <a href="">info@watdamnakschool.edu.kh</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-3 items-start">
                            <div
                                class="p-2 rounded-md border border-gray-200 text-indigo-600">
                                <i class="fas fa-clock text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Office Hours</h4>
                                <p class="text-gray-600">Monday - Friday: 7:30 AM - 4:30 PM</p>
                                <p class="text-gray-600">Saturday: 8:00 AM - 12:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <h4 class="font-bold mb-4 text-gray-800">Follow Us</h4>
                        <ul class="flex gap-2 list-none p-0 m-0">
                            <li>
                                <a href="https://www.facebook.com/watdamnakWLC"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700 transition duration-300">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-400 text-white rounded-full hover:bg-blue-500 transition duration-300">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-pink-600 text-white rounded-full hover:bg-pink-700 transition duration-300">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>

                            <li>
                                <a href="#"
                                    class="w-[35px] h-[35px] flex items-center justify-center bg-blue-700 text-white rounded-full hover:bg-blue-800 transition duration-300">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10206.756600307903!2d103.8509038618926!3d13.350547721934372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3110177b2e6df487%3A0x77fe87a9d25b10ab!2sWat%20Damnak!5e0!3m2!1sen!2skh!4v1763206452680!5m2!1sen!2skh"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection

@push('scripts')
    <script></script>
@endpush
