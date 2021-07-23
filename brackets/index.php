<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Brackets</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
  <section class="validation">
      <div class="container">

          <div class="validation__inner">
              <div class="validation__title">Провера валидности скобок</div>

              <form class="validation__form">
                  <input class="validation__input" placeholder="Введите выражение" type="text" id="expression" name="expression" aria-label="validation-form" >
                  <button class="validation__button glare" id="send-btn" type="button">Проверка</button>
              </form>
              <table id="validation__table">
                    <tr>
                        <td>Выражение</td>
                        <td>Результат</td>
                    </tr>
              </table>

          </div>
      </div>

  </section>
  <script src="JS/app.js"></script>
</body>
</html>