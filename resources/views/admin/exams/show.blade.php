<x-modal.modal id="Modaldetail" title="Exam Details" class="rounded-xl w-full max-w-2xl"
    svgPath="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z">
    <!-- Content -->
    <div class="h-[65vh] md:h-auto p-4 overflow-y-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Exam Name -->
            <x-fields.input :detail="true" label="Exam Name" name="name" />
            <!-- Subject -->
            <x-fields.input :detail="true" label="Subject" name="subject" />
            <!-- Total Marks -->
            <x-fields.input :detail="true" label="Total Marks" name="total_marks" />
            <!-- Passing Marks -->
            <x-fields.input :detail="true" label="Passing Marks" name="passing_marks" />
            <!-- Exam Date -->
            <x-fields.input type="date" :detail="true" label="Exam Date" name="date" />
        </div>
        <!-- Description -->
        <x-fields.textarea :detail="true" label="Description" name="description" />
    </div>
    <!-- Footer -->
    <x-modal.footer-actions :detail="true" />
</x-modal.modal>
