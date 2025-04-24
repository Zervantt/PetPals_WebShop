const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

document.getElementById('registerForm').addEventListener('submit', function(event) {
    let isValid = true;

    const nama = document.getElementById('nama').value;
    const username = document.getElementById('registerUsername').value;
    const password = document.getElementById('registerPassword').value;

    const namaPattern = /^[A-Za-z\s]{1,50}$/;
    const usernamePattern = /^[A-Za-z0-9_]{8,25}$/;
    const passwordPattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,25}$/;

    // Reset error messages
    document.getElementById('namaError').textContent = '';
    document.getElementById('registerUsernameError').textContent = '';
    document.getElementById('registerPasswordError').textContent = '';

    if (!namaPattern.test(nama)) {
        document.getElementById('namaError').textContent = 'Nama hanya boleh berisi huruf dan spasi, maksimal 50 karakter';
        isValid = false;
    }

    if (!usernamePattern.test(username)) {
        document.getElementById('registerUsernameError').textContent = 'Username harus terdiri dari 8-25 karakter, huruf, angka atau underscore';
        isValid = false;
    }

    if (!passwordPattern.test(password)) {
        document.getElementById('registerPasswordError').textContent = 'Password harus terdiri dari 8-25 karakter, huruf besar, huruf kecil, angka, dan simbol';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});

document.getElementById('loginForm').addEventListener('submit', function(event) {
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;
    
    if (!username || !password) {
        document.getElementById('loginError1').textContent = 'Username dan Password tidak boleh kosong';
        event.preventDefault();
    }
});