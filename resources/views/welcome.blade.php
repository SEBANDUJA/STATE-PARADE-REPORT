<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
  </head>
  <body>
    <section class="flex flex-col justify-start items-center gap-y-3 pt-5 h-screen bg-gradient-to-r from-orange-600 via-yellow-600 to-orange-600">
        <!-- logo -->
        <div class="w-20 md:w-44">
            <img src="../images/Fire logo.png" alt="Zimamoto Logo" class="w-full" />
        </div>

        <!-- heading -->
        <h1 class="text-xl md:text-5xl text-white font-semibold uppercase">sprs management system</h1>
        <h3 class="text-md md:text-3xl mt-1 font-semibold uppercase">state parade report</h3>

        <!-- form -->
        <form class="mt-2 flex flex-col justify-start items-center w-full gap-y-2 px-4 md:px-0" action="{{ route('login') }}" method="POST">
              @csrf

              @if ($errors->any())
              <div class="w-full md:w-1/3 text-red-700 bg-red-100 border border-red-400 rounded p-2 mb-2">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex flex-col justify-center items-start w-full md:w-1/3">
                <span class="text-sm md:text-md font-normal md:font-semibold">Email</span>
                <input type="email" name="email" placeholder="Enter Email" value="{{ old('email') }}" class="h-10 px-3 w-full outline-none bg-white rounded-lg" />
            </div>
            <div class="flex flex-col justify-center items-start w-full md:w-1/3 relative">
                <label for="password" class="text-sm md:text-md font-normal md:font-semibold mb-1">Password</label>

                <input
                    id="password"
                    type="password" 
                    name="password"
                    placeholder="Enter Password"
                    class="h-10 px-3 pr-10 w-full outline-none bg-white rounded-lg border border-gray-300"
                />

            </div>
            <div class="flex w-full md:w-1/3 mt-2">
                <button class="flex justify-center items-center btn h-10 text-center outline-none w-full rounded-lg bg-white hover:bg-orange-400 hover:border-2 hover:border-white cursor-pointer font-semibold">
                    Login
                </button>
            </div>

            <p class="py-2 text-sm">Forget Password? <a href="#" class="text-blue-600">Click here</a></p>

            <div class="fixed bottom-0 text-justify px-10 md:px-0">
                <span class="text-xs md:text-md">&copy; 2025 Jeshi la zimamoto na uokoaji Tanzania Bara, Haki zote zimehifadhiwa</span>
            <div>
        </form>
    </section>
  </body>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.setAttribute('class', 'bi bi-eye-slash-fill w-5 h-5'); // change icon
            } else {
                passwordInput.type = 'password';
                eyeIcon.setAttribute('class', 'w-5 h-5');
            }
        }
    </script>
</html>