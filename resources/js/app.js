// import './bootstrap';
import '../../vendor/masmerise/livewire-toaster/resources/js';

// User dropdown functionality
document.addEventListener('DOMContentLoaded', function () {
    // Action dropdown functionality
    const actionDropdownButton = document.getElementById('actionDropdownButton');
    const actionDropdown = document.getElementById('actionDropdown');

    if (actionDropdownButton && actionDropdown) {
        // Toggle dropdown when clicking the button
        actionDropdownButton.addEventListener('click', function (e) {
            e.stopPropagation();
            actionDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (actionDropdown && !actionDropdown.classList.contains('hidden')) {
                const isClickInside = actionDropdownButton.contains(event.target) ||
                    actionDropdown.contains(event.target);

                if (!isClickInside) {
                    actionDropdown.classList.add('hidden');
                }
            }
        });
    }

    // window.addEventListener('user-saved', event => {
    // });

    // window.addEventListener('user-updated', event => {
    // });
});
