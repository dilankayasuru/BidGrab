<div class="navbar auth">
    <div class="logo">
        <a href="/bidgrab/public/">BidGarb</a>
    </div>
</div>
<div class="hero">
    <div class="text">
        <p class="hero-title">BidGrab</p>
        <p class="hero-text-sm pb-8">Bid, Win, and Save Big on Unique Items!</p>
    </div>
</div>
<main class="grid place-items-center pb-16">
    <div class="w-full max-w-sm">
        <form class="px-8 pt-6 pb-8 mb-4" method="POST">
            <div class="mb-4 flex justify-between gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="first-name">
                        First Name
                    </label>
                    <input class="appearance-none rounded-md border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first-name" type="text" placeholder="John" name="firstName" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-2" for="last-name">
                        Last Name
                    </label>
                    <input class="appearance-none rounded-md border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last-name" type="text" placeholder="Doe" name="lastName" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2" for="email">
                    Email Address
                </label>
                <input class="appearance-none rounded-md border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="john@example.com" name="email" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2" for="password">
                    Password
                </label>
                <input class="appearance-none rounded-md border-blue-500 border w-full py-3 px-5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********" name="password" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2" for="password">
                    Confirm Password
                </label>
                <input class="appearance-none rounded-md border-blue-500 border w-full py-3 px-5 text-gray-700 mb-2 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="********" name="confirmPassword" required>
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue text-white py-2 w-full rounded focus:outline-none focus:shadow-outline transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 hover:bg-blue-800 active:shadow-md active:translate-y-0" type="submit">
                    Sign Up
                </button>
            </div>
        </form>
    </div>

    <a class="inline-block align-baseline font-bold text-sm" href="login">
        <span class="text-gray">Already have an account? </span>Sign In
    </a>
    <p class="text-red">
        <?= $error ?? '' ?>
    </p>
</main>
