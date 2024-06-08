document.getElementById("addPhotoBtn").addEventListener("click", function () {
    const photoInputs = document.getElementById("photoInputs");
    const newPhotoInput = document.createElement("div");
    newPhotoInput.classList.add("photo-input", "mb-2");
    newPhotoInput.innerHTML = `
        <div class="d-flex align-items-start">
            <div class="me-3">
                <img class="img-thumbnail" src="" alt="Foto Produk" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
        </div>
        <div class="flex-grow-1">
            <input type="file" name="foto_produk[]" class="form-control userPhoto" accept=".jpg,.png">
        </div>`;
    photoInputs.appendChild(newPhotoInput);

    // Tambahkan event listener ke input file yang baru ditambahkan
    const newInput = newPhotoInput.querySelector(".userPhoto");
    newInput.addEventListener("change", function (event) {
        const file = event.target.files[0];
        const img = newPhotoInput.querySelector("img");
        const reader = new FileReader();

        reader.onload = function (e) {
            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
});

document.getElementById("hargaInput").addEventListener("input", function (e) {
    // Menghilangkan selain angka yang ada
    this.value = this.value.replace(/[^0-9]/g, "");
    // Menambahkan titik setiap tiga digit
    this.value = this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

document.getElementById("beratProduk").addEventListener("input", function (e) {
    // Menghilangkan selain angka yang ada
    this.value = this.value.replace(/[^0-9g]/g, "");
    // Menambahkan titik setiap tiga digit
    this.value = this.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
});

document.getElementById("formproduk").addEventListener("submit", function (e) {
    var hargaInput = document.getElementById("hargaInput").value;
    var beratProduk = document.getElementById("beratProduk").value;

    var hargaTanpaTitik = hargaInput.replace(/\./g, "");
    var beratTanpaTitik = beratProduk.replace(/\./g, "");

    document.getElementById("hargaInput").value = hargaTanpaTitik;
    document.getElementById("beratProduk").value = beratTanpaTitik;
});

document.querySelectorAll(".userPhoto").forEach((input) => {
    input.addEventListener("change", function (event) {
        const file = event.target.files[0];
        const img = event.target.closest(".photo-input").querySelector("img");
        const reader = new FileReader();

        reader.onload = function (e) {
            img.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Mendapatkan semua kotak centang
    var checkboxes = document.querySelectorAll(".ukuran-checkbox");

    // Menambahkan event listener untuk setiap kotak centang
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            const targetId = this.dataset.target;
            const inputContainer = document.getElementById("ukuranInputs");

            if (this.checked) {
                console.log("Kotak centang " + targetId + " telah dicentang");
                const newInput = document.createElement("div");
                newInput.id = "Inputan_" + targetId; // Setel id agar dapat dihapus nantinya
                newInput.classList.add("mb-3", "ukuran-input");
                newInput.innerHTML = `
                            <div class="form-outline">
                                <label class="form-label" id="ukuranlabel_${targetId}">Stok Ukuran ${targetId}</label>
                            </div>
                           <div class="input-group mb-3">
                                <div class="form-floating">
                                    <input type="text" id="stok_${targetId}" class="form-control" name="stok_${targetId}" pattern="[0-9]*" placeholder="Stok" required>
                                    <label for="stok_${targetId}" id="stoklabel_${targetId}">Stok</label>
                                </div>
                            </div>`;
                inputContainer.appendChild(newInput);
            } else {
                console.log("Kotak centang " + targetId + " telah diuncheck");
                const inputRemoveAll = document.getElementById(
                    "Inputan_" + targetId
                );
                inputRemoveAll.remove();
            }
        });
    });
});
