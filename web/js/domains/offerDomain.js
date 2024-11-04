class OfferDomain {
    constructor(id = null, title = null, email = null, phone = null) {
        this.id    = id;
        this.title = title;
        this.email = email;
        this.phone = phone;

        this.validation = this.isValid();
    }

    isValid() {
        if (!this.title || this.title.trim() === '') {
            return {valid: false, message: 'Поле Название не должно быть пустым' };
        }

        const emailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
        if (!this.email || !emailRegex.test(this.email)) {
            return { valid: false, message: 'Введите корректный Email' };
        }

        const phoneValidation = this.validatePhone(this.phone);
        if (!phoneValidation.valid) {
            return { valid: false, message: phoneValidation.message };
        }

        return { valid: true };
    }

    validatePhone(phone) {
        let cleaned = ('' + phone).replace(/\D/g, '');

        if (cleaned.length < 10 || cleaned.length > 15) {
            return { valid: false, message: 'Телефон должен содержать от 10 до 15 цифр.' };
        }

        if (cleaned.startsWith('8')) {
            cleaned = cleaned.slice(1);
        }

        const match = cleaned.match(/^(\d{3})(\d{3})(\d{4})$/);
        if (match) {
            this.phone = `+8 (${match[1]}) ${match[2]}-${match[3]}`;
        } else {
            this.phone = `+8${cleaned}`;
        }

        return { valid: true };
    }
}

export {OfferDomain};
