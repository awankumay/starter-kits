<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Users') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('User Management Pages') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div class="relative">
            <button id="actionDropdownButton" onclick="toggleDropdown()"
                class="inline-flex items-center px-4 py-2 bg-zinc-800 dark:bg-zinc-700 text-white rounded-md">
                Action <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <div id="actionDropdown" class="hidden absolute z-10 mt-1 py-1 w-48 bg-zinc-700 rounded-md shadow-lg">
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Reward</a>
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Promote</a>
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Activate account</a>
                <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-zinc-600">Delete User</a>
            </div>
        </div>
        <div>
            <div class="relative">
                <input type="text" placeholder="Search for users"
                    class="pl-10 pr-4 py-2 w-80 bg-zinc-700/20 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg class="w-5 h-5 text-zinc-500 dark:text-zinc-400 absolute left-3 top-2.5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-zinc-800/40 rounded-lg">
        <table class="min-w-full">
            <thead class="bg-zinc-100 dark:bg-zinc-800 border-b border-zinc-200 dark:border-zinc-700">
                <tr>
                    <th class="px-4 py-3 w-12">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                        Nama</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                        Position</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                        Status</th>
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-zinc-700 dark:text-zinc-300 uppercase tracking-wider">
                        Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                    <td class="px-4 py-4">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://randomuser.me/api/portraits/men/1.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">John Williams</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">john@flowbite.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">john@flowbite.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-700 dark:text-zinc-300">React Developer
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">Online</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit user</a>
                    </td>
                </tr>
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                    <td class="px-4 py-4">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://randomuser.me/api/portraits/women/2.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">Bonnie Green</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">bonnie@flowbite.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">bonnie@flowbite.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-700 dark:text-zinc-300">Designer</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">Online</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit user</a>
                    </td>
                </tr>
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                    <td class="px-4 py-4">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://randomuser.me/api/portraits/men/3.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">Jese Leos</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">jese@flowbite.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">jese@flowbite.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-700 dark:text-zinc-300">Vue JS Developer
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">Online</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit user</a>
                    </td>
                </tr>
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                    <td class="px-4 py-4">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://randomuser.me/api/portraits/men/4.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">Thomas Lean</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">thomas@flowbite.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">thomas@flowbite.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-700 dark:text-zinc-300">UI/UX Engineer</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">Online</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit user</a>
                    </td>
                </tr>
                <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-700/50">
                    <td class="px-4 py-4">
                        <input type="checkbox"
                            class="rounded border-zinc-300 dark:border-zinc-600 text-blue-600 focus:ring-blue-500">
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img class="h-10 w-10 rounded-full object-cover"
                                    src="https://randomuser.me/api/portraits/women/5.jpg" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100">Leslie Livingston</div>
                                <div class="text-sm text-zinc-500 dark:text-zinc-400">leslie@flowbite.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-500 dark:text-zinc-400">leslie@flowbite.com
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-700 dark:text-zinc-300">SEO Specialist</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">Offline</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900">Edit user</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('actionDropdown');
            dropdown.classList.toggle('hidden');

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                const isClickInside = document.getElementById('actionDropdownButton').contains(event.target) ||
                    document.getElementById('actionDropdown').contains(event.target);

                if (!isClickInside && !dropdown.classList.contains('hidden')) {
                    dropdown.classList.add('hidden');
                }
            });
        }

    </script>
</div>
