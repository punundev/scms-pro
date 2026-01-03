<div class="absolute -bottom-12">
  <div
    class="size-35 rounded-full border-4 border-white dark:border-slate-800 bg-white dark:bg-slate-700 shadow-lg relative">
    {{-- Set the current image URL here. Use $name for ID, no $edit needed --}}
    <img id="{{ $name }}" src="{{ $currentImageUrl }}" alt="Profile Photo"
      class="w-full h-full object-cover rounded-full {{ $currentImageUrl ? '' : 'hidden' }}">

    {{-- Show initials container if no current image exists --}}
    <div id="{{ $name }}_initials"
      class="rounded-full absolute inset-0 w-full h-full flex items-center justify-center bg-indigo-100 dark:bg-slate-600 {{ $currentImageUrl ? 'hidden' : '' }}">
      <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-300"><i class="text-8xl ri-account-circle-fill"></i></span>
    </div>

    <input type="file" id="upload_{{ $name }}" name="{{ $name }}" accept="image/*" class="hidden">

    <label for="upload_{{ $name }}"
      class="size-8 flex justify-center items-center absolute bottom-0 right-0 bg-white dark:bg-gray-700 p-1 rounded-full shadow cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600">
      <i class="ri-camera-line text-indigo-600 dark:text-indigo-300"></i>
    </label>

    {{-- ADDED: Remove button for edit pages --}}
    @if ($canRemove && $currentImageUrl)
      <button type="button" id="remove_{{ $name }}"
        @click.prevent="{{ $removeAction }}; document.getElementById('{{ $name }}').src=''; document.getElementById('{{ $name }}').classList.add('hidden'); document.getElementById('{{ $name }}_initials').classList.remove('hidden');"
        class="size-8 flex justify-center items-center absolute -top-1 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-500 text-white p-1 rounded-full shadow cursor-pointer hover:bg-red-600 z-10">
        <i class="ri-delete-bin-line"></i>
      </button>
    @endif
  </div>
</div>
<div id="{{ $name }}CropModal"
  class="overflow-hidden rounded-xl fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-lg bg-opacity-50 hidden">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl p-4">
    <div class="flex justify-between items-center mb-4">
      <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Crop Image</h3>
    </div>
    <div class="flex flex-col md:flex-row gap-4">
      <div class="flex-1">
        <div class="img-container">
          <img id="{{ $name }}ImageToCrop" class="max-w-full max-h-[60vh]" src="" alt="Image to crop">
        </div>
      </div>

      <div class="md:w-64 flex flex-col gap-3">
        <div class="preview-container overflow-hidden w-[200px] h-[200px] rounded-full mx-auto border border-gray-200">
        </div>
        <div class="flex gap-2 mt-2 justify-center">
          <button type="button" id="{{ $name }}RotateLeft"
            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
            </svg>
          </button>
          <button type="button" id="{{ $name }}RotateRight"
            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 8V4m0 0h-4m4 0l-4 4m4 11v4m0 0h-4m4 0l-4-4" />
            </svg>
          </button>
          <button type="button" id="{{ $name }}FlipHorizontal"
            class="p-2 bg-gray-200 dark:bg-gray-700 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
            </svg>
          </button>
        </div>

        <div class="flex gap-2 mt-auto pt-4">
          <button type="button" id="{{ $name }}ApplyCrop"
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
      // Use the component name (e.g., 'avatar') to create unique IDs
      const componentName = '{{ $name }}';

      // Element references using componentName
      const photoInput = document.getElementById(`upload_${componentName}`);
      const photoPreview = document.getElementById(componentName);
      const initialsContainer = document.getElementById(`${componentName}_initials`);
      const cropModal = document.getElementById(`${componentName}CropModal`);
      const ImageToCrop = document.getElementById(`${componentName}ImageToCrop`);
      const applyCrop = document.getElementById(`${componentName}ApplyCrop`);
      const rotateLeft = document.getElementById(`${componentName}RotateLeft`);
      const rotateRight = document.getElementById(`${componentName}RotateRight`);
      const flipHorizontal = document.getElementById(`${componentName}FlipHorizontal`);

      let cropper;
      let originalImageUrl;

      // Handle file selection
      photoInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
          handleFile(this.files[0]);
          this.value = ''; // Clear input for re-selection
        }
      });

      // Handle file
      function handleFile(file) {
        // Check if the file is an image
        if (!file.type.match('image.*')) {
          // Assuming ShowTaskMessage is defined globally
          if (typeof ShowTaskMessage !== 'undefined') {
            ShowTaskMessage('error', 'Please select an image file (JPG, PNG)');
          }
          return;
        }

        // Create a URL for the file
        originalImageUrl = URL.createObjectURL(file);

        // Show crop modal
        ImageToCrop.src = originalImageUrl;
        cropModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // Initialize cropper after image is loaded
        ImageToCrop.onload = function() {
          if (cropper) {
            cropper.destroy();
          }

          cropper = new Cropper(ImageToCrop, {
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

      // Close crop modal and clean up
      function closeCrop() {
        if (cropper) {
          cropper.destroy();
          cropper = null;
        }
        if (originalImageUrl) {
          URL.revokeObjectURL(originalImageUrl);
          originalImageUrl = null;
        }
        cropModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
        photoInput.value = ''; // Reset the input
      }

      applyCrop.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        if (cropper) {
          const canvas = cropper.getCroppedCanvas({
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
              photoPreview.src = URL.createObjectURL(blob);

              // Show the image and hide initials
              photoPreview.classList.remove('hidden');
              initialsContainer.classList.add('hidden');

              // Create a new File object
              const file = new File([blob], 'profile-photo.jpg', {
                type: 'image/jpeg',
                lastModified: Date.now()
              });

              // Create a new FileList and DataTransfer
              const dataTransfer = new DataTransfer();
              dataTransfer.items.add(file);

              // Update the file input
              photoInput.files = dataTransfer.files;

              // Clean up
              if (originalImageUrl) {
                URL.revokeObjectURL(originalImageUrl);
              }
            }, 'image/jpeg', 0.9);
          }
        }
        closeCrop();
      });

      rotateLeft.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        cropper && cropper.rotate(-90);
      });

      rotateRight.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        cropper && cropper.rotate(90);
      });

      flipHorizontal.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        if (cropper) {
          const scaleX = cropper.getData().scaleX || 1;
          cropper.scaleX(-scaleX);
        }
      });
    });
  </script>
@endpush
