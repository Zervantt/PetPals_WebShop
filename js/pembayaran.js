function updatePaymentMethod() {
    var selectedMethod = document.getElementById('metode_pembayaran').value;
    var transferBank = document.getElementById('transfer-bank-info');
    var qris = document.getElementById('qris-info');

    transferBank.style.display = 'none';
    qris.style.display = 'none';
    ewallet.style.display = 'none';

    if (selectedMethod === 'Transfer Bank') {
        transferBank.style.display = 'block';
    } else if (selectedMethod === 'QRIS') {
        qris.style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const namaPelangganInput = document.getElementById('nama_pelanggan');
    const alamatInput = document.getElementById('alamat');
    const teleponInput = document.getElementById('telepon');
    const buktiInput = document.getElementById('bukti');
    const form = document.querySelector('form');

    form.addEventListener('submit', (event) => {
        let isValid = true;
        
        // Reset error messages
        document.getElementById('namaError').textContent = '';
        document.getElementById('alamatError').textContent = '';
        document.getElementById('teleponError').textContent = '';

        // Validasi nama_pelanggan
        if (!/^[A-Za-z\s]+$/.test(namaPelangganInput.value)) {
            document.getElementById('namaError').textContent = 'Nama hanya boleh berisi huruf dan spasi';
            isValid = false;
        }

        // Validasi alamat
        if (alamatInput.value.trim() === '') {
            document.getElementById('alamatError').textContent = 'Alamat tidak boleh kosong';
            isValid = false;
        }

        // Validasi telepon
        if (!/^\d+$/.test(teleponInput.value)) {
            document.getElementById('teleponError').textContent = 'Telepon hanya boleh berisi angka';
            isValid = false;
        }

        // Validasi bukti pembayaran
        const fileSize = buktiInput.files[0].size;
        const fileType = buktiInput.files[0].type;
        if (fileSize > 700000) {
            alert('File tidak boleh lebih dari 700 kb!');
            isValid = false;
        }
        if (fileType !== 'image/jpeg' && fileType !== 'image/png') {
            alert('File wajib berformat jpg, jpeg, atau png!');
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
});