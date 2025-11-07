<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

?>
<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= Url::base() ?>/user/updatepassworduser?id=<?= $id ?>" method="POST">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-shield-lock-fill"></i> Ubah Password</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card shadow-none border">
                        <div class="card-body">
                            <div class="card shadow-sm mb-3">
                                <div class="card-body">
                                    <label class="form-label">Password Lama</label>
                                    <div class="input-group">
                                        <input type="password" id="user-old-password-<?= $id ?>" class="form-control" name="User[oldPassword]" maxlength="255" value="<?= $password ?>" disabled>
                                        <button class="btn btn-outline-secondary rounded" type="button" onclick="togglePassword('user-old-password-<?= $id ?>', 'toggleOldPassword-<?= $id ?>')">
                                            <i class="bi bi-eye-fill" id="toggleOldPassword-<?= $id ?>"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group">
                                        <input type="password" id="user-new-password-<?= $id ?>" class="form-control" name="User[newPassword]" maxlength="255">
                                        <button class="btn btn-outline-secondary rounded" type="button" onclick="togglePassword('user-new-password-<?= $id ?>', 'toggleNewPassword-<?= $id ?>')">
                                            <i class="bi bi-eye-fill" id="toggleNewPassword-<?= $id ?>"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <div class="input-group">
                                        <input type="password" id="user-confirm-password-<?= $id ?>" class="form-control" name="User[confrimPassword]" maxlength="255">
                                        <button class="btn btn-outline-secondary rounded" type="button" onclick="togglePassword('user-confirm-password-<?= $id ?>', 'toggleConfirmPassword-<?= $id ?>')">
                                            <i class="bi bi-eye-fill" id="toggleConfirmPassword-<?= $id ?>"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function togglePassword(inputId, toggleId) {
                                    const passwordInput = document.getElementById(inputId);
                                    const toggleIcon = document.getElementById(toggleId);

                                    if (passwordInput.type === 'password') {
                                        passwordInput.type = 'text';
                                        toggleIcon.classList.remove('bi-eye-fill');
                                        toggleIcon.classList.add('bi-eye-slash-fill');
                                    } else {
                                        passwordInput.type = 'password';
                                        toggleIcon.classList.remove('bi-eye-slash-fill');
                                        toggleIcon.classList.add('bi-eye-fill');
                                    }
                                }
                            </script>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary rounded" value="Save Password">
                </div>
            </form>
        </div>
    </div>
</div>