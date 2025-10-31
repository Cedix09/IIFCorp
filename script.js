document.addEventListener("DOMContentLoaded", function() {
    const header = document.querySelector(".t");

    document.addEventListener("scroll", function() {
        if (window.scrollY > 90) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });
});
function toggleDropdown() {
    const dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("show"); // Переключаем класс "show" для отображения/скрытия меню
}

// Закрываем выпадающее меню, если кликнуть вне него
window.onclick = function(event) {
    if (!event.target.matches('.language-button')) { // Проверяем, был ли клик вне кнопки
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) { // Если меню открыто
                openDropdown.classList.remove('show'); // Закрываем его
            }
        }
    }
}

// Функция для смены языка
function changeLanguage(lang) {
    const file = lang === 'ua' ? 'lang_ua.json' : 'lang_ru.json';

    fetch(file)
        .then(response => response.json())
        .then(data => {
            document.querySelector('.iif').textContent = data.header.we;
            document.querySelector('.red-section .moving-text').textContent = data.header.index;
            document.querySelector('#we2').textContent = data.body.we2;
            document.querySelector('#corp').textContent = data.body.corp;
            document.querySelector('#corp2').textContent = data.body.corp2;
            document.querySelector('.name').textContent = data.body.name;
            document.querySelector('.zaraz').textContent = data.body.zaraz;
            document.querySelector('.i').textContent = data.body.i;
            document.querySelector('.f').textContent = data.body.f;
        })
        .catch(error => console.error('Ошибка при загрузке языковых данных:', error));
}

// Закрываем меню при клике на элемент
const dropdownLinks = document.querySelectorAll('.dropdown-content a');
dropdownLinks.forEach(link => {
    link.addEventListener('click', function() {
        const dropdown = document.getElementById("dropdown");
        dropdown.classList.remove("show"); // Закрываем меню после выбора языка
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Обработка прокрутки страницы
    const header = document.querySelector(".t");
    document.addEventListener("scroll", function () {
        if (window.scrollY > 90) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    // Модальные окна
    const registerModal = document.getElementById('registerModal');
    const loginModal = document.getElementById('loginModal');
    const openModalBtn = document.getElementById('openModalBtn');  // Если эта кнопка существует
    const closeBtns = document.querySelectorAll('.close');  // Кнопки закрытия

    // Модальное окно редактирования профиля
    const editProfileModal = document.getElementById('editProfileModal');
    const editProfileBtn = document.getElementById('editProfileBtn');  // Если эта кнопка существует
    const closeEditProfileModal = document.getElementById('closeEditProfileModal');

    // Переключение на форму входа
    const switchToLogin = function () {
        registerModal.style.display = 'none';
        loginModal.style.display = 'block';
    };

    // Переключение на форму регистрации
    const switchToRegister = function () {
        loginModal.style.display = 'none';
        registerModal.style.display = 'block';
    };

    // Открытие модального окна регистрации
    if (openModalBtn) {
        openModalBtn.addEventListener('click', () => {
            registerModal.style.display = 'block'; // Показываем модальное окно регистрации
        });
    }

    // Закрытие модальных окон
    closeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            registerModal.style.display = 'none';
            loginModal.style.display = 'none';
            editProfileModal.style.display = 'none';  // Закрываем окно редактирования профиля
        });
    });

    // Закрытие при клике вне окна
    window.addEventListener('click', (event) => {
        if (event.target === registerModal || event.target === loginModal || event.target === editProfileModal) {
            registerModal.style.display = 'none';
            loginModal.style.display = 'none';
            editProfileModal.style.display = 'none';
        }
    });

    // Открытие окна редактирования профиля
    if (editProfileBtn) {
        editProfileBtn.addEventListener('click', () => {
            editProfileModal.style.display = 'block';
        });
    }

    // Закрытие окна редактирования профиля
    if (closeEditProfileModal) {
        closeEditProfileModal.addEventListener('click', () => {
            editProfileModal.style.display = 'none';
        });
    }

    // Переключение между окнами регистрации и входа
    const switchToLoginBtn = document.querySelector('[onclick="switchToLogin()"]');
    const switchToRegisterBtn = document.querySelector('[onclick="switchToRegister()"]');

    if (switchToLoginBtn) {
        switchToLoginBtn.addEventListener('click', switchToLogin);
    }

    if (switchToRegisterBtn) {
        switchToRegisterBtn.addEventListener('click', switchToRegister);
    }
});



