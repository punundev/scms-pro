<x-modal.modal id="Modaldelete" title="Confirm {{$title}} deletion" fill="currentColor" class="rounded-xl w-full max-w-md"
    svgPath="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z">
    <div class="p-6">
        <p class="text-gray-700 dark:text-gray-300">Are you sure you want to delete this {{ $title }}? This
            action
            cannot be undone.</p>
    </div>
    <!-- Footer -->
    <x-modal.footer-actions :delete="true" />
</x-modal.modal>
