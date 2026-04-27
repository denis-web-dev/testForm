document.addEventListener('DOMContentLoaded', () => {
	const form = document.querySelector('form');
	if (!form) return;

	function showError(input, message) {
		let errorSpan = input.parentElement.querySelector('.error-text');
		if (!errorSpan) {
			errorSpan = document.createElement('span');
			errorSpan.className = 'error-text';
			input.parentElement.appendChild(errorSpan);
		}
		errorSpan.textContent = message;
		input.parentElement.classList.add('has-error');
	}

	function clearError(input) {
		const errorSpan = input.parentElement.querySelector('.error-text');
		if (errorSpan) errorSpan.remove();
		input.parentElement.classList.remove('has-error');
	}

	// ====================== РЕГИСТРАЦИЯ (оригинальная логика) ======================
	if (document.body.classList.contains('page-registration')) {
		const nameInput = form.querySelector('input[name="name"]');
		const phoneInput = form.querySelector('input[name="phone"]');
		const emailInput = form.querySelector('input[name="email"]');
		const passwordInput = form.querySelector('input[name="password"]');
		const confirmInput = form.querySelector('input[name="confirm-password"]');

		nameInput?.addEventListener('blur', () => {
			const val = nameInput.value.trim();
			if (!val) return showError(nameInput, 'Имя обязательно');
			if (!/^[a-zA-Zа-яА-ЯёЁ\s\-]+$/u.test(val)) return showError(nameInput, 'Имя может содержать только буквы');
			if (val.length < 2) return showError(nameInput, 'Имя слишком короткое');
			clearError(nameInput);
		});

		phoneInput?.addEventListener('blur', () => {
			let val = phoneInput.value.trim().replace(/[^0-9+]/g, '');
			if (!val) return showError(phoneInput, 'Телефон обязателен');
			if (!/^(\+7|8)[0-9]{10}$/.test(val))
				return showError(phoneInput, 'Введите корректный номер (+7 или 8 и 10 цифр)');
			clearError(phoneInput);
		});

		emailInput?.addEventListener('blur', () => {
			const val = emailInput.value.trim();
			const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|ru|net|org|io|co|info|рф)$/i;
			if (!val) return showError(emailInput, 'E-mail обязателен');
			if (!regex.test(val)) return showError(emailInput, 'Введите корректный E-mail');
			clearError(emailInput);
		});

		passwordInput?.addEventListener('blur', () => {
			const val = passwordInput.value;
			if (val.length < 8) return showError(passwordInput, 'Пароль минимум 8 символов');
			if (!/[A-Za-z]/.test(val) || !/[0-9]/.test(val))
				return showError(passwordInput, 'Пароль должен содержать буквы и цифры');
			clearError(passwordInput);
		});

		confirmInput?.addEventListener('blur', () => {
			if (confirmInput.value !== passwordInput.value) {
				showError(confirmInput, 'Пароли не совпадают');
			} else {
				clearError(confirmInput);
			}
		});

		confirmInput?.addEventListener('input', () => {
			if (confirmInput.value === passwordInput.value) clearError(confirmInput);
		});
	}

	// ====================== АВТОРИЗАЦИЯ ======================
	if (document.body.classList.contains('page-entrance')) {
		const loginInput = form.querySelector('input[name="login"]');
		const passwordInput = form.querySelector('input[name="password"]');

		// Поле логина
		if (loginInput) {
			loginInput.addEventListener('blur', () => {
				const val = loginInput.value.trim();

				if (!val) {
					showError(loginInput, 'Введите email или телефон');
					return;
				}

				// Телефон
				if (/^(\+7|8)/.test(val)) {
					let clean = val.replace(/[^\d]/g, '');
					if (clean.length !== 11) {
						showError(loginInput, 'Введите полный номер телефона (+7 и 10 цифр)');
						return;
					}
				}
				// Email
				else {
					const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|ru|net|org|io|co|info|рф)$/i;
					if (!emailRegex.test(val)) {
						showError(loginInput, 'Введите корректный email');
						return;
					}
				}

				clearError(loginInput);
			});

			loginInput.addEventListener('input', () => clearError(loginInput));
		}

		// Поле пароля
		if (passwordInput) {
			passwordInput.addEventListener('blur', () => {
				if (!passwordInput.value) {
					showError(passwordInput, 'Введите пароль');
				} else if (passwordInput.value.length < 6) {
					showError(passwordInput, 'Пароль должен быть не менее 6 символов');
				} else {
					clearError(passwordInput);
				}
			});

			passwordInput.addEventListener('input', () => clearError(passwordInput));
		}
	}
});

document.addEventListener('DOMContentLoaded', function () {
	const toggleButtons = document.querySelectorAll('.toggle-password');

	const openEyeSVG = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10 12.5C10.663 12.5 11.2989 12.2366 11.7678 11.7678C12.2366 11.2989 12.5 10.663 12.5 10C12.5 9.33696 12.2366 8.70107 11.7678 8.23223C11.2989 7.76339 10.663 7.5 10 7.5C9.33696 7.5 8.70107 7.76339 8.23223 8.23223C7.76339 8.70107 7.5 9.33696 7.5 10C7.5 10.663 7.76339 11.2989 8.23223 11.7678C8.70107 12.2366 9.33696 12.5 10 12.5Z" fill="#1A1A1A"/>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.10167 9.53917C2.34167 5.81333 5.85583 3.125 10 3.125C14.1417 3.125 17.6542 5.81083 18.8958 9.53333C18.9958 9.835 18.9958 10.16 18.8958 10.4608C17.6567 14.1867 14.1417 16.875 9.99833 16.875C5.85667 16.875 2.34333 14.1892 1.1025 10.4667C1.00229 10.1656 1.00229 9.84021 1.1025 9.53917H1.10167ZM14.3742 10C14.3742 11.1603 13.9132 12.2731 13.0928 13.0936C12.2723 13.9141 11.1595 14.375 9.99917 14.375C8.83885 14.375 7.72605 13.9141 6.90558 13.0936C6.0851 12.2731 5.62417 11.1603 5.62417 10C5.62417 8.83968 6.0851 7.72688 6.90558 6.90641C7.72605 6.08594 8.83885 5.625 9.99917 5.625C11.1595 5.625 12.2723 6.08594 13.0928 6.90641C13.9132 7.72688 14.3742 8.83968 14.3742 10Z" fill="#1A1A1A"/>
    </svg>`;

	const closedEyeSVG = `<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.15222 5.8518C2.16343 6.85903 1.40027 8.08847 0.944441 9.45811H0.945275C0.845065 9.75916 0.845065 10.0846 0.945275 10.3856C2.18611 14.1081 5.69944 16.7939 9.84111 16.7939C11.0996 16.7939 12.3002 16.5459 13.3966 16.0961L11.3326 14.0322C10.8591 14.2038 10.3552 14.2939 9.84194 14.2939C8.68162 14.2939 7.56882 13.833 6.74835 13.0125C5.92788 12.1921 5.46694 11.0793 5.46694 9.91895C5.46694 9.4057 5.55713 8.90175 5.72872 8.42829L3.15222 5.8518ZM8.46576 5.76602L6.39712 3.69738C7.46362 3.27568 8.62605 3.04395 9.84278 3.04395C13.9844 3.04395 17.4969 5.72978 18.7386 9.45228C18.8386 9.75394 18.8386 10.0789 18.7386 10.3798C18.2948 11.7141 17.5592 12.9153 16.6074 13.9076L13.9949 11.2951C14.1406 10.8553 14.2169 10.391 14.2169 9.91895C14.2169 8.75862 13.756 7.64582 12.9355 6.82535C12.1151 6.00488 11.0023 5.54395 9.84194 5.54395C9.36985 5.54395 8.90563 5.62025 8.46576 5.76602ZM7.3458 10.0454C7.37702 10.6624 7.63588 11.2478 8.07484 11.6867C8.51379 12.1257 9.09917 12.3845 9.71618 12.4157L7.3458 10.0454ZM12.3253 9.6256L10.136 7.43621C10.691 7.50177 11.2112 7.75201 11.6104 8.15118C12.0095 8.55034 12.2598 9.07059 12.3253 9.6256Z" fill="#1A1A1A"/>
        <path d="M3.45524 2.6084L2.6084 3.45524L16.5442 17.391L17.391 16.5442L3.45524 2.6084Z" fill="#1A1A1A"/>
    </svg>`;

	toggleButtons.forEach((button) => {
		const toggleIcon = button.querySelector('.toggle__password-svg');
		toggleIcon.innerHTML = closedEyeSVG;
		button.setAttribute('aria-label', 'Показать пароль');
	});

	toggleButtons.forEach((button) => {
		button.addEventListener('click', function () {
			const targetId = this.getAttribute('data-target');
			const passwordInput = document.getElementById(targetId);
			const toggleIcon = this.querySelector('.toggle__password-svg');

			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
				toggleIcon.innerHTML = openEyeSVG;
				this.setAttribute('aria-label', 'Скрыть пароль');
			} else {
				passwordInput.type = 'password';
				toggleIcon.innerHTML = closedEyeSVG;
				this.setAttribute('aria-label', 'Показать пароль');
			}
		});
	});
});

const textarea = document.getElementById('about');
const counter = document.getElementById('aboutCounter');
const MAX = 500;

if (textarea && counter) {
	textarea.maxLength = MAX;

	const update = () => {
		const len = textarea.value.length;
		counter.textContent = len;
		counter.style.color = len > MAX - 50 ? '#fd4040' : len > MAX - 100 ? '#f37d39' : '#666';
	};

	textarea.addEventListener('input', update);
	update();
}
