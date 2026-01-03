<div class="absolute -bottom-12">
    <div
        class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 shadow-lg relative">
        <img id="{{ $edit ? "edit_$name" : $name }}" src="" alt=""
            class="w-full h-full object-cover rounded-full">
        <div id="edit_initials"
            class="rounded-full absolute inset-0 w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600 hidden">
            <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"></span>
        </div>
        <input type="file" id="{{ $edit ? "upload_$name" : "$name" }}" name="{{ $name }}" accept="image/jpeg,image/png,image/webp,image/gif" max="2048"
            class="hidden">
        <label for="{{ $edit ? "upload_$name" : "$name" }}"
            class="size-8 flex justify-center items-center absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full shadow cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
            <i class="ri-camera-line text-indigo-600 dark:text-indigo-300"></i>
        </label>
    </div>
</div>
<!-- Cropper Modal (same as create page but with edit-specific IDs) -->
<div id="editCropModal"
    class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-lg bg-opacity-50 hidden">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
        </div>
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="img-container">
                    <img id="ImageToCrop" class="max-w-full max-h-[60vh]" src="" alt="Image to crop">
                </div>
            </div>

            <div class="md:w-64 flex flex-col gap-3">
                <div
                    class="preview-container overflow-hidden w-[200px] h-[200px] rounded-full mx-auto border border-gray-200">
                </div>
                <div class="flex gap-2 mt-2 justify-center">
                    <button type="button" id="editRotateLeft"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                        </svg>
                    </button>
                    <button type="button" id="editRotateRight"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
                        </svg>
                    </button>
                    <button type="button" id="editFlipHorizontal"
                        class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </button>
                </div>

                <div class="flex gap-2 mt-auto pt-4">
                    <button type="button" id="applyEditCrop"
                        class="cursor-pointer px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 flex-1">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cropperjs1.5.12.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/cropperjs1.5.12.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Modal Photo Upload with Cropper.js
            const editPhotoInput = document.getElementById(`{{ $edit ? "upload_$name" : "$name" }}`);
            const editPhotoPreview = document.getElementById(`{{ $edit ? "edit_$name" : "$name" }}`);
            const editCropModal = document.getElementById('editCropModal');
            const ImageToCrop = document.getElementById('ImageToCrop');
            const applyEditCrop = document.getElementById('applyEditCrop');
            const editRotateLeft = document.getElementById('editRotateLeft');
            const editRotateRight = document.getElementById('editRotateRight');
            const editFlipHorizontal = document.getElementById('editFlipHorizontal');

            let editCropper;
            let editOriginalImageUrl;

            // Handle file selection for edit modal
            editPhotoInput.addEventListener('change', function(e) {

                if (this.files && this.files[0]) {
                    handleEditFile(this.files[0]);
                    this.value = '';
                }
            });

            // Handle file for edit modal
            function handleEditFile(file) {
                // Check if the file is an image
                if (!file.type.match('image.*')) {
                    ShowTaskMessage('error', 'Please select an image file (JPG, PNG)');
                    return;
                }
                // Check file size (2MB max)
                // if (file.size > 2 * 1024 * 1024) {
                //     ShowTaskMessage('error', 'File size exceeds 2MB limit');
                //     return;
                // }

                // Create a URL for the file
                editOriginalImageUrl = URL.createObjectURL(file);

                // Show crop modal
                ImageToCrop.src = editOriginalImageUrl;
                editCropModal.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');

                // Initialize cropper after image is loaded
                ImageToCrop.onload = function() {
                    if (editCropper) {
                        editCropper.destroy();
                    }

                    editCropper = new Cropper(ImageToCrop, {
                        aspectRatio: 1,
                        viewMode: 1,
                        autoCropArea: 0.8,
                        responsive: true,
                        preview: '.preview-container',
                        guides: true,
                        center: true,
                        highlight: true,
                        cropBoxMovable: true,
                        cropBoxResizable: true,
                        toggleDragModeOnDblclick: false,
                    });
                };
            }

            // Close edit crop modal and clean up
            function closeEditCrop() {
                if (editCropper) {
                    editCropper.destroy();
                    editCropper = null;
                }
                if (editOriginalImageUrl) {
                    URL.revokeObjectURL(editOriginalImageUrl);
                    editOriginalImageUrl = null;
                }
                editCropModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
                editPhotoInput.value = ''; // Reset the input
            }

            applyEditCrop.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (editCropper) {
                    const canvas = editCropper.getCroppedCanvas({
                        width: 300,
                        height: 300,
                        minWidth: 256,
                        minHeight: 256,
                        maxWidth: 4096,
                        maxHeight: 4096,
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    if (canvas) {
                        canvas.toBlob((blob) => {
                            // Update preview
                            editPhotoPreview.src = URL.createObjectURL(blob);

                            // Hide initials if shown
                            document.getElementById('edit_initials').classList.add('hidden');

                            // Create a new File object
                            const file = new File([blob], 'profile-photo.jpg', {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });

                            // Create a new FileList and DataTransfer
                            const dataTransfer = new DataTransfer();
                            dataTransfer.items.add(file);

                            // Update the file input
                            editPhotoInput.files = dataTransfer.files;

                            // Clean up
                            if (editOriginalImageUrl) {
                                URL.revokeObjectURL(editOriginalImageUrl);
                            }
                        }, 'image/jpeg', 0.9);
                    }
                }
                closeEditCrop();
            });

            editRotateLeft.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                editCropper && editCropper.rotate(-90);
            });

            editRotateRight.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                editCropper && editCropper.rotate(90);
            });

            editFlipHorizontal.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                if (editCropper) {
                    const scaleX = editCropper.getData().scaleX || 1;
                    editCropper.scaleX(-scaleX);
                }
            });
        });
    </script>
@endpush
