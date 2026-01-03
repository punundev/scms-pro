@extends('layouts.app')

@section('content')
  <style>
    .donation-gradient {
      background: linear-gradient(135deg, #1e3a8a 0%, #0f172a 100%);
    }

    .dark .donation-gradient {
      background: linear-gradient(135deg, #0f172a 0%, #020617 100%);
    }

    .donation-option {
      transition: all 0.3s ease;
      border: 2px solid #e5e7eb;
      cursor: pointer;
    }

    .dark .donation-option {
      border-color: #374151;
    }

    .donation-option.selected {
      border-color: #3b82f6;
      background-color: #eff6ff;
    }

    .dark .donation-option.selected {
      background-color: #1e3a8a;
      border-color: #60a5fa;
    }

    .form-input {
      transition: all 0.3s ease;
    }

    .form-input:focus {
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .dark .form-input {
      background-color: #374151;
      border-color: #4b5563;
      color: #f9fafb;
    }

    .payment-method {
      border: 2px solid #e5e7eb;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .dark .payment-method {
      border-color: #374151;
    }

    .payment-method.selected {
      border-color: #3b82f6;
      background-color: #eff6ff;
    }

    .dark .payment-method.selected {
      background-color: #1e3a8a;
      border-color: #60a5fa;
    }
  </style>

  <!-- Hero Section -->
  <section class="donation-gradient text-white py-20">
    <div class="container mx-auto px-4">
      <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Support Our Mission</h1>
        <p class="text-xl text-blue-100 mb-8">Your donation helps provide quality education to underprivileged children in
          Cambodia.</p>
      </div>
    </div>
  </section>

  <!-- Donation Form Section -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Donation Form -->
          <div class="lg:col-span-2">
            <div class="bg-white rounded-xl p-8 border border-slate-300 shadow-lg"
              data-aos="fade-right">
              <h2 class="text-3xl font-bold mb-6 text-gray-800">Make a Donation</h2>

              <!-- Giving Options -->
              <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Giving Options</h3>
                <div class="grid grid-cols-2 gap-4 mb-4">
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="donation_type" value="one-time" class="hidden" checked>
                    <div class="font-medium text-gray-800">One-time payment</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="donation_type" value="recurring" class="hidden">
                    <div class="font-medium text-gray-800">Recurring payment</div>
                  </label>
                </div>
                <p class="text-sm text-gray-600">Minimum donation: $5</p>
              </div>

              <!-- Donation Amount -->
              <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Donation Amount</h3>
                <div class="grid grid-cols-3 gap-3 mb-4">
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="25" class="hidden">
                    <div class="text-lg font-bold text-gray-800">$25</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="50" class="hidden">
                    <div class="text-lg font-bold text-gray-800">$50</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="100" class="hidden">
                    <div class="text-lg font-bold text-gray-800">$100</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="250" class="hidden">
                    <div class="text-lg font-bold text-gray-800">$250</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="500" class="hidden">
                    <div class="text-lg font-bold text-gray-800">$500</div>
                  </label>
                  <label class="donation-option rounded-lg p-4 text-center">
                    <input type="radio" name="amount" value="other" class="hidden">
                    <div class="text-lg font-bold text-gray-800">Other</div>
                  </label>
                </div>

                <!-- Custom Amount Input -->
                <div id="custom-amount" class="hidden">
                  <label class="block text-sm font-medium text-gray-700 mb-2">Enter Amount ($)</label>
                  <input type="number" min="5" step="0.01"
                    class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                    placeholder="Enter custom amount">
                </div>
              </div>

              <!-- Honor Donation -->
              <div class="mb-8">
                <label class="flex items-center space-x-3 cursor-pointer">
                  <input type="checkbox" name="honor_donation" class="w-4 h-4 text-blue-600 rounded">
                  <span class="text-gray-700">Give in honor of someone</span>
                </label>
              </div>

              <!-- Billing Information -->
              <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Billing Information</h3>

                <label class="flex items-center space-x-3 cursor-pointer mb-6">
                  <input type="checkbox" name="organization_donation" class="w-4 h-4 text-blue-600 rounded">
                  <span class="text-gray-700">Organization donation</span>
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                    <select class="form-input w-full px-4 py-3 rounded-lg border border-gray-300">
                      <option value="Cambodia" selected>Cambodia</option>
                      <option value="United States">United States</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                    <input type="text" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="First Name">
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                    <input type="text" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="Last Name">
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="Email Address">
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel"
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="Phone Number">
                  </div>

                  <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                    <input type="text" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="Address 1">
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                    <input type="text" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="City">
                  </div>

                  <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                    <input type="text" required
                      class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                      placeholder="Postal Code">
                  </div>
                </div>
              </div>

              <!-- Payment Details -->
              <div class="mb-8">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Payment Details</h3>

                <div class="grid grid-cols-2 gap-4 mb-6">
                  <label class="payment-method rounded-lg p-4 text-center">
                    <input type="radio" name="payment_method" value="credit-card" class="hidden" checked>
                    <i class="fas fa-credit-card text-2xl mb-2 text-gray-600"></i>
                    <div class="font-medium text-gray-800">Credit Card</div>
                  </label>
                  <label class="payment-method rounded-lg p-4 text-center">
                    <input type="radio" name="payment_method" value="paypal" class="hidden">
                    <i class="fab fa-paypal text-2xl mb-2 text-gray-600"></i>
                    <div class="font-medium text-gray-800">PayPal</div>
                  </label>
                </div>

                <div id="credit-card-details">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                      <label class="block text-sm font-medium text-gray-700 mb-2">Card Number
                        *</label>
                      <input type="text" required
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                        placeholder="1234 5678 9012 3456">
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">CVV *</label>
                      <input type="text" required
                        class="form-input w-full px-4 py-3 rounded-lg border border-gray-300"
                        placeholder="123">
                    </div>

                    <div>
                      <label class="block text-sm font-medium text-gray-700 mb-2">Expiration *</label>
                      <div class="flex space-x-2">
                        <select
                          class="form-input flex-1 px-4 py-3 rounded-lg border border-gray-300">
                          <option value="01">01</option>
                          <option value="02">02</option>
                          <option value="03">03</option>
                          <option value="04">04</option>
                          <option value="05">05</option>
                          <option value="06">06</option>
                          <option value="07">07</option>
                          <option value="08">08</option>
                          <option value="09">09</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
                        </select>
                        <select
                          class="form-input flex-1 px-4 py-3 rounded-lg border border-gray-300">
                          <option value="2024">2024</option>
                          <option value="2025">2025</option>
                          <option value="2026">2026</option>
                          <option value="2027">2027</option>
                          <option value="2028">2028</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Additional Options -->
              <div class="space-y-4 mb-8">
                <label class="flex items-center space-x-3 cursor-pointer">
                  <input type="checkbox" name="cover_fees" class="w-4 h-4 text-blue-600 rounded">
                  <span class="text-gray-700">Add 1% to cover transaction fees</span>
                </label>

                <label class="flex items-center space-x-3 cursor-pointer">
                  <input type="checkbox" name="receive_emails" class="w-4 h-4 text-blue-600 rounded" checked>
                  <span class="text-gray-700">Receive emails from us</span>
                </label>
              </div>

              <!-- Donation Summary -->
              <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h4 class="text-lg font-semibold mb-4 text-gray-800">Your Donation</h4>
                <div class="flex justify-between items-center">
                  <span class="text-gray-600">Amount:</span>
                  <span class="text-2xl font-bold text-blue-600 donation-summary">$0.00</span>
                </div>
              </div>

              <!-- Submit Button -->
              <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 donate-btn">
                Donate Now
              </button>
            </div>
          </div>

          <!-- Contact Information -->
          <div class="lg:col-span-1">
            <div
              class="bg-white rounded-xl p-6 border border-slate-300 shadow-lg"
              data-aos="fade-left">
              <h3 class="text-2xl font-bold mb-6 text-gray-800">Get In Touch</h3>
              <div class="space-y-4">
                <div class="flex gap-3 items-start">
                  <div class="p-2 rounded-md border border-gray-200">
                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-gray-800">Address</h4>
                    <p class="text-gray-600">Wat Damnak, Siem Reap, Cambodia</p>
                  </div>
                </div>

                <div class="flex gap-3 items-start">
                  <div class="p-2 rounded-md border border-gray-200">
                    <i class="fas fa-phone text-blue-600"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-gray-800">Phone</h4>
                    <p class="text-gray-600">
                      <a href="tel:+85512345678" class="hover:text-blue-600">+855 12 345
                        678</a>
                    </p>
                  </div>
                </div>
                <div class="flex gap-3 items-start">
                  <div class="p-2 rounded-md border border-gray-200">
                    <i class="fas fa-envelope text-blue-600"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-gray-800">Email</h4>
                    <p class="text-gray-600">
                      <a href="mailto:info@watdamnak.edu.kh"
                        class="hover:text-blue-600">info@watdamnak.edu.kh</a>
                    </p>
                  </div>
                </div>
                <div class="flex gap-3 items-start">
                  <div class="p-2 rounded-md border border-gray-200">
                    <i class="fas fa-clock text-blue-600"></i>
                  </div>
                  <div>
                    <h4 class="font-bold text-gray-800">Office Hours</h4>
                    <p class="text-gray-600">Mon-Fri: 7:30 AM - 4:30 PM</p>
                    <p class="text-gray-600">Sat: 8:00 AM - 12:00 PM</p>
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
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function() {
      // Initialize selected states
      $('input[name="amount"][value="25"]').prop('checked', true).closest('.donation-option').addClass('selected');
      $('input[name="payment_method"][value="credit-card"]').prop('checked', true).closest('.payment-method')
        .addClass('selected');
      updateDonationSummary('25.00');

      // Donation amount selection
      $('input[name="amount"]').change(function() {
        $('.donation-option').removeClass('selected');
        $(this).closest('.donation-option').addClass('selected');

        if ($(this).val() === 'other') {
          $('#custom-amount').removeClass('hidden');
          updateDonationSummary('0.00');
        } else {
          $('#custom-amount').addClass('hidden');
          updateDonationSummary($(this).val());
        }
      });

      // Custom amount input
      $('#custom-amount input').on('input', function() {
        const amount = parseFloat($(this).val()) || 0;
        if (amount >= 5) {
          updateDonationSummary(amount.toFixed(2));
        } else {
          updateDonationSummary('0.00');
        }
      });

      // Payment method selection
      $('input[name="payment_method"]').change(function() {
        $('.payment-method').removeClass('selected');
        $(this).closest('.payment-method').addClass('selected');
      });

      // Form submission
      $('.donate-btn').click(function(e) {
        e.preventDefault();

        // Basic validation
        let isValid = true;
        $('input[required]').each(function() {
          if (!$(this).val()) {
            isValid = false;
            $(this).addClass('border-red-500');
          } else {
            $(this).removeClass('border-red-500');
          }
        });

        if (isValid) {
          const amount = $('.donation-summary').text();
          alert('Thank you for your donation of ' + amount + '! This is a demo form.');
        } else {
          alert('Please fill in all required fields.');
        }
      });

      // Remove error state on input
      $('input').on('input', function() {
        $(this).removeClass('border-red-500');
      });

      function updateDonationSummary(amount) {
        $('.donation-summary')
          .text('$' + amount)
          .removeClass('text-blue-600')
          .addClass('text-green-600');

        setTimeout(function() {
          $('.donation-summary')
            .removeClass('text-green-600')
            .addClass('text-blue-600');
        }, 1000);
      }
    });
  </script>
@endpush
