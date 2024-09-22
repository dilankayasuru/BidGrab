<div class="absolute backdrop-blur-sm w-dvw h-dvh z-10 top-0 left-0 flex justify-center items-center hidden" id="depositForm">
    <div class="w-fit bg-white rounded-xl p-4 min-w-96 border-blue-500 border shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-medium text-2xl">Deposit Money</h1>
            <i class="fa-solid fa-xmark text-2xl cursor-pointer" id="depositFormClose" onclick="closeDepositForm()"></i>
        </div>
        <form action="<?=BASE_URL?>deposit" method="POST" id="depositFormData">
            <div class="grid place-items-center">
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="amount">
                        Amount
                    </label>
                    <input
                            id="amount"
                            type="number"
                            placeholder="Enter aomunt to deposit"
                            name="amount"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="card">
                        Card Number
                    </label>
                    <input
                            id="card"
                            type="text"
                            placeholder="0000-0000-0000-0000"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6 w-full">
                    <label class="block text-gray-700 font-medium mb-2" for="cardname">
                        Card Holder Name
                    </label>
                    <input
                            id="cardname"
                            type="text"
                            placeholder="Enter name on card"
                            class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6 w-full flex gap-2">
                    <div class="w-28">
                        <label class="block text-gray-700 font-medium mb-2" for="cvv">
                            CVV
                        </label>
                        <input
                                id="cvv"
                                placeholder="CVV"
                                type="number"
                                class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="w-28">
                        <label class="block text-gray-700 font-medium mb-2" for="month">
                            Expire Month
                        </label>
                        <input
                                id="month"
                                type="number"
                                placeholder="Month"
                                class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="w-28">
                        <label class="block text-gray-700 font-medium mb-2" for="year">
                            Year
                        </label>
                        <input
                                id="year"
                                type="number"
                                placeholder="Year"
                                class="appearance-none rounded-full border-blue-500 border w-full py-3 px-5 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>
                <div class="mb-4 w-full">
                    <button
                            type="submit"
                            class="mb-2 w-full px-4 py-2 rounded border-blue text-white border bg-blue shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                        Deposit
                    </button>
                    <button
                            type="reset"
                            class="w-full block px-4 py-2 rounded border-blue text-blue border bg-fadeWhite shadow-md hover:-translate-y-0.5 hover:shadow-lg active:translate-y-0 active:shadow-md transition-all duration-300">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function closeDepositForm() {
        const form = document.getElementById("depositForm");
        form.classList.add('hidden');
        document.getElementById("depositFormData").reset();
    }
</script>