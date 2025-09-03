<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AthletiX - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-[#ffffffde]">
    <main class="grid justify-items-center items-center min-h-screen">
      <div class="bg-white w-[1280px] h-[720px] shadow-lg rounded-lg">
        <!-- Login Section -->
        <section
          class="relative w-[687px] h-[382px] top-[169px] left-[301px] border border-[#8c2c08] rounded-xl shadow-md bg-[#fffbfa] flex overflow-hidden"
        >
          <!-- Left Side -->
          <div
            class="w-[371px] h-full rounded-l-xl overflow-hidden bg-cover bg-no-repeat bg-center relative"
            style="background-image: url('/images/logoBackground.png');"
          >
            <img
              src="https://c.animaapp.com/mevbdbzo2I14VB/img/logo.png"
              alt="AthletiX logo"
              class="absolute w-[159px] h-[156px] top-5 left-[83px]"
            />
            <h1
              class="absolute w-64 top-[259px] left-[38px] text-2xl text-black font-serif drop-shadow"
            >
              Welcome to AthletiX!
            </h1>
          </div>

          <!-- Forms Container -->
          <div class="relative w-[316px] h-full overflow-hidden">
            <div
              id="formsWrapper"
              class="flex w-[632px] h-full transition-transform duration-500"
            >
              <!-- Login Form -->
              <div
                class="w-[316px] p-8 flex flex-col justify-center shrink-0"
              >
                <h2
                  class="text-xl font-semibold text-[#8c2c08] mb-8 text-center"
                >
                  Log-In
                </h2>
                
                  <form id="login-form" method="POST" action="{{ route('login') }}" class="flex flex-col gap-6">
                      @csrf
                      <!-- Username -->
                      <div class="flex flex-col mb-4">
                          <div class="flex items-center border border-[#8c2c08] rounded px-2">
                              <input
                                  type="email"
                                  name="username"
                                  id="username"
                                  placeholder="Email"
                                  required
                                  class="flex-1 px-2 py-2 text-sm text-[#8c2c08] bg-transparent outline-none"
                              />
                          </div>
                          <div id="username-error" class="text-red-500 text-sm mt-2"></div>
                      </div>

                      <!-- Password -->
                      <div class="flex flex-col mb-4">
                          <div class="flex items-center border border-[#8c2c08] rounded px-2">
                              <input
                                  type="password"
                                  name="password"
                                  id="password"
                                  placeholder="Password"
                                  required
                                  class="flex-1 px-2 py-2 text-sm text-[#8c2c08] bg-transparent outline-none"
                              />
                          </div>
                          <div id="password-error" class="text-red-500 text-sm mt-2"></div>
                      </div>

                      <!-- Submit -->
                      <button
                          type="submit"
                          class="bg-[#8c2c08] text-white py-2 rounded-full border border-[#8c2c08] hover:bg-[#7a2507] transition duration-200"
                      >
                          Log-In
                      </button>

                      <p class="text-sm text-center text-gray-600 mt-2">
                          Don’t have an account?
                          <a href="#" id="showSignup" class="text-[#8c2c08] font-semibold hover:underline">Click here</a>
                      </p>
                  </form>

              </div>

              <!-- Sign Up Form -->
              <div
                class="w-[316px] p-8 flex flex-col justify-center shrink-0"
              >
                <h2
                  class="text-xl font-semibold text-[#8c2c08] mb-8 text-center"
                >
                  Sign-Up
                </h2>
                <form id="signup-form" method="POST" action="{{ route('register') }}" class="flex flex-col gap-6">
                  @csrf
                  <!-- Email -->
                  <div class="flex items-center border border-[#8c2c08] rounded px-2">
                    <input
                      type="email"
                      name="username"
                      placeholder="Email"
                      required
                      class="flex-1 px-2 py-2 text-sm text-[#8c2c08] bg-transparent outline-none"
                    />
                  </div>

                  <!-- Password -->
                  <div class="flex items-center border border-[#8c2c08] rounded px-2">
                    <input
                      type="password"
                      name="password"
                      placeholder="Password"
                      required
                      class="flex-1 px-2 py-2 text-sm text-[#8c2c08] bg-transparent outline-none"
                    />
                  </div>

                  <!-- Confirm Password -->
                  <div class="flex items-center border border-[#8c2c08] rounded px-2">
                    <input
                      type="password"
                      name="password_confirmation"
                      placeholder="Confirm Password"
                      required
                      class="flex-1 px-2 py-2 text-sm text-[#8c2c08] bg-transparent outline-none"
                    />
                  </div>

                  <!-- Submit -->
                  <button
                    type="submit"
                    class="bg-[#8c2c08] text-white py-2 rounded-full border border-[#8c2c08] hover:bg-[#7a2507] transition duration-200"
                  >
                    Sign-Up
                  </button>
                  <p class="text-sm text-center text-gray-600 mt-2">
                    Already have an account?
                    <a href="#" id="showLogin" class="text-[#8c2c08] font-semibold hover:underline">Log-In</a>
                  </p>
                </form>

              </div>
            </div>
          </div>
        </section>
      </div>
    </main>

    <script>
      const formsWrapper = document.getElementById("formsWrapper");
      const showSignup = document.getElementById("showSignup");
      const showLogin = document.getElementById("showLogin");

      showSignup.addEventListener("click", (e) => {
        e.preventDefault();
        formsWrapper.style.transform = "translateX(-316px)";
      });

      showLogin.addEventListener("click", (e) => {
        e.preventDefault();
        formsWrapper.style.transform = "translateX(0)";
      });
    </script>

    <script>
    document.getElementById('login-form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent normal form submission

        // Clear previous errors
        document.getElementById('username-error').innerText = '';
        document.getElementById('password-error').innerText = '';

        // Get form data
        let formData = new FormData(this);

        fetch("{{ route('login.attempt') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect on success
                window.location.href = data.redirect_url; // redirect to announcement page
            } else {
                // Display validation errors
                if (data.errors.username) {
                    document.getElementById('username-error').innerText = data.errors.username[0];
                }
                if (data.errors.password) {
                    document.getElementById('password-error').innerText = data.errors.password[0];
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>

<script>
document.getElementById('signup-form').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('register') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'  // 👈 this forces JSON instead of redirect
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // ✅ redirect straight to OTP page
            window.location.href = data.redirect_url;
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
</script>
  </body>
</html>
