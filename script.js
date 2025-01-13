document.addEventListener('DOMContentLoaded', function () {
    const languageLinks = document.querySelectorAll('.language-item');
    const rememberCheckbox = document.getElementById('remember-choice');

    languageLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // جلوگیری از رفتار پیش‌فرض لینک
            const lang = this.getAttribute('data-lang');

            // ذخیره زبان انتخاب‌شده در کوکی
            document.cookie = `selected_language=${lang}; path=/; max-age=2592000;`;

            // اگر چک‌باکس فعال باشد، ذخیره انتخاب
            if (rememberCheckbox.checked) {
                document.cookie = `remember_language=true; path=/; max-age=2592000;`;
            }

            // حذف صفحه انتخاب زبان
            const overlay = document.getElementById('language-overlay');
            overlay.style.display = 'none';
        });
    });
});


overlay.classList.add('fade-out');
setTimeout(() => overlay.remove(), 500);
