let fotoTambah = 0;

document.getElementById("addPhotoBtn").addEventListener("click", function () {
    fotoTambah++;
    const photoInputs = document.getElementById("photoInputs");
    const newPhotoInput = document.createElement("div");
    newPhotoInput.classList.add("photo-input", "mb-2");
    newPhotoInput.id = `fototambah-${fotoTambah}`;
    newPhotoInput.innerHTML = `
        <div class="d-flex align-items-start">
            <div class="me-3">
                <img class="img-thumbnail" src="" alt="Foto Produk" style="width: 150px; height: 150px; object-fit: cover;">
                <span class="btn" onclick="removeTambahFoto('fototambah-${fotoTambah}')"><i class="fas fa-trash"></i></span>
            </div>
        </div>
        <div class="flex-grow-1">
            <input type="file" name="foto_produk[]" class="form-control userPhoto" accept=".jpg,.png,.jpeg,.webp">
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

function removeTambahFoto(id) {
    document.getElementById(id).remove();
}

// function beriTitik(input) {
//     // Menghilangkan selain angka yang ada
//     input.value = input.value.replace(/[^0-9]/g, "");
//     // Menambahkan titik setiap tiga digit
//     input.value = input.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
// }

// document.addEventListener("DOMContentLoaded", function () {
//     var hargaInput = document.getElementById("hargaInput");
//     var beratProduk = document.getElementById("beratProduk");

//     // Format nilai input saat halaman dimuat
//     beriTitik(hargaInput);
//     beriTitik(beratProduk);

//     // Tambahkan event listener untuk memformat nilai saat diinput
//     hargaInput.addEventListener("input", function () {
//         beriTitik(this);
//     });

//     beratProduk.addEventListener("input", function () {
//         beriTitik(this);
//     });

//     // Hapus titik sebelum form disubmit
//     document
//         .getElementById("formproduk")
//         .addEventListener("submit", function (e) {
//             hargaInput.value = hargaInput.value.replace(/\./g, "");
//             beratProduk.value = beratProduk.value.replace(/\./g, "");
//         });
// });

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

let additionalCount = 0;

document.getElementById("addAdditional").addEventListener("click", function () {
    additionalCount++;

    const inputContainer = document.getElementById("additionalInputs");
    const newInput = document.createElement("div");
    newInput.classList.add("additional-input", "mb-3");
    newInput.id = `additional-${additionalCount}`;
    newInput.innerHTML = `
        <div class="fw-bolder fs-5">Additional <span class="btn" onclick="removeAdditionalInput('additional-${additionalCount}')"><i class="fas fa-trash"></i></span></div>
            <div class="form-group">
                <label for="additionalName-${additionalCount}">Nama Additional</label>
                <input type="text" class="form-control" id="additionalName-${additionalCount}" name="additional[]" required>
            </div>
            <div class="form-group">
                <label for="additionalHarga_${additionalCount}">Harga Additional</label>
                <input type="number" pattern="[0-9]*" class="form-control" id="additionalPrice-${additionalCount}" name="additional[]">
                <small id="helpberat" class="mb-3" style="opacity: 75%;">Masukan Tanpa
                                        Titik
                                    </small>
                </div>`;
    inputContainer.appendChild(newInput);
});

function removeAdditionalInput(id) {
    document.getElementById(id).remove();
}

// document.addEventListener("DOMContentLoaded", function () {
//     // Mendapatkan semua kotak centang
//     var checkboxes = document.querySelectorAll(".ukuran-checkbox");

//     // Menambahkan event listener untuk setiap kotak centang
//     checkboxes.forEach(function (checkbox) {
//         checkbox.addEventListener("change", function () {
//             const targetId = this.dataset.target;
//             const inputContainer = document.getElementById("additionalInputs");

//             if (this.checked) {
//                 console.log("Kotak centang " + targetId + " telah dicentang");
//                 const newInput = document.createElement("div");
//                 newInput.id = "Inputan_" + targetId; // Setel id agar dapat dihapus nantinya
//                 newInput.classList.add("mb-3", "ukuran-input");
//                 newInput.innerHTML = `
//                             <div class="form-outline">
//                                 <label class="form-label" id="ukuranlabel_${targetId}">Stok Ukuran ${targetId}</label>
//                             </div>
//                            <div class="input-group mb-3">
//                                 <div class="form-floating">
//                                     <input type="text" id="stok_${targetId}" class="form-control" name="stok_${targetId}" pattern="[0-9]*" placeholder="Stok" required>
//                                     <label for="stok_${targetId}" id="stoklabel_${targetId}">Stok</label>
//                                 </div>
//                             </div>`;
//                 inputContainer.appendChild(newInput);
//             } else {
//                 console.log("Kotak centang " + targetId + " telah diuncheck");
//                 const inputRemoveAll = document.getElementById(
//                     "Inputan_" + targetId
//                 );
//                 inputRemoveAll.remove();
//             }
//         });
//     });
// });
