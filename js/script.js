window.addEventListener('DOMContentLoaded', () => {
  const menuIcon = document.querySelector('.menu__mobile'),
        headerBot = document.querySelector('.header__bot');


  menuIcon.addEventListener('click', () => {
      menuIcon.classList.toggle('mob__active');
      headerBot.classList.toggle('header__active');
  });


  const form = document.querySelector('form'),
        thankyou = document.querySelector('.thankyou');

  form.addEventListener('submit', async (event) => {
      event.preventDefault();
      const phoneInput = form.querySelector('[name="client-phone"]');
      const phoneRegex = /^((\+7|7|8)+([0-9]){10})$/;
      if(!phoneRegex.test(phoneInput.value)){
          alert("Пожалуйста, введите корректный телефонный номер РФ");
          return;
      }

  try {
      const response = await fetch("mail.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams(new FormData(form)).toString(),
      });
      const data = await response.json();
      
      if (data.status === "success") {
        thankyou.style.display = "block";
        console.log(data.status);
        setTimeout(() => {
          thankyou.style.display = "none";
          form.reset();
        }, 2000);
      } else {
        alert(data.message);
      }
    } catch (error) {
      console.error(error);
      alert("Ошибка при отправке формы");
    }
  });
});