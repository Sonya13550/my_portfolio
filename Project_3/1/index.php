<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sonya Edit — Відеомонтаж</title>

 
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&amp;display=swap" rel="stylesheet">

 
  <script src="https://cdn.tailwindcss.com"></script>

 <style>
  body { font-family: 'Poppins', sans-serif; }

  html {
    scroll-behavior: smooth;
  }
</style>
</head>

<body class="bg-gradient-to-br from-[#0f0c29] via-[#302b63] to-[#24243e] text-white">


<section class="min-h-screen flex items-center justify-center px-6 relative overflow-hidden">

  
  <div class="absolute w-[500px] h-[500px] bg-pink-500/30 rounded-full blur-3xl -top-40 -left-40"></div>
  <div class="absolute w-[400px] h-[400px] bg-purple-500/30 rounded-full blur-3xl bottom-0 right-0"></div>

  <div class="relative max-w-6xl w-full">

    <div class="px-6 py-12 flex flex-col md:flex-row items-center gap-10">

    
      <div class="text-center md:text-left">
        <h1 class="text-3xl sm:text-4xl md:text-6xl font-bold mb-4">
          Привіт, я <span class="text-pink-400">Софія</span> 👋<br>
          Відеомонтажер
        </h1>

        <p class="text-gray-300 text-base sm:text-lg mb-6 max-w-md mx-auto md:mx-0">
          Створю стильні та трендові відео для TikTok, Reels та YouTube 🚀
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
          <a href="#contact" class="bg-pink-500 hover:bg-pink-600 px-6 py-3 rounded-xl font-semibold shadow-lg transition text-center">
            Замовити монтаж
          </a>

          <a href="#portfolio"
   class="relative overflow-hidden px-6 py-3 rounded-xl font-semibold border border-white/30 text-center group transition">

  <span class="relative z-10 group-hover:text-black transition">
    Переглянути портфоліо
  </span>

  
  <span class="absolute inset-0 bg-pink-500 scale-x-0 group-hover:scale-x-100 origin-left transition-transform"></span>
</a>
        </div>
      </div>

    
      <div class="relative w-full max-w-xs md:max-w-sm">
        <div class="absolute inset-0 bg-gradient-to-tr from-pink-500/40 to-purple-500/40 blur-2xl rounded-3xl"></div>
        <img src="IMG_20260106_165031_284.jpg" class="relative rounded-3xl shadow-2xl border border-white/10 w-full">
      </div>

    </div>
  </div>
</section>


<section class="py-24 bg-black/40 backdrop-blur">
  <div class="max-w-4xl mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold mb-6">Про мене</h2>
    <p class="text-gray-300 text-lg">
      Я — відеомонтажер, який допомагає блогерам і бізнесу створювати якісний контент.
      Роблю монтаж зі смаком, додаю ефекти та субтитри ❤️
    </p>
  </div>
</section>


<section id="portfolio" class="py-24">
  <div class="max-w-[1550px] mx-auto px-4">

    <h2 class="text-4xl font-bold text-center mb-12">Портфоліо</h2>

    <div class="grid md:grid-cols-3 gap-6">

    
      <div class="video-card group relative overflow-hidden rounded-3xl border border-white/10 cursor-pointer"
           data-video="відео зі звуком.mp4">

        <p class="text-sm text-gray-300 text-center mb-2">
          Відео з музикою, озвучкою, текстом і переходами
        </p>

        <video src="відео зі звуком.mp4"
               poster="preview1.jpg"
               class="w-full h-[220px] sm:h-[320px] md:h-[600px] object-cover rounded-2xl"
               autoplay
               muted
               loop
               playsinline
               preload="auto">
        </video>

      </div>

    
      <div class="video-card group relative overflow-hidden rounded-3xl border border-white/10 cursor-pointer"
           data-video="відео без слів.mp4">

        <p class="text-sm text-gray-300 text-center mb-2">
          Відео з музикою і переходами
        </p>

        <video src="відео без слів.mp4"
               poster="preview2.jpg"
               class="w-full h-[220px] sm:h-[320px] md:h-[600px] object-cover rounded-2xl"
               autoplay
               muted
               loop
               playsinline
               preload="auto">
        </video>

      </div>

     
      <div class="video-card group relative overflow-hidden rounded-3xl border border-white/10 cursor-pointer"
           data-video="2025-09-07-082401900.mp4">

        <p class="text-sm text-gray-300 text-center mb-2">
          Відео з музикою, текстом і фотографіями
        </p>

        <video src="2025-09-07-082401900.mp4"
               poster="preview3.jpg"
               class="w-full h-[220px] sm:h-[320px] md:h-[600px] object-cover rounded-2xl"
               autoplay
               muted
               loop
               playsinline
               preload="auto">
        </video>

      </div>

    </div>
  </div>
</section>


<div id="videoLightbox" class="fixed inset-0 bg-black/90 flex items-center justify-center hidden z-50">
  <button id="closeLightbox" class="absolute top-5 right-5 text-white text-3xl">×</button>
  <video id="lightboxVideo" class="max-w-[90%] max-h-[90%]" controls></video>
</div>


<section class="py-24 bg-black/40 backdrop-blur">
  <div class="max-w-6xl mx-auto px-6">
    <h2 class="text-4xl font-bold text-center mb-14">Послуги</h2>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">

      <div class="bg-white/5 p-6 rounded-2xl">🎬 Монтаж відео</div>
      <div class="bg-white/5 p-6 rounded-2xl">✨ Ефекти</div>
      <div class="bg-white/5 p-6 rounded-2xl">💬 Субтитри</div>
      <div class="bg-white/5 p-6 rounded-2xl">🎵 Музика</div>
      <div class="bg-white/5 p-6 rounded-2xl">🎙 Звук</div>
      <div class="bg-white/5 p-6 rounded-2xl">📱 Адаптація</div>

    </div>
  </div>
</section>


<section class="px-6 py-12">

  <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-6 leading-snug">
    Для монтажу відео<br class="sm:hidden">
    напишіть деталі:
  </h2>

  <ul class="text-base sm:text-lg space-y-4 max-w-2xl mx-auto">
    
    <li>1. Мета відео (реклама, блог, TikTok, YouTube тощо)</li>

    <li>
      2. Який монтаж потрібен:
      <ul class="ml-5 mt-2 list-disc space-y-1 text-sm sm:text-base">
        <li>простий (текст + музика)</li>
        <li>складний (ефекти, переходи, обробка голосу тощо)</li>
      </ul>
    </li>

    <li>3. Тривалість відео (хвилина чи більше)</li>
    <li>4. Формат (вертикальне / горизонтальне)</li>
    <li>5. Приклади відео (референси)</li>
    <li>6. Чи потрібні субтитри / текст</li>
    <li>7. Музика (ваша чи додати на свій смак)</li>
    <li>8. Термін виконання</li>

  </ul>

</section>

<section id="contact" class="py-10">
  <div class="max-w-xl mx-auto px-6 text-center">

    <h2 class="text-2xl sm:text-3xl font-bold mb-3">
      Контакти
    </h2>

    <p class="text-gray-300 mb-4 text-sm sm:text-base">
      Напишіть мені в Telegram для обговорення монтажу ✨
    </p>

    <a href="https://t.me/s_0_N_7_a"
       target="_blank"
       class="inline-block bg-pink-500 hover:bg-pink-600 px-6 py-2.5 rounded-xl font-semibold transition shadow-md">
      Написати в Telegram
    </a>
  </div>
</section>


<section class="py-16">
<div class="max-w-7xl mx-auto px-8">

<div class="grid md:grid-cols-2 gap-10 items-start">


<div>

<h2 class="text-3xl font-bold mb-8">Коментарі</h2>

<form id="commentForm" class="max-w-md space-y-4 mb-10">

<input
type="text"
name="author"
placeholder="Ваше ім’я"
required
class="w-full p-3 rounded-xl bg-white/5 border border-white/10 text-sm"
>

<textarea
name="comment_text"
placeholder="Ваш коментар"
rows="4"
required
class="w-full p-3 rounded-xl bg-white/5 border border-white/10 text-sm"
></textarea>

<button
type="submit"
class="px-5 py-2 rounded-xl bg-pink-500 hover:bg-pink-600 transition text-sm font-medium"
>
Надіслати
</button>

</form>

<div id="comments" class="pl-6 mt-10 max-w-md"></div>

</div>



<div class="bg-white/5 p-8 rounded-3xl border border-white/10 backdrop-blur-md">

<h3 class="text-2xl font-semibold mb-6">
Чому клієнти обирають мене
</h3>

<div class="space-y-5 text-gray-300">

<div>
<h4 class="font-semibold text-white mb-1">
🎬 Креативний монтаж
</h4>
<p>Динамічні переходи, стильна подача та сучасний ритм.</p>
</div>

<div>
<h4 class="font-semibold text-white mb-1">
⚡ Швидке виконання
</h4>
<p>Дотримуюсь дедлайнів та швидко вношу правки.</p>
</div>

<div>
<h4 class="font-semibold text-white mb-1">
💬 Комунікація
</h4>
<p>Завжди на зв’язку під час роботи над проєктом.</p>
</div>

<div>
<h4 class="font-semibold text-white mb-1">
✨ Індивідуальний стиль
</h4>
<p>Кожне відео адаптую під ваш бренд та ідею.</p>
</div>

</div>

</div>

</div>
</div>
</section>


<script>
const form = document.getElementById('commentForm');
const commentsBlock = document.getElementById('comments');

function loadComments() {
  fetch('commet.php')
  .then(res => res.text())
  .then(data => {
    commentsBlock.innerHTML = data;
  });
}

form.addEventListener('submit', function(e){
e.preventDefault();

const formData = new FormData(form);

fetch('commet.php',{
method:'POST',
body: formData
})
.then(res=>res.text())
.then(()=>{
form.reset();
loadComments();
});
});

loadComments();
</script>
