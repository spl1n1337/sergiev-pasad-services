<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $name = $_POST["client-name"];
    $phone = $_POST["client-phone"];
    $message = isset($_POST["message"]) ? $_POST["message"] : "";
  
    // Получаем url адрес хостинга и создаем переменную from со значением from@URL
    $from = "form@" . $_SERVER['HTTP_HOST'];
  
    // Формируем сообщение
    $messageBody = "Телефон: " . $phone . "\n\n" . "Имя: " . $name;
    
    // Добавляем необязательное поле, если оно было заполнено
    if (!empty($message)) {
      $messageBody .= "\n\n" . "Сообщение: " . $message;
    }
  
    // Отправляем сообщение на указанный email-адрес
    $to = "panov1337.lp@gmail.com";
  
    // Присваиваем значение заголовку письма
    $subject = "Запрос на вызов курьера";
  
    // Помещаем в заголовок переменную from@URL
    $headers = "From: $from";
  
    if (mail($to, $subject, $messageBody, $headers)) {
      // Если сообщение отправлено успешно, возвращаем успешный статус
      $response = array("status" => "success", "message" => "Ваш запрос на вызов курьера успешно отправлен");
      echo json_encode($response);
    } else {
      // Если произошла ошибка при отправке сообщения, возвращаем сообщение об ошибке
      $response = array("status" => "error", "message" => "Ошибка при отправке сообщения. Попробуйте еще раз позже");
      echo json_encode($response);
    }
  }
  
?>