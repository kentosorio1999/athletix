<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>AthletiX - Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'inknut': ['Inknut Antiqua', 'serif'],
          },
          colors: {
            'brown-primary': '#A0522D',
            'brown-dark': '#8B4513',
          }
        }
      }
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="flex">
    <!-- Sidebar -->
    <aside class="w-28 bg-brown-primary min-h-screen flex flex-col items-center py-4">
      <div class="mb-6">
        <img 
          src="https://c.animaapp.com/meod3nrskPlg16/img/logo.png" 
          alt="TUP Logo" 
          class="w-16 h-16 rounded-full bg-white p-2"
        />
      </div>
      
      <nav class="flex flex-col space-y-4">
        <!-- Dashboard Icon - Active -->
        <button class="p-3 text-white bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
          </svg>
        </button>
        
        <!-- Users Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4h3v4h2v-7.5c0-.83.67-1.5 1.5-1.5S12 9.67 12 10.5V18h2v-4h3v4h2V10.5c0-2.49-2.01-4.5-4.5-4.5S10 8.01 10 10.5V18H4z"/>
          </svg>
        </button>
        
        <!-- Performance Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z"/>
          </svg>
        </button>
        
        <!-- Events Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
          </svg>
        </button>
        
        <!-- Attendance Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </button>
        
        <!-- Reports Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
          </svg>
        </button>
        
        <!-- Messages Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h4v3c0 .6.4 1 1 1h.5c.2 0 .5-.1.7-.3L14.6 18H20c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
          </svg>
        </button>
        
        <!-- Schedule Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 11H7v6h2v-6zm4 0h-2v6h2v-6zm4 0h-2v6h2v-6zM4 19V7h16v12H4z"/>
          </svg>
        </button>
        
        <!-- Notifications Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 22c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2zm6-6v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.67-1.5-1.5-1.5s-1.5.67-1.5 1.5v.68C7.63 5.36 6 7.92 6 11v5l-2 2v1h16v-1l-2-2z"/>
          </svg>
        </button>
        
        <!-- Settings Icon -->
        <button class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
          </svg>
        </button>
        
        <!-- Logout Icon -->
        <button onclick="window.location.href='login.html'" class="p-3 text-white hover:bg-brown-dark rounded-lg transition-colors">
          <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M9 5v2h6.59L4 18.59 5.41 20 17 8.41V15h2V5z"/>
          </svg>
        </button>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Header -->
      <header class="flex justify-between items-center mb-8">
        <h1 class="text-4xl font-bold text-brown-primary font-inknut">
          Dashboard
        </h1>
        <a href="index.html" class="text-brown-primary hover:underline">
          ← Back to Control Panel
        </a>
      </header>

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
    </main>
  </div>

  <script>
    // Donut Chart
    const donutCtx = document.getElementById('donutChart').getContext('2d');
    const donutChart = new Chart(donutCtx, {
      type: 'doughnut',
      data: {
        labels: ['Athletes', 'Performance', 'Events', 'Attendance'],
        datasets: [{
          data: [40, 25, 25, 10],
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
          data: [35, 50, 45, 20],
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
</body>
</html>
