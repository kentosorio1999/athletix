@extends('layouts.app')

@section('title', 'Control Panel')

@section('content')
      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Donut Chart -->
        <div class="bg-white rounded-lg shadow-lg p-6">
          <div class="flex items-center justify-between mb-6">
            <div class="w-80 h-80">
              <canvas id="donutChart"></canvas>
            </div>
            <div class="ml-8 space-y-4">
              <div class="flex items-center">
                <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                <span class="text-gray-700">Athletes</span>
              </div>
              <div class="flex items-center">
                <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
                <span class="text-gray-700">Performance</span>
              </div>
              <div class="flex items-center">
                <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
                <span class="text-gray-700">Events</span>
              </div>
              <div class="flex items-center">
                <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
                <span class="text-gray-700">Attendance</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Bar Chart -->
        <div class="bg-white rounded-lg shadow-lg p-6">
          <div class="h-80">
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Metric Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Notification Card -->
        <div class="bg-green-500 rounded-lg p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-center mb-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
              </svg>
            </div>
          </div>
          <h3 class="text-xl font-bold text-center mb-2">NOTIFICATION</h3>
          <p class="text-3xl font-bold text-center">225</p>
        </div>

        <!-- Performance Card -->
        <div class="bg-yellow-500 rounded-lg p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-center mb-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
              </svg>
            </div>
          </div>
          <h3 class="text-xl font-bold text-center mb-2">PERFORMANCE</h3>
          <p class="text-3xl font-bold text-center">90</p>
        </div>

        <!-- Events Card -->
        <div class="bg-blue-500 rounded-lg p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-center mb-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
              </svg>
            </div>
          </div>
          <h3 class="text-xl font-bold text-center mb-2">EVENTS</h3>
          <p class="text-3xl font-bold text-center">90</p>
        </div>

        <!-- Attendance Card -->
        <div class="bg-red-500 rounded-lg p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
          <div class="flex items-center justify-center mb-4">
            <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
              <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
          </div>
          <h3 class="text-xl font-bold text-center mb-2">ATTENDANCE</h3>
          <p class="text-3xl font-bold text-center">10</p>
        </div>
      </div>


        <script>
    // Donut Chart
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    const donutChart = new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Athletes', 'Performance', 'Events', 'Attendance'],
        datasets: [{
          data: [
              {{ $donutData['athletes'] }},
              {{ $donutData['performance'] }},
              {{ $donutData['events'] }},
              {{ $donutData['attendance'] }}
          ],
          backgroundColor: [
            '#10B981', // Green
            '#F59E0B', // Yellow
            '#3B82F6', // Blue
            '#EF4444'  // Red
          ],
          borderWidth: 0,
          cutout: '60%'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          }
        }
      }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    const barChart = new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: ['Athletes', 'Performance', 'Events', 'Attendance'],
        datasets: [{
          data: [
              {{ $donutData['athletes'] }},
              {{ $donutData['performance'] }},
              {{ $donutData['events'] }},
              {{ $donutData['attendance'] }}
          ],
          backgroundColor: [
            '#10B981', // Green
            '#F59E0B', // Yellow
            '#3B82F6', // Blue
            '#EF4444'  // Red
          ],
          borderRadius: 8,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 60,
            ticks: {
              callback: function(value) {
                return value + '%';
              }
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });

    // Add click handlers for metric cards
    document.querySelectorAll('.bg-green-500, .bg-yellow-500, .bg-blue-500, .bg-red-500').forEach(card => {
      card.addEventListener('click', function() {
        const title = this.querySelector('h3').textContent;
        showNotification(`${title} section clicked!`);
      });
    });

    function showNotification(message) {
      const notification = document.createElement('div');
      notification.className = 'fixed top-4 right-4 bg-brown-primary text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
      notification.textContent = message;
      
      document.body.appendChild(notification);
      
      setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => notification.remove(), 300);
      }, 3000);
    }
  </script>
@endsection
