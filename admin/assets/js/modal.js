"use strict";
// detail modal
const detailButtons = document.querySelectorAll('.detail-btn');
const modal = document.getElementById('detailDialog');
const closeModalButton = modal.querySelector('.dialog-close-btn');

detailButtons.forEach(button => {
  button.addEventListener('click', function() {
    document.getElementById('dialogNama').textContent = this.getAttribute('data-nama');
    document.getElementById('dialogEmail').textContent = this.getAttribute('data-email');
    document.getElementById('dialogJenisKelamin').textContent = this.getAttribute('data-jenis-kelamin');
    document.getElementById('dialogAlamat').textContent = this.getAttribute('data-alamat');
    document.getElementById('dialogKabKota').textContent = this.getAttribute('data-kabupaten');
    document.getElementById('dialogProvinsi').textContent = this.getAttribute('data-provinsi');
    document.getElementById('dialogKTP').textContent = this.getAttribute('data-no-ktp');
    document.getElementById('dialogTelepon').textContent = this.getAttribute('data-no-telepon');
    document.getElementById('dialogHubungan').textContent = this.getAttribute('data-hubungan');
    document.getElementById('dialogPengikutLaki').textContent = this.getAttribute('data-pengikut-laki');
    document.getElementById('dialogPengikutWanita').textContent = this.getAttribute('data-pengikut-wanita');
    document.getElementById('dialogPengikutAnak').textContent = this.getAttribute('data-pengikut-anak');
    document.getElementById('dialogBarang').textContent = this.getAttribute('data-barang-bawaan');
    document.getElementById('dialogWBP').textContent = this.getAttribute('data-nama-wbp');
    document.getElementById('dialogSesi').textContent = this.getAttribute('data-sesi');
    document.getElementById('dialogTanggal').textContent = this.getAttribute('data-tanggal');

    modal.showModal();
  });
});

closeModalButton.addEventListener('click', () => {
  modal.close();
});

window.addEventListener('click', (e) => {
  if (e.target === modal) {
    modal.close();
  }
});
