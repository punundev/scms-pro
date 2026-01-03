// Modal Management
window.ShowTaskMessage = function (type = 'error', message) {
    const TasksmsContainer = document.createElement('div');
    TasksmsContainer.className = `fixed top-5 right-4 z-50 animate-fade-in-out`;
    TasksmsContainer.innerHTML = `
    <div class="flex items-start gap-3 ${type === 'success' ? 'bg-green-200/80 dark:bg-green-900/60 border-green-400 dark:border-green-600 text-green-700 dark:text-green-300' : 'bg-red-200/80 dark:bg-red-900/60 border-red-400 dark:border-red-600 text-red-700 dark:text-red-300'}
        border backdrop-blur-sm px-4 py-3 rounded-lg shadow-lg">
        <svg class="w-6 h-6 flex-shrink-0 ${type === 'success' ? 'text-green-500 dark:text-green-400' : 'text-red-500 dark:text-red-400'} mt-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="${type === 'success' ? 'M5 13l4 4L19 7' : 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'}" />
        </svg>
        <div class="flex-1 text-sm sm:text-base">${message}</div>
        <button onclick="this.parentElement.parentElement.remove()" class="text-gray-600 rounded-full dark:text-gray-400 hover:bg-gray-100/30 dark:hover:bg-gray-50/10 focus:outline-none">
            <svg class="w-5 h-5 rounded-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>`;
    document.body.appendChild(TasksmsContainer);
    setTimeout(() => TasksmsContainer.remove(), 3000);
};

window.showModal = function (modalId) {
    const backdrop = document.getElementById('modalBackdrop');
    backdrop.classList.remove('hidden');
    const modal = document.getElementById(modalId);
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.querySelector('div').classList.remove('opacity-0', 'scale-95');
        modal.querySelector('div').classList.add('opacity-100', 'scale-100');
    }, 10);
    document.body.style.overflow = 'hidden';
};

window.closeModal = function (modalId) {
    const backdrop = document.getElementById('modalBackdrop');
    const modal = document.getElementById(modalId);
    modal.querySelector('div').classList.remove('opacity-100', 'scale-100');
    modal.querySelector('div').classList.add('opacity-0', 'scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
        backdrop.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 300);
};


// Modal close buttons
$('[id^="close"], [id^="cancel"]').on('click', function () {
    const modalId = $(this).closest('[id^="Modal"]').attr('id') ||
        $(this).closest('[id$="Modal"]').attr('id');
    if (modalId) closeModal(modalId);
});

// Close modals with Escape key
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
        $('[id^="Modal"]').each(function () {
            if (!$(this).hasClass('hidden')) {
                closeModal(this.id);
            }
        });
    }
});
