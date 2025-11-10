<?php

use app\models\FileImageReconcile;

$file = FileImageReconcile::find()
    ->where(['id_sap_reconcile' => $model->id_sap_reconcile])
    ->one();

?>
<div class="modal fade" id="exampleModal<?= $model->id_sap_reconcile ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Dokumen Pendukung</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <?php if ($file && $file->filecontent): ?>
                    <?php
                    $mimeType = $file->filetype; // Contoh: 'application/pdf' atau 'image/png'
                    $base64 = base64_encode($file->filecontent);
                    $dataUrl = "data:$mimeType;base64,$base64";
                    ?>

                    <?php if (strpos($mimeType, 'pdf') !== false): ?>
                        <!-- PDF Viewer -->
                        <embed src="<?= $dataUrl ?>" type="application/pdf"
                               width="100%" height="600px"
                               class="border rounded shadow-sm" />
                    <?php elseif (strpos($mimeType, 'image') !== false): ?>
                        <!-- Image Viewer -->
                        <img src="<?= $dataUrl ?>"
                             alt="Dokumen Pendukung"
                             class="img-fluid rounded shadow-sm"
                             style="max-width: 100%; height: auto;">
                    <?php else: ?>
                        <div class="alert alert-warning">
                            Format file tidak didukung untuk pratinjau.
                            <a href="<?= $dataUrl ?>" download class="btn btn-sm btn-primary ms-2">
                                Unduh File
                            </a>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="alert alert-secondary">Tidak ada dokumen untuk ditampilkan.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
