import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';
import { saveAs } from 'file-saver';

class TeacherForm {
    constructor() {
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => this.init());
    }

    init() {
        // Photo Upload Elements
        this.photoInput = document.getElementById('photo');
        this.dropArea = document.getElementById('dropArea');
        this.photoPreview = document.getElementById('photoPreview');
        this.photoPreviewImage = document.getElementById('photoPreviewImage');
        this.removePhoto = document.getElementById('removePhoto');
        this.cropModal = document.getElementById('cropModal');
        this.imageToCrop = document.getElementById('imageToCrop');
        this.closeCropModal = document.getElementById('closeCropModal');
        this.cancelCrop = document.getElementById('cancelCrop');
        this.applyCrop = document.getElementById('applyCrop');
        this.rotateLeft = document.getElementById('rotateLeft');
        this.rotateRight = document.getElementById('rotateRight');
        this.flipHorizontal = document.getElementById('flipHorizontal');
        this.aspectRatio = document.getElementById('aspectRatio');

        // CV Upload Elements
        this.cvInput = document.getElementById('cv');
        this.cvDropArea = document.getElementById('cvDropArea');
        this.cvFileName = document.getElementById('cvFileName');
        this.removeCv = document.getElementById('removeCv');

        // State
        this.cropper = null;
        this.originalImageUrl = null;

        // Initialize event listeners
        this.setupPhotoUpload();
        this.setupCVUpload();
        this.setupModalCleanup();
    }

    setupPhotoUpload() {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            this.dropArea.addEventListener(eventName, this.preventDefaults.bind(this), false);
            document.body.addEventListener(eventName, this.preventDefaults.bind(this), false);
        });

        // Highlight drop area
        ['dragenter', 'dragover'].forEach(eventName => {
            this.dropArea.addEventListener(eventName, this.highlight.bind(this), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            this.dropArea.addEventListener(eventName, this.unhighlight.bind(this), false);
        });

        // Event listeners
        this.dropArea.addEventListener('drop', this.handleDrop.bind(this), false);
        this.dropArea.addEventListener('click', () => this.photoInput.click());
        this.photoInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                this.handleFile(e.target.files[0]);
            }
        });
        this.removePhoto.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.resetPhoto();
        });

        // Crop modal controls
        this.closeCropModal.addEventListener('click', this.closeCrop.bind(this));
        this.cancelCrop.addEventListener('click', this.closeCrop.bind(this));
        this.applyCrop.addEventListener('click', this.applyCropHandler.bind(this));
        this.rotateLeft.addEventListener('click', () => this.cropper?.rotate(-90));
        this.rotateRight.addEventListener('click', () => this.cropper?.rotate(90));
        this.flipHorizontal.addEventListener('click', this.flipImage.bind(this));
        this.aspectRatio.addEventListener('change', this.changeAspectRatio.bind(this));
    }

    setupCVUpload() {
        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            this.cvDropArea.addEventListener(eventName, this.preventDefaults.bind(this), false);
        });

        // Highlight drop area
        ['dragenter', 'dragover'].forEach(eventName => {
            this.cvDropArea.addEventListener(eventName, this.highlightCV.bind(this), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            this.cvDropArea.addEventListener(eventName, this.unhighlightCV.bind(this), false);
        });

        // Event listeners
        this.cvDropArea.addEventListener('drop', this.handleCvDrop.bind(this), false);
        this.cvDropArea.addEventListener('click', () => this.cvInput.click());
        this.cvInput.addEventListener('change', (e) => {
            if (e.target.files && e.target.files[0]) {
                this.handleCvFile(e.target.files[0]);
            }
        });
        this.removeCv.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.resetCv();
        });
    }

    setupModalCleanup() {
        document.getElementById('closeCreateModal').addEventListener('click', this.cleanupModals.bind(this));
        document.getElementById('cancelCreateModal').addEventListener('click', this.cleanupModals.bind(this));
        
        // Form submission handler
        document.querySelector('form').addEventListener('submit', (e) => {
            const submitBtn = document.getElementById('createSubmitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
        });
    }

    // ========== Photo Upload Methods ==========
    preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    highlight() {
        this.dropArea.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
    }

    unhighlight() {
        this.dropArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
    }

    handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            this.handleFile(files[0]);
        }
    }

    handleFile(file) {
        // Validate file type
        if (!file.type.match('image.*')) {
            this.showAlert('Please select an image file (JPG, PNG)');
            return;
        }

        // Validate file size
        if (file.size > 2 * 1024 * 1024) {
            this.showAlert('File size exceeds 2MB limit');
            return;
        }

        // Create object URL
        this.originalImageUrl = URL.createObjectURL(file);

        // Show crop modal
        this.imageToCrop.src = this.originalImageUrl;
        this.cropModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');

        // Initialize cropper when image loads
        this.imageToCrop.onload = () => {
            if (this.cropper) {
                this.cropper.destroy();
            }
            
            this.cropper = new Cropper(this.imageToCrop, {
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

    closeCrop() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }
        if (this.originalImageUrl) {
            URL.revokeObjectURL(this.originalImageUrl);
            this.originalImageUrl = null;
        }
        this.cropModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    resetPhoto() {
        this.photoInput.value = '';
        this.photoPreview.classList.add('hidden');
        this.dropArea.classList.remove('hidden');
        if (this.photoPreviewImage.src) {
            URL.revokeObjectURL(this.photoPreviewImage.src);
            this.photoPreviewImage.src = '';
        }
    }

    applyCropHandler() {
        if (this.cropper) {
            const canvas = this.cropper.getCroppedCanvas({
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
                    const file = new File([blob], 'profile-photo.jpg', {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });

                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    this.photoInput.files = dataTransfer.files;

                    this.photoPreviewImage.src = URL.createObjectURL(blob);
                    this.photoPreview.classList.remove('hidden');
                    this.dropArea.classList.add('hidden');
                }, 'image/jpeg', 0.9);
            }
        }
        this.closeCrop();
    }

    flipImage() {
        if (this.cropper) {
            const scaleX = this.cropper.getData().scaleX || 1;
            this.cropper.scaleX(-scaleX);
        }
    }

    changeAspectRatio() {
        if (this.cropper) {
            const ratio = this.aspectRatio.value;
            this.cropper.setAspectRatio(ratio === 'NaN' ? NaN : eval(ratio));
        }
    }

    // ========== CV Upload Methods ==========
    highlightCV() {
        this.cvDropArea.classList.add('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
    }

    unhighlightCV() {
        this.cvDropArea.classList.remove('border-indigo-500', 'bg-indigo-50', 'dark:bg-indigo-900');
    }

    handleCvDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            this.handleCvFile(files[0]);
        }
    }

    handleCvFile(file) {
        const validTypes = [
            'application/pdf', 
            'application/msword', 
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ];
        
        if (!validTypes.includes(file.type)) {
            this.showAlert('Please select a PDF, DOC, or DOCX file');
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            this.showAlert('File size exceeds 5MB limit');
            return;
        }

        this.cvFileName.textContent = file.name;
        this.cvFileName.classList.remove('hidden');
        this.removeCv.classList.remove('hidden');
        this.cvDropArea.classList.add('hidden');
    }

    resetCv() {
        this.cvInput.value = '';
        this.cvFileName.textContent = '';
        this.cvFileName.classList.add('hidden');
        this.removeCv.classList.add('hidden');
        this.cvDropArea.classList.remove('hidden');
    }

    // ========== Utility Methods ==========
    showAlert(message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg z-50';
        alertDiv.textContent = message;
        document.body.appendChild(alertDiv);
        
        setTimeout(() => {
            alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-300');
            setTimeout(() => {
                document.body.removeChild(alertDiv);
            }, 300);
        }, 3000);
    }

    cleanupModals() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }
        if (this.originalImageUrl) {
            URL.revokeObjectURL(this.originalImageUrl);
            this.originalImageUrl = null;
        }
        this.resetPhoto();
        this.resetCv();
    }
}

// Initialize the form when loaded
new TeacherForm();