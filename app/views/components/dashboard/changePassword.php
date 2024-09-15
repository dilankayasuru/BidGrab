<div class="absolute backdrop-blur-sm w-dvw h-dvh z-10 top-0 left-0 flex justify-center items-center hidden" id="changePasswordForm">
    <div class="w-fit bg-white rounded-xl p-4 min-w-96 border-blue-500 border shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-medium text-2xl">Change Password</h1>
            <i class="fa-solid fa-xmark text-2xl cursor-pointer" id="changePasswordClose"></i>
        </div>
        <form action="reset-password" method="POST">
            <div class="grid place-items-center">
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="currentPassword">
                        Current Password
                    </label>
                    <input
                            id="currentPassword"
                            type="password"
                            placeholder="********"
                            name="currentPassword"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="newPassword">
                        New Password
                    </label>
                    <input
                            id="newPassword"
                            type="password"
                            placeholder="********"
                            name="newPassword"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="confirmPassword">
                        Confirm New Password
                    </label>
                    <input
                            id="confirmPassword"
                            type="password"
                            placeholder="********"
                            name="confirmPassword"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 w-full">
                    <button
                            type="submit"
                            class="mb-2 w-full px-4 py-2 rounded border-blue text-white border bg-blue shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                        Save Password
                    </button>
                    <button
                            id="passwordCloseBtn"
                            type="reset"
                            class="w-full block px-4 py-2 rounded border-blue text-blue border bg-fadeWhite shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>