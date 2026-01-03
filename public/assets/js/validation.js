// // bootstrap-validation.js - Standalone version
// (() => {
//     'use strict';

//     // Fetch all forms that need validation
//     const forms = document.querySelectorAll('.needs-validation');
//     // Loop over them and prevent submission
//     Array.from(forms).forEach(form => {
//         form.addEventListener('submit', event => {
//             if (!form.checkValidity()) {
//                 event.preventDefault();
//                 event.stopPropagation();
//             }

//             form.classList.add('was-validated');
//         }, false);

//         // Add input event listeners for real-time validation
//         const inputs = form.querySelectorAll('input, select, textarea');
//         inputs.forEach(input => {
//             input.addEventListener('input', () => {
//                 if (input.checkValidity()) {
//                     input.classList.remove('is-invalid');
//                     input.classList.add('is-valid');
//                 } else {
//                     input.classList.remove('is-valid');
//                     input.classList.add('is-invalid');
//                 }
//             });
//         });
//     });
// })();


// bootstrap-validation.js - Standalone version
(() => {
    'use strict';

    // Fetch all forms that need validation
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);

        // Add input event listeners for real-time validation
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                validateField(input);
            });

            // Validate on blur for better UX
            input.addEventListener('blur', () => {
                validateField(input);
            });
        });
    });

    // Function to validate a single field
    function validateField(input) {
        const isValid = input.checkValidity();
        const feedbackElement = input.nextElementSibling;

        if (isValid) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                feedbackElement.textContent = '';
            }
        } else {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                feedbackElement.textContent = input.validationMessage;
            }
        }
    }

    // Make this function available globally to handle server-side errors
    window.applyServerValidationErrors = function (formId, errors) {
        const form = document.getElementById(formId);
        if (!form) return;

        // Clear all previous validation states
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.classList.remove('is-valid', 'is-invalid');
            const feedbackElement = input.nextElementSibling;
            if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                feedbackElement.textContent = '';
            }
        });

        // Apply new errors
        for (const [field, messages] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${field}"]`);
            if (input) {
                input.classList.add('is-invalid');
                const feedbackElement = input.nextElementSibling;
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.textContent = messages.join(', ');
                }
            }
        }

        form.classList.add('was-validated');
    };

    document.addEventListener('DOMContentLoaded', function() {
    // Fix email pattern attributes with invalid /v flag
    const emailInputs = document.querySelectorAll('input[type="email"][pattern*="/v"]');
    emailInputs.forEach(input => {
        const pattern = input.getAttribute('pattern');
        if (pattern && pattern.endsWith('/v')) {
            input.setAttribute('pattern', pattern.replace(/\/v$/, ''));
        }
    });
});
})();