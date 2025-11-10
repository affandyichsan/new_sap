<!-- Modal Global -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">Dokumen Pendukung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div id="fileContent" class="p-3">Memuat data...</div>
            </div>
        </div>
    </div>
</div>

<?php
$apiUrl = \yii\helpers\Url::to(['/rest/file-image/view-reconcile']);
$js = <<<JS
$('.file-item').on('click', function() {
    var id = $(this).data('id');
    $('#fileContent').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Memuat...</p></div>');
    
    $.get('{$apiUrl}', { id: id })
        .done(function(res) {
            if (res.status === 'success') {
                var content = '';
                if (res.filetype.includes('pdf')) {
                    content = '<embed src="'+res.dataUrl+'" type="application/pdf" width="100%" height="600px" class="border rounded" />';
                } else if (res.filetype.includes('image')) {
                    content = '<img src="'+res.dataUrl+'" class="img-fluid rounded" style="max-width:100%; height:auto;">';
                } else {
                    content = '<div class="alert alert-warning">Format file tidak didukung. <a href="'+res.dataUrl+'" download class="btn btn-sm btn-primary ms-2">Unduh File</a></div>';
                }
                $('#fileContent').html(content);
            } else {
                $('#fileContent').html('<div class="alert alert-danger">'+res.message+'</div>');
            }
        })
        .fail(function() {
            $('#fileContent').html('<div class="alert alert-danger">Gagal memuat data dari server.</div>');
        });
});
JS;
$this->registerJs($js);
?>