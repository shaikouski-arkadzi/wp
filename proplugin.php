<?php
// Регистрируем шорткод для вывода формы загрузки с дополнительными полями
function file_upload_form_shortcode($atts) {
  // Определяем значения по умолчанию
  $atts = shortcode_atts(
      array(
          'action' => 'handle_file_upload_and_email',
          'placeholder' => 'Введите ваш email',
          'additional_fields' => '' // Дополнительные поля в формате JSON
      ),
      $atts,
      'file_upload_form'
  );

  // Декодируем дополнительные поля из JSON
  $additional_fields = json_decode($atts['additional_fields'], true);

  ob_start();
  ?>
  <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" enctype="multipart/form-data">
      <input type="file" name="uploadedFile" accept=".jpg, .jpeg, .png, .pdf" required>
      <br><br>
      <input type="text" name="recipient_email" placeholder="<?php echo esc_attr($atts['placeholder']); ?>" required>
      <br><br>

      <!-- Вывод дополнительных полей -->
      <?php if (!empty($additional_fields) && is_array($additional_fields)): ?>
          <?php foreach ($additional_fields as $field): ?>
              <label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label>
              <input type="<?php echo esc_attr($field['type']); ?>" name="<?php echo esc_attr($field['name']); ?>" id="<?php echo esc_attr($field['name']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
              <br><br>
          <?php endforeach; ?>
      <?php endif; ?>

      <input type="submit" value="Отправить файл">
      <input type="hidden" name="action" value="<?php echo esc_attr($atts['action']); ?>">
  </form>
  <?php
  return ob_get_clean();
}
add_shortcode('file_upload_form', 'file_upload_form_shortcode');

function handle_file_upload_and_email() {
  if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] == 0) {
      $recipient_email = sanitize_email($_POST['recipient_email']);
      $uploadDir = wp_upload_dir();  // Получаем папку для загрузки файлов в WordPress
      $uploadFile = $uploadDir['path'] . '/' . basename($_FILES['uploadedFile']['name']);

      // Проверяем тип файла и перемещаем его
      $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
      if (in_array($_FILES['uploadedFile']['type'], $allowedTypes)) {
          if (move_uploaded_file($_FILES['uploadedFile']['tmp_name'], $uploadFile)) {
              // Подготовка данных для почтового сообщения
              $to = $recipient_email;
              $subject = 'Файл загружен';
              $message = 'Вы получили новый файл. Пожалуйста, найдите его во вложении.';

              // Добавляем информацию о дополнительных полях
              $message .= '<br><br><strong>Дополнительные данные:</strong><br>';
              foreach ($_POST as $key => $value) {
                  if ($key !== 'uploadedFile' && $key !== 'recipient_email' && $key !== 'action') {
                      $message .= '<strong>' . esc_html($key) . ':</strong> ' . esc_html($value) . '<br>';
                  }
              }

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


# [file_upload_form action="handle_file_upload_and_email" placeholder="Введите ваш email" additional_fields='[{"name":"phone", "label":"Телефон", "type":"text", "placeholder":"Введите ваш телефон"}, {"name":"message", "label":"Сообщение", "type":"textarea", "placeholder":"Введите ваше сообщение"}]']
