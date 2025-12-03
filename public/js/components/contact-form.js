/**
 * Contact Form Component - Lazy loaded form handling
 * Includes validation and submission logic
 */

(function() {
    'use strict';

    class ContactForm {
        constructor(element) {
            this.form = element;
            this.submitButton = element.querySelector('button[type="submit"]');
            this.init();
        }

        init() {
            if (!this.form) return;

            this.form.addEventListener('submit', (e) => this.handleSubmit(e));
            this.setupValidation();
        }

        setupValidation() {
            const inputs = this.form.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                input.addEventListener('blur', () => this.validateField(input));
                input.addEventListener('input', () => this.clearError(input));
            });
        }

        validateField(field) {
            const value = field.value.trim();
            let isValid = true;
            let errorMessage = '';

            // Required validation
            if (field.hasAttribute('required') && !value) {
                isValid = false;
                errorMessage = 'Este campo é obrigatório';
            }

            // Email validation
            if (field.type === 'email' && value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Email inválido';
                }
            }

            // Phone validation
            if (field.type === 'tel' && value) {
                const phoneRegex = /^[\d\s\-\(\)]+$/;
                if (!phoneRegex.test(value)) {
                    isValid = false;
                    errorMessage = 'Telefone inválido';
                }
            }

            if (!isValid) {
                this.showError(field, errorMessage);
            }

            return isValid;
        }

        showError(field, message) {
            this.clearError(field);

            const errorDiv = document.createElement('div');
            errorDiv.className = 'error-message text-red-600 text-sm mt-1';
            errorDiv.textContent = message;

            field.classList.add('border-red-500');
            field.parentNode.appendChild(errorDiv);
        }

        clearError(field) {
            field.classList.remove('border-red-500');
            const errorDiv = field.parentNode.querySelector('.error-message');
            if (errorDiv) {
                errorDiv.remove();
            }
        }

        validateForm() {
            const fields = this.form.querySelectorAll('input, textarea');
            let isValid = true;

            fields.forEach(field => {
                if (!this.validateField(field)) {
                    isValid = false;
                }
            });

            return isValid;
        }

        async handleSubmit(e) {
            e.preventDefault();

            if (!this.validateForm()) {
                return;
            }

            const formData = new FormData(this.form);
            const data = Object.fromEntries(formData);

            this.setLoading(true);

            try {
                const response = await fetch(this.form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    this.showSuccess();
                    this.form.reset();
                } else {
                    this.showError(this.form, 'Erro ao enviar formulário. Tente novamente.');
                }
            } catch (error) {
                this.showError(this.form, 'Erro de conexão. Verifique sua internet.');
            } finally {
                this.setLoading(false);
            }
        }

        setLoading(loading) {
            if (this.submitButton) {
                this.submitButton.disabled = loading;
                this.submitButton.textContent = loading ? 'Enviando...' : 'Enviar';
            }
        }

        showSuccess() {
            const successDiv = document.createElement('div');
            successDiv.className = 'success-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4';
            successDiv.textContent = 'Mensagem enviada com sucesso!';

            this.form.insertBefore(successDiv, this.form.firstChild);

            setTimeout(() => successDiv.remove(), 5000);
        }
    }

    // Initialize all contact forms
    document.querySelectorAll('form[data-contact-form]').forEach(form => {
        new ContactForm(form);
    });

    console.log('Contact form component loaded');
})();
