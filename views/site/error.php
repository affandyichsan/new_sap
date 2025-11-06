<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>

<div class="site-error">
    <?php

    $errorMessage = $exception->getMessage();
    $statusCode = $exception->statusCode;
    switch ($statusCode) {
        case 400:
            echo $this->render('../error/400', [
                'message' => nl2br(Html::encode($message)),
                'title'     => Html::encode($this->title)
            ]);
            break;

        case 401:
            echo $this->render('../error/401', [
                'message' => nl2br(Html::encode($message)),
                'title'     => Html::encode($this->title)
            ]);
            break;

        case 403:
            echo $this->render('../error/403', [
                'message' => nl2br(Html::encode($message)),
                'title'     => Html::encode($this->title)
            ]);
            break;

        case 404:
            echo $this->render('../error/404', [
                'message' => nl2br(Html::encode($message)),
                'title'     => Html::encode($this->title)
            ]);
            break;

        case 405:
            echo $this->render('../error/405', [
                'message' => nl2br(Html::encode($message)),
                'title'     => Html::encode($this->title)
            ]);
            break;

        case 408:
            $title = 'Permintaan Timeout';
            $message = 'Server memerlukan waktu terlalu lama untuk merespons.';
            $icon = '⏳';
            $type = 'secondary';
            break;

        case 429:
            $title = 'Terlalu Banyak Permintaan';
            $message = 'Anda telah mengirim terlalu banyak permintaan dalam waktu singkat.';
            $icon = '⚠️';
            $type = 'warning';
            break;

        case 500:
            $title = 'Kesalahan Internal Server';
            $message = 'Terjadi kesalahan pada server. Tim teknis kami akan menanganinya.';
            $icon = '💥';
            $type = 'danger';
            break;

        case 502:
            $title = 'Bad Gateway';
            $message = 'Server menerima respons yang tidak valid dari server lain.';
            $icon = '🌐';
            $type = 'danger';
            break;

        case 503:
            $title = 'Layanan Tidak Tersedia';
            $message = 'Server sedang sibuk atau dalam perawatan. Silakan coba lagi nanti.';
            $icon = '🛠️';
            $type = 'secondary';
            break;

        case 504:
            $title = 'Gateway Timeout';
            $message = 'Server tidak merespons tepat waktu.';
            $icon = '⏰';
            $type = 'secondary';
            break;

        default:
            $title = 'Kesalahan Sistem';
            $message = 'Terjadi kesalahan yang tidak diketahui. Silakan coba beberapa saat lagi.';
            $icon = '❗';
            $type = 'secondary';
            break;
    }
    ?>
</div>