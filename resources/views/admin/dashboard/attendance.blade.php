<!-- Attendance Chart -->
<div
  class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-5 border border-gray-200 dark:border-gray-700 shadow-sm">
  <div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('message.attendance_overview') }}</h3>

    <div class="flex bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
      <button data-range="daily" class="attendance-btn px-3 py-1 text-sm bg-indigo-600 text-white">
        {{ __('message.daily') }}
      </button>
      <button data-range="weekly"
        class="attendance-btn px-3 py-1 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600">
        {{ __('message.weekly') }}
      </button>
      <button data-range="monthly"
        class="attendance-btn px-3 py-1 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600">
        {{ __('message.monthly') }}
      </button>
    </div>
  </div>

  <div class="chart-container h-72">
    <canvas id="attendanceChart"></canvas>
  </div>
</div>

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      const ctx = document.getElementById('attendanceChart').getContext('2d');

      // -------------------------
      // 3 DATASETS (Attendance, Absence, Permission)
      // -------------------------
      const dataSets = {
        daily: {
          labels: ["Mon", "Tue", "Wed", "Thu", "Fri"],
          attendance: [45, 50, 48, 52, 47],
          absence: [5, 3, 2, 4, 6],
          permission: [2, 1, 3, 2, 1]
        },
        weekly: {
          labels: ["Week 1", "Week 2", "Week 3", "Week 4"],
          attendance: [220, 240, 230, 250],
          absence: [20, 18, 22, 15],
          permission: [8, 10, 12, 9]
        },
        monthly: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May"],
          attendance: [900, 860, 940, 980, 1020],
          absence: [80, 75, 90, 70, 65],
          permission: [35, 40, 33, 45, 41]
        }
      };

      // -------------------------
      // Dark/Light Color Detection
      // -------------------------
      function chartColors() {
        const isDark = document.documentElement.classList.contains('dark');
        return {
          text: isDark ? '#e5e7eb' : '#374151',
          grid: isDark ? '#4b5563' : '#e5e7eb',
        };
      }

      // -------------------------
      // Init Chart with 3 Lines
      // -------------------------
      let colors = chartColors();

      let chart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: dataSets.daily.labels,
          datasets: [{
              label: "Attendance",
              data: dataSets.daily.attendance,
              borderWidth: 2,
              borderColor: "#6366f1",
              backgroundColor: "rgba(99, 102, 241, 0.2)",
              tension: 0.4
            },
            {
              label: "Absence",
              data: dataSets.daily.absence,
              borderWidth: 2,
              borderColor: "#ef4444",
              backgroundColor: "rgba(239, 68, 68, 0.2)",
              tension: 0.4
            },
            {
              label: "Permission",
              data: dataSets.daily.permission,
              borderWidth: 2,
              borderColor: "#f59e0b",
              backgroundColor: "rgba(245, 158, 11, 0.2)",
              tension: 0.4
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: true,
              labels: {
                color: colors.text
              }
            }
          },
          scales: {
            x: {
              ticks: {
                color: colors.text
              },
              grid: {
                color: colors.grid
              }
            },
            y: {
              ticks: {
                color: colors.text
              },
              grid: {
                color: colors.grid
              }
            }
          }
        }
      });

      // -------------------------
      // Button Switch Event
      // -------------------------
      document.querySelectorAll('.attendance-btn').forEach(btn => {
        btn.addEventListener('click', () => {

          document.querySelectorAll('.attendance-btn')
            .forEach(b => b.classList.remove('bg-indigo-600', 'text-white'));

          btn.classList.add('bg-indigo-600', 'text-white');

          const range = btn.dataset.range;

          chart.data.labels = dataSets[range].labels;
          chart.data.datasets[0].data = dataSets[range].attendance;
          chart.data.datasets[1].data = dataSets[range].absence;
          chart.data.datasets[2].data = dataSets[range].permission;

          chart.update();
        });
      });

      // -------------------------
      // Detect Dark Mode Toggle
      // -------------------------
      const observer = new MutationObserver(() => {
        colors = chartColors();
        chart.options.plugins.legend.labels.color = colors.text;
        chart.options.scales.x.ticks.color = colors.text;
        chart.options.scales.y.ticks.color = colors.text;
        chart.options.scales.x.grid.color = colors.grid;
        chart.options.scales.y.grid.color = colors.grid;
        chart.update();
      });

      observer.observe(document.documentElement, {
        attributes: true
      });
    });
  </script>
@endpush
