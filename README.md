```
<?php
/*
Plugin Name: File Upload and Email Plugin
Description: Плагин для загрузки файлов и отправки их на электронную почту.
Version: 1.0
Author: Ваше Имя
*/

// Регистрируем шорткод для вывода формы загрузки
function file_upload_form_shortcode() {
    ob_start();
    ?>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="uploadedFile" accept=".jpg, .jpeg, .png, .pdf" required>
        <br><br>
        <input type="text" name="recipient_email" placeholder="Введите ваш email" required>
        <br><br>
        <input type="submit" value="Отправить файл">
        <input type="hidden" name="action" value="handle_file_upload_and_email">
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('file_upload_form', 'file_upload_form_shortcode');

// Обработчик для загрузки файлов и отправки их по почте
function handle_file_upload_and_email() {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == 0) {
        $recipient_email = sanitize_email($_POST['recipient_email']);
        $uploadDir = wp_upload_dir();  // Получаем папку для загрузки файлов в WordPress
        $uploadFile = $uploadDir['path'] . '/' . basename($_FILES['uploadedFile']['name']);

        // Проверяем тип файла и перемещаем его
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        if (in_array($_FILES['uploadedFile']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $uploadFile)) {
                // Отправляем файл по почте
                $to = $recipient_email;
                $subject = 'Файл загружен';
                $message = 'Вы получили новый файл. Пожалуйста, найдите его во вложении.';
                $headers = array('Content-Type: text/html; charset=UTF-8');
                
                $attachments = array($uploadFile);
                
                wp_mail($to, $subject, $message, $headers, $attachments);

                // Удаляем файл после отправки
                unlink($uploadFile);

                wp_redirect(home_url() . '?upload_success=1');
                exit;
            } else {
                wp_redirect(home_url() . '?upload_error=1');
                exit;
            }
        } else {
            wp_redirect(home_url() . '?invalid_file_type=1');
            exit;
        }
    } else {
        wp_redirect(home_url() . '?upload_error=1');
        exit;
    }
}
add_action('admin_post_handle_file_upload_and_email', 'handle_file_upload_and_email');
add_action('admin_post_nopriv_handle_file_upload_and_email', 'handle_file_upload_and_email');
```
[file_upload_form]
