<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Orders Section -->
    <div class="container mx-auto px-4 sm:px-6 py-6">
        <h2 class="text-xl sm:text-2xl font-bold mb-4">My Orders</h2>
        <!-- Orders Grid (2 Orders in a Row) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Order 1 -->
            <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-700 font-semibold">Order ID #7812657</span>
                        <p class="text-gray-500 text-sm">Malang, Indonesia → Emir’s House</p>
                    </div>
                    <span class="px-3 py-1 bg-green-500 text-white text-sm rounded-full">On Deliver</span>
                </div>

                <!-- Scrollable Products Container -->
                <div class="mt-4 max-h-60 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Air Max SYSTM</p>
                            <p class="text-gray-500 text-sm">Rp 1,459,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Air Rift</p>
                            <p class="text-gray-500 text-sm">Rp 1,909,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Gamma Force</p>
                            <p class="text-gray-500 text-sm">Rp 1,399,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Cortez</p>
                            <p class="text-gray-500 text-sm">Rp 1,299,000 x1</p>
                        </div>
                    </div>
                </div>
                

                <hr class="my-4">
                <div class="flex justify-between">
                    <p class="text-gray-700 font-semibold">Total: Rp 7,890,000 (4 items)</p>
                    <button class="px-4 py-2 bg-black text-white rounded-lg">Details</button>
                </div>
            </div>
            <!-- Order 2 (Example) -->
            <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-700 font-semibold">Order ID #7812657</span>
                        <p class="text-gray-500 text-sm">Malang, Indonesia → Emir’s House</p>
                    </div>
                    <span class="px-3 py-1 bg-green-500 text-white text-sm rounded-full">On Deliver</span>
                </div>

                <!-- Scrollable Products Container -->
                <div class="mt-4 max-h-60 overflow-y-auto grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Air Max SYSTM</p>
                            <p class="text-gray-500 text-sm">Rp 1,459,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Air Rift</p>
                            <p class="text-gray-500 text-sm">Rp 1,909,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Gamma Force</p>
                            <p class="text-gray-500 text-sm">Rp 1,399,000 x1</p>
                        </div>
                    </div>
                    <div class="flex items-center bg-gray-100 p-3 rounded-lg">
                        <img src="https://via.placeholder.com/80" class="w-16 h-16 rounded-md border mr-4">
                        <div>
                            <p class="text-gray-700 font-semibold">Nike Cortez</p>
                            <p class="text-gray-500 text-sm">Rp 1,299,000 x1</p>
                        </div>
                    </div>
                </div>
                

                <hr class="my-4">
                <div class="flex justify-between">
                    <p class="text-gray-700 font-semibold">Total: Rp 7,890,000 (4 items)</p>
                    <button class="px-4 py-2 bg-black text-white rounded-lg">Details</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
