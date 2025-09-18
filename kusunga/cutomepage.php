<?php
    /* Template Name: Custom Homepage */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ulimomusic</title>
  <?php wp_head(); ?>
  <style>
    body {
      margin: 0;
      background: linear-gradient(180deg, #0f0f12 0%, #121217 40%, #151521 100%);
      color: #e9e9ee;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, 'Apple Color Emoji', 'Segoe UI Emoji';
      -webkit-font-smoothing: antialiased;
    }
    #app {
      max-width: 500px;
      margin: 0 auto;
      min-height: 100dvh;
      display: flex;
      flex-direction: column;
      position: relative;
    }
    header {
      position: sticky;
      top: 0;
      z-index: 20;
      background: linear-gradient(180deg, rgba(15,15,18,0.95), rgba(15,15,18,0.6) 85%, rgba(15,15,18,0));
      backdrop-filter: blur(6px);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 16px;
    }
    header > div {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    header .logo {
      width: 36px;
      height: 36px;
      border-radius: 12px;
      background: linear-gradient(135deg, #8b5cf6, #22d3ee);
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 6px 18px rgba(139,92,246,0.35);
    }
    header .logo span {
      font-weight: 700;
      font-size: 14px;
      color: #0b0b0e;
    }
    header .title {
      font-size: 12px;
      opacity: 0.7;
    }
    header .subtitle {
      font-size: 16px;
      font-weight: 700;
      letter-spacing: 0.3px;
    }
    header .buttons {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    header button[aria-label="Cast"] {
      border: 0;
      background: transparent;
      padding: 8px;
      border-radius: 12px;
      transition: transform .15s ease;
    }
    header button[aria-label="Notifications"] {
      border: 0;
      background: rgba(255,255,255,0.06);
      padding: 8px;
      border-radius: 12px;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,0.06);
    }
    .search {
      padding: 8px 16px 4px 16px;
    }
    .search label {
      display: block;
      position: relative;
    }
    .search input {
      width: 100%;
      padding: 14px 44px;
      border: 0;
      outline: 0;
      border-radius: 14px;
      background: rgba(255,255,255,0.06);
      color: #e9e9ee;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,0.07);
      font-size: 14px;
    }
    .search svg {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0.8;
    }
    .search button[aria-label="Voice"] {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      border: 0;
      background: transparent;
      padding: 8px;
      border-radius: 10px;
    }
    .chips {
      padding: 8px 0 0 8px;
      overflow: auto;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
    .chip {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      margin: 0 8px;
      padding: 10px 14px;
      border-radius: 999px;
      border: 0;
      color: #e9e9ee;
      background: rgba(255,255,255,0.08);
      box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08);
    }
    .chip.active {
      color: #0e0e13;
      background: linear-gradient(135deg, #22d3ee, #8b5cf6);
      box-shadow: 0 6px 16px rgba(34,211,238,0.25);
      font-weight: 700;
    }
    .hero {
      padding: 18px 16px 4px 16px;
    }
    .hero > div {
      position: relative;
      border-radius: 20px;
      overflow: hidden;
      background: radial-gradient(120% 150% at 0% 0%, rgba(139,92,246,0.45) 0%, rgba(34,211,238,0.28) 35%, rgba(21,21,33,0.8) 100%), url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat;
      min-height: 160px;
      display: flex;
      align-items: flex-end;
      box-shadow: 0 10px 30px rgba(0,0,0,.45);
    }
    .hero .content {
      padding: 16px;
      width: 100%;
      background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(10,10,14,.65) 45%, rgba(10,10,14,.95) 100%);
    }
    .hero .label {
      font-size: 12px;
      letter-spacing: 0.4px;
      opacity: 0.8;
    }
    .hero .title {
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 0.3px;
    }
    .hero .buttons {
      margin-top: 8px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .hero button {
      border: 0;
      padding: 10px 14px;
      border-radius: 12px;
      font-weight: 700;
    }
    .hero button.play {
      background: #e9e9ee;
      color: #0d0d12;
      font-weight: 800;
      box-shadow: 0 8px 20px rgba(233,233,238,.25);
    }
    .hero button.add {
      background: rgba(255,255,255,.1);
      color: #e9e9ee;
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.12);
    }
    .cards {
      padding: 10px 0 0 8px;
    }
    .cards > div {
      display: flex;
      align-items: stretch;
      gap: 12px;
      overflow: auto;
      padding: 6px 8px 16px 8px;
      -webkit-overflow-scrolling: touch;
    }
    .cards article {
      min-width: 150px;
      max-width: 160px;
      background: rgba(255,255,255,0.06);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 8px 24px rgba(0,0,0,.35);
    }
    .cards .image {
      aspect-ratio: 1/1;
    }
    .cards .image-1 {
      background: url('https://images.unsplash.com/photo-1483412033650-1015ddeb83d1?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .cards .image-2 {
      background: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .cards .image-3 {
      background: url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .cards .content {
      padding: 12px;
    }
    .cards .title {
      font-size: 14px;
      font-weight: 700;
    }
    .cards .subtitle {
      font-size: 12px;
      opacity: 0.75;
    }
    .made-for-you {
      padding: 0 16px 120px 16px;
    }
    .made-for-you .header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 8px 0 6px 0;
    }
    .made-for-you h2 {
      margin: 0;
      font-size: 16px;
      letter-spacing: 0.3px;
    }
    .made-for-you a {
      font-size: 12px;
      opacity: 0.75;
      color: #e9e9ee;
      text-decoration: none;
    }
    .made-for-you .item {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px;
      border-radius: 14px;
      background: rgba(255,255,255,0.05);
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.06);
      margin-bottom: 10px;
    }
    .made-for-you .image {
      width: 54px;
      height: 54px;
      border-radius: 12px;
    }
    .made-for-you .image-1 {
      background: url('https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .made-for-you .image-2 {
      background: url('https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .made-for-you .image-3 {
      background: url('https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    .made-for-you .content {
      flex: 1;
      min-width: 0;
    }
    .made-for-you .title-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
    }
    .made-for-you .title {
      font-weight: 700;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .made-for-you button[aria-label="More"] {
      border: 0;
      background: transparent;
      padding: 6px;
      border-radius: 8px;
    }
    .made-for-you .subtitle {
      font-size: 12px;
      opacity: 0.75;
    }
    .made-for-you .play-small {
      border: 0;
      padding: 10px;
      border-radius: 12px;
      background: linear-gradient(135deg, #22d3ee, #8b5cf6);
      box-shadow: 0 8px 20px rgba(34,211,238,.25);
    }
    #now-playing {
      position: fixed;
      left: 50%;
      transform: translateX(-50%);
      bottom: 76px;
      width: 100%;
      max-width: 500px;
      padding: 0 12px;
      z-index: 30;
    }
    #now-playing > div {
      background: linear-gradient(135deg, rgba(34,211,238,.18), rgba(139,92,246,.18));
      backdrop-filter: blur(8px);
      border-radius: 16px;
      box-shadow: 0 10px 28px rgba(0,0,0,.4), inset 0 0 0 1px rgba(255,255,255,.16);
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
    }
    #now-playing .image {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      background: url('https://images.unsplash.com/photo-1511512578047-dfb367046420?q=80&w=1200&auto=format&fit=crop') center/cover;
    }
    #now-playing .content {
      flex: 1;
      min-width: 0;
    }
    #now-playing .title {
      font-size: 14px;
      font-weight: 700;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    #now-playing .subtitle {
      font-size: 12px;
      opacity: 0.8;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    #now-playing button[aria-label="Like"] {
      border: 0;
      background: transparent;
      padding: 8px;
      border-radius: 10px;
    }
    #now-playing button[aria-label="Play/Pause"] {
      border: 0;
      padding: 10px 12px;
      border-radius: 12px;
      background: #e9e9ee;
      color: #0d0d12;
      font-weight: 800;
      box-shadow: 0 8px 20px rgba(233,233,238,.25);
    }
    nav {
      position: fixed;
      left: 50%;
      transform: translateX(-50%);
      bottom: 0;
      width: 100%;
      max-width: 500px;
      background: rgba(16,16,22,.96);
      backdrop-filter: blur(8px);
      box-shadow: 0 -8px 28px rgba(0,0,0,.5);
      border-top-left-radius: 18px;
      border-top-right-radius: 18px;
    }
    nav > div {
      display: flex;
      align-items: stretch;
      justify-content: space-around;
      gap: 4px;
      padding: 8px 8px 10px 8px;
    }
    nav a {
      flex: 1;
      text-align: center;
      text-decoration: none;
      color: #e9e9ee;
      padding: 8px 0;
      border-radius: 12px;
    }
    nav a.active {
      background: rgba(255,255,255,0.06);
      box-shadow: inset 0 0 0 1px rgba(255,255,255,.08);
    }
    nav .icon {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 4px;
      font-size: 11px;
    }
    nav .icon.inactive {
      opacity: 0.9;
    }
  </style>
</head>
<body>
    <?php wp_body_open(); ?>
  <!-- App Shell -->
  <div id="app">
    <!-- Top Bar -->
    <header>
      <div>
        <div class="logo">
          <span>UL</span>
        </div>
        <div>
          <div class="title">Ulimo music</div>
          <div class="subtitle">Free Streams</div>
        </div>
      </div>
      <div class="buttons">
        <button aria-label="Cast">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2h-5" stroke="#e9e9ee" stroke-width="1.5" stroke-linecap="round"/><path d="M2 17a5 5 0 0 1 5 5" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/><path d="M2 13a9 9 0 0 1 9 9" stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
        <button aria-label="Notifications">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 3a6 6 0 0 0-6 6v3.586l-1.293 1.293A1 1 0 0 0 5 16h14a1 1 0 0 0 .707-1.707L18 12.586V9a6 6 0 0 0-6-6Z" stroke="#e9e9ee" stroke-width="1.5" stroke-linecap="round"/><path d="M9 18a3 3 0 0 0 6 0" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
      </div>
    </header>

    <!-- Search -->
    <div class="search">
      <label for="search">
        <input id="search" type="search" placeholder="Search songs, artists, podcasts…" />
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="7" stroke="#e9e9ee" stroke-width="1.5"/><path d="M21 21l-3.5-3.5" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/></svg>
        <button aria-label="Voice">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="9" y="3" width="6" height="12" rx="3" stroke="#e9e9ee" stroke-width="1.5"/><path d="M5 12a7 7 0 1 0 14 0" stroke="#8b5cf6" stroke-width="1.5" stroke-linecap="round"/><path d="M12 19v3" stroke="#22d3ee" stroke-width="1.5" stroke-linecap="round"/></svg>
        </button>
      </label>
    </div>

    <!-- Chips -->
    <div class="chips">
      <button class="chip active">For You</button>
      <button class="chip">Trending</button>
      <button class="chip">Afrobeats</button>
      <button class="chip">Hip‑Hop</button>
      <button class="chip">Amapiano</button>
    </div>

    <!-- Hero Banner -->
    <section class="hero">
      <div>
        <div class="content">
          <div class="label">Weekly Mix</div>
          <div class="title">Mtima Phee saundikani</div>
          <div class="buttons">
            <button class="play" onclick="playFeatured()">Play</button>
            <button class="add">Add</button>
          </div>
        </div>
      </div>
    </section>

    <!-- Horizontal Cards -->
    <section class="cards">
      <div>
        <!-- Card 1 -->
        <article>
          <div class="image image-1"></div>
          <div class="content">
            <div class="title">Ex Elmcee</div>
            <div class="subtitle">Elmcee • 3 min</div>
          </div>
        </article>
        <!-- Card 2 -->
        <article>
          <div class="image image-2"></div>
          <div class="content">
            <div class="title">Darkroses</div>
            <div class="subtitle">Elmcee • 6 min</div>
          </div>
        </article>
        <!-- Card 3 -->
        <article>
          <div class="image image-3"></div>
          <div class="content">
            <div class="title">Far away</div>
            <div class="subtitle">Hip‑Hop • 1 hr 12</div>
          </div>
        </article>
      </div>
    </section>

    <!-- Made For You -->
    <section class="made-for-you">
      <div class="header">
        <h2>Made for you</h2>
        <a href="#">See all</a>
      </div>
      <!-- List Items -->
      <div>
        <!-- Item 1 -->
        <div class="item">
          <div class="image image-1"></div>
          <div class="content">
            <div class="title-row">
              <div class="title">Golden Hour</div>
              <button aria-label="More">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
              </button>
            </div>
            <div class="subtitle">Indie • 36 songs</div>
          </div>
          <button class="play-small">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#0d0d12" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
          </button>
        </div>
        <!-- Item 2 -->
        <div class="item">
          <div class="image image-2"></div>
          <div class="content">
            <div class="title-row">
              <div class="title">Code & Chill</div>
              <button aria-label="More">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
              </button>
            </div>
            <div class="subtitle">Lo‑Fi • 28 songs</div>
          </div>
          <button class="play-small">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#0d0d12" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
          </button>
        </div>
        <!-- Item 3 -->
        <div class="item">
          <div class="image image-3"></div>
          <div class="content">
            <div class="title-row">
              <div class="title">Morning Boost</div>
              <button aria-label="More">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><circle cx="5" cy="12" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="19" cy="12" r="2"/></svg>
              </button>
            </div>
            <div class="subtitle">Pop • 30 songs</div>
          </div>
          <button class="play-small">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="#0d0d12" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
          </button>
        </div>
      </div>
    </section>

    <!-- Now Playing (Docked) -->
    <div id="now-playing">
      <div>
        <div class="image"></div>
        <div class="content">
          <div class="title">Chizungu Remix</div>
          <div class="subtitle">Trinith ft Elmcee • Single</div>
        </div>
        <button id="likeBtn" aria-label="Like" onclick="toggleLike()">
          <svg id="likeIcon" width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12.001 20.727c-.31 0-.62-.094-.884-.282C8.25 18.62 3 14.66 3 9.5 3 7.015 5.015 5 7.5 5c1.54 0 3.04.81 3.9 2.085.86-1.275 2.36-2.085 3.9-2.085 2.485 0 4.5 2.015 4.5 4.5 0 5.16-5.25 9.12-8.117 10.945-.264.188-.574.282-.884.282Z" fill="#e9e9ee"/></svg>
        </button>
        <button id="playBtn" aria-label="Play/Pause" onclick="togglePlay()">
          <svg id="playIcon" width="16" height="16" viewBox="0 0 24 24" fill="#0d0d12" xmlns="http://www.w3.org/2000/svg"><path d="M8 5v14l11-7z"/></svg>
        </button>
      </div>
    </div>

    <!-- Tab Bar -->
    <nav>
      <div>
        <a href="#" class="active">
          <div class="icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><path d="M12 3 3 10h3v10h12V10h3L12 3z"/></svg>
            <span>Home</span>
          </div>
        </a>
        <a href="#">
          <div class="icon inactive">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="11" cy="11" r="7" stroke="#e9e9ee" stroke-width="1.5"/><path d="M21 21l-3.5-3.5" stroke="#e9e9ee" stroke-width="1.5" stroke-linecap="round"/></svg>
            <span>Search</span>
          </div>
        </a>
        <a href="#">
          <div class="icon inactive">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><path d="M4 5h16v3H4zM4 10h10v3H4zM4 15h16v3H4z"/></svg>
            <span>Library</span>
          </div>
        </a>
        <a href="#">
          <div class="icon inactive">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="#e9e9ee" xmlns="http://www.w3.org/2000/svg"><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm1 15h-2v-2h2Zm0-4h-2V7h2Z"/></svg>
            <span>Settings</span>
          </div>
        </a>
      </div>
    </nav>
  </div>

  <!-- Demo Player Logic (no external libs) -->
  <audio id="demoAudio" src="" preload="none"></audio>
  <?php 
  wp_footer(); ?>

  <script>
    const playIcon = document.getElementById('playIcon');
    const playBtn = document.getElementById('playBtn');
    const likeIcon = document.getElementById('likeIcon');
    let isPlaying = false;
    let isLiked = false;

    function togglePlay(){
      isPlaying = !isPlaying;
      if(isPlaying){
        playIcon.setAttribute('d','M6 5h4v14H6zm8 0h4v14h-4z');
      }else{
        playIcon.setAttribute('d','M8 5v14l11-7z');
      }
    }
    function toggleLike(){
      isLiked = !isLiked;
      likeIcon.querySelector('path').setAttribute('fill', isLiked ? '#ff5d87' : '#e9e9ee');
    }
    function playFeatured(){
      togglePlay();
      window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
    document.querySelectorAll('button, a').forEach(el=>{
      el.addEventListener('touchstart', ()=>{ el.style.transform='scale(.98)'; });
      el.addEventListener('touchend', ()=>{ el.style.transform='scale(1)'; });
      el.addEventListener('mousedown', ()=>{ el.style.transform='scale(.98)'; });
      el.addEventListener('mouseup', ()=>{ el.style.transform='scale(1)'; });
      el.addEventListener('mouseleave', ()=>{ el.style.transform='scale(1)'; });
    });
  </script>
</body>
</html>