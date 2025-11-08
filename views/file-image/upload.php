<?php
use yii\helpers\Url;
use yii\helpers\Html;

// ambil CSRF token Yii2
$csrfToken = Yii::$app->request->csrfToken;
?>

<style>
    * { box-sizing: border-box; }
    :root {
        --clr-white: #fff;
        --clr-light-blue: #abcaff;
        --clr-blue: #3f86ff;
        --clr-light-gray: #c4c3c4;
    }
    body {
        display: flex; justify-content: center; align-items: center;
        height: 100vh; background: #f5f8ff; font-family: sans-serif;
    }
    .upload-area {
        width: 100%; max-width: 25rem;
        background: var(--clr-white);
        border: 2px solid var(--clr-light-blue);
        border-radius: 24px;
        box-shadow: 0 10px 60px rgb(218, 229, 255);
        text-align: center; padding: 2rem 1.875rem 3rem;
    }
    .upload-area__drop-zoon {
        border: 2px dashed var(--clr-light-blue);
        border-radius: 15px; padding: 2rem;
        margin-top: 2rem; cursor: pointer;
        transition: border-color 300ms;
    }
    .upload-area__drop-zoon:hover { border-color: var(--clr-blue); }
    .drop-zoon__icon { font-size: 3.75rem; color: var(--clr-blue); }
    .drop-zoon__paragraph { color: var(--clr-light-gray); }
    .drop-zoon__file-input { display: none; }
    .drop-zoon__preview-image {
        width: 100%; display: none; border-radius: 10px; margin-top: 10px;
    }
    .uploaded-file__counter { font-weight: bold; margin-top: 10px; color: var(--clr-blue); }
</style>

<div id="uploadArea" class="upload-area">
    <h1>Upload your file</h1>
    <p>File should be an image (jpg, png, gif, svg)</p>

    <div id="dropZoon" class="upload-area__drop-zoon drop-zoon">
        <div class="drop-zoon__icon">📁</div>
        <p class="drop-zoon__paragraph">Drop your file here or click to browse</p>

        <!-- Input file dengan nama sesuai controller -->
        <input type="file" id="fileInput" name="file" class="drop-zoon__file-input" accept="image/*">

        <!-- Preview -->
        <img src="" alt="Preview" id="previewImage" class="drop-zoon__preview-image">
        <div id="uploadProgress" class="uploaded-file__counter">0%</div>
    </div>
</div>

<script>
const dropZoon       = document.getElementById("dropZoon");
const fileInput      = document.getElementById("fileInput");
const previewImage   = document.getElementById("previewImage");
const uploadProgress = document.getElementById("uploadProgress");

dropZoon.addEventListener("click", () => fileInput.click());

dropZoon.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropZoon.style.borderColor = "#3f86ff";
});
dropZoon.addEventListener("dragleave", () => {
    dropZoon.style.borderColor = "#abcaff";
});
dropZoon.addEventListener("drop", (e) => {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    handleFile(file);
});

fileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    handleFile(file);
});

function handleFile(file) {
    if (!file) return;

    const allowed = ["image/jpeg", "image/png", "image/gif", "image/svg+xml"];
    if (!allowed.includes(file.type)) {
        alert("Please upload an image file (jpg, png, gif, svg).");
        return;
    }
    if (file.size > 2 * 1024 * 1024) {
        alert("File size must be less than 2MB.");
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        previewImage.src = e.target.result;
        previewImage.style.display = "block";
    };
    reader.readAsDataURL(file);

    uploadFile(file);
}

function uploadFile(file) {
    const formData = new FormData();
    formData.append("file", file);
    formData.append("_csrf", "<?= $csrfToken ?>"); // penting untuk keamanan Yii2

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "<?= Url::to(['/rest/file-image/update-profile-image']) ?>", true);

    xhr.upload.addEventListener("progress", (e) => {
        if (e.lengthComputable) {
            const percent = Math.round((e.loaded / e.total) * 100);
            uploadProgress.innerText = percent + "%";
        }
    });

    xhr.onload = () => {
        if (xhr.status === 200) {
            let res;
            try {
                res = JSON.parse(xhr.responseText);
            } catch (error) {
                uploadProgress.innerText = "❌ Response tidak valid dari server";
                return;
            }

            if (res.success) {
                uploadProgress.innerText = "✅ " + res.message;
            } else {
                uploadProgress.innerText = "❌ " + (res.message || "Upload gagal");
            }
        } else {
            uploadProgress.innerText = "❌ Server error (" + xhr.status + ")";
        }
    };

    xhr.onerror = () => {
        uploadProgress.innerText = "❌ Gagal menghubungi server";
    };

    xhr.send(formData);
}
</script>
