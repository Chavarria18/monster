
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Monster Battle</title>
<style>
  @import url('https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&family=IM+Fell+English:ital@0;1&display=swap');

  :root {
    --parchment-base: #d9c9a3;
    --parchment-dark: #b89f74;
    --parchment-stain: #6b4a2f;
    --ink: #2b1c12;
    --ink-soft: #4a3626;
    --gold: #7a5c2e;
  }

  * { box-sizing: border-box; }

  html, body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    background-color: var(--parchment-base);
    font-family: 'IM Fell English', Georgia, 'Times New Roman', serif;
    color: var(--ink);
  }

  body {
    position: relative;
    display: flex;
    justify-content: center;
    padding: 40px 20px;
    overflow-x: hidden;

    /* layered radial gradients to fake aged parchment mottling */
    background-image:
      radial-gradient(ellipse at 8% 12%, rgba(107,74,47,0.35) 0%, transparent 22%),
      radial-gradient(ellipse at 92% 8%, rgba(107,74,47,0.28) 0%, transparent 20%),
      radial-gradient(ellipse at 85% 88%, rgba(107,74,47,0.32) 0%, transparent 24%),
      radial-gradient(ellipse at 15% 92%, rgba(107,74,47,0.30) 0%, transparent 22%),
      radial-gradient(ellipse at 50% 50%, rgba(184,159,116,0.4) 0%, transparent 60%),
      repeating-linear-gradient(0deg, rgba(0,0,0,0.015) 0px, rgba(0,0,0,0.015) 1px, transparent 1px, transparent 3px),
      repeating-linear-gradient(90deg, rgba(0,0,0,0.01) 0px, rgba(0,0,0,0.01) 1px, transparent 1px, transparent 3px),
      linear-gradient(135deg, #e2d3ab 0%, #cdb586 45%, #d9c9a3 55%, #c2a878 100%);
    background-blend-mode: multiply, multiply, multiply, multiply, multiply, normal, normal, normal;
  }

  /* subtle vignette darkening edges like an old sheet of paper */
  body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    background: radial-gradient(ellipse at center, transparent 55%, rgba(43,28,18,0.35) 100%);
    z-index: 0;
  }

  .sheet {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 720px;
    padding: 50px 40px 70px;
    border: 2px solid rgba(43,28,18,0.5);
    outline: 1px solid rgba(43,28,18,0.2);
    outline-offset: -8px;
    box-shadow: 0 0 40px rgba(43,28,18,0.4), inset 0 0 60px rgba(107,74,47,0.25);
    background: transparent;
  }

  /* ink stains scattered on the page */
  .stain {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(43,28,18,0.55) 0%, rgba(43,28,18,0.25) 40%, transparent 72%);
    filter: blur(1px);
    pointer-events: none;
  }
  .stain.s1 { width: 60px; height: 60px; top: 90px; left: -20px; }
  .stain.s2 { width: 18px; height: 18px; top: 130px; left: 30px; }
  .stain.s3 { width: 34px; height: 34px; bottom: 60px; right: -10px; }
  .stain.s4 { width: 14px; height: 14px; bottom: 100px; right: 45px; }

  /* floral / vine corner ornaments */
  .corner {
    position: absolute;
    width: 110px;
    height: 110px;
    opacity: 0.85;
    z-index: 2;
    pointer-events: none;
  }
  .corner svg { width: 100%; height: 100%; }
  .corner path, .corner circle, .corner ellipse {
    stroke: var(--ink-soft);
    fill: none;
    stroke-width: 1.4;
  }
  .corner .bloom { fill: var(--ink-soft); opacity: 0.9; stroke: none; }

  .corner.tl { top: -6px; left: -6px; }
  .corner.tr { top: -6px; right: -6px; transform: scaleX(-1); }
  .corner.bl { bottom: -6px; left: -6px; transform: scaleY(-1); }
  .corner.br { bottom: -6px; right: -6px; transform: scale(-1,-1); }

  header {
    text-align: center;
    position: relative;
    padding-bottom: 18px;
    margin-bottom: 10px;
  }

  .flourish {
    display: block;
    height: 26px;
    margin: 0 auto 6px;
    opacity: 0.75;
  }

  h1 {
    font-family: 'UnifrakturMaguntia', 'Old English Text MT', 'Luminari', serif;
    font-size: clamp(2.6rem, 8vw, 4.4rem);
    font-weight: 400;
    letter-spacing: 2px;
    margin: 0;
    color: var(--ink);
    text-shadow: 1px 1px 0 rgba(184,159,116,0.6), 0 0 18px rgba(43,28,18,0.25);
  }

  .subrule {
    width: 65%;
    margin: 14px auto 0;
    border: none;
    border-top: 1px solid rgba(43,28,18,0.55);
    position: relative;
  }
  .subrule::after {
    content: "❦";
    position: absolute;
    left: 50%;
    top: -12px;
    transform: translateX(-50%);
    background: transparent;
    color: var(--ink-soft);
    font-size: 1.1rem;
    padding: 0 10px;
  }

  .drop-cap {
    float: left;
    font-family: 'UnifrakturMaguntia', serif;
    font-size: 3.4rem;
    line-height: 0.8;
    padding: 6px 10px 0 0;
    color: var(--ink);
  }

  p.lede {
    text-align: justify;
    line-height: 1.75;
    color: var(--ink-soft);
    font-size: 0.98rem;
    margin-top: 24px;
  }

  .content-note {
    margin-top: 40px;
    text-align: center;
    font-family: 'IM Fell English', serif;
    font-style: italic;
    color: var(--ink-soft);
    font-size: 0.95rem;
    opacity: 0.8;
  }
</style>
</head>
<body>

  <div class="sheet">
    <div class="stain s1"></div>
    <div class="stain s2"></div>
    <div class="stain s3"></div>
    <div class="stain s4"></div>

    <!-- floral corner ornaments -->
    <div class="corner tl">
      <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
        <path d="M6,6 C6,40 6,70 6,104" />
        <path d="M6,6 C40,6 70,6 104,6" />
        <path d="M6,20 C30,20 34,10 30,4" />
        <path d="M20,6 C20,30 10,34 4,30" />
        <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
        <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
        <circle class="bloom" cx="16" cy="16" r="3.2" />
        <circle class="bloom" cx="34" cy="8" r="2" />
        <circle class="bloom" cx="8" cy="34" r="2" />
        <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
      </svg>
    </div>
    <div class="corner tr">
      <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
        <path d="M6,6 C6,40 6,70 6,104" />
        <path d="M6,6 C40,6 70,6 104,6" />
        <path d="M6,20 C30,20 34,10 30,4" />
        <path d="M20,6 C20,30 10,34 4,30" />
        <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
        <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
        <circle class="bloom" cx="16" cy="16" r="3.2" />
        <circle class="bloom" cx="34" cy="8" r="2" />
        <circle class="bloom" cx="8" cy="34" r="2" />
        <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
      </svg>
    </div>
    <div class="corner bl">
      <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
        <path d="M6,6 C6,40 6,70 6,104" />
        <path d="M6,6 C40,6 70,6 104,6" />
        <path d="M6,20 C30,20 34,10 30,4" />
        <path d="M20,6 C20,30 10,34 4,30" />
        <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
        <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
        <circle class="bloom" cx="16" cy="16" r="3.2" />
        <circle class="bloom" cx="34" cy="8" r="2" />
        <circle class="bloom" cx="8" cy="34" r="2" />
        <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
      </svg>
    </div>
    <div class="corner br">
      <svg viewBox="0 0 110 110" xmlns="http://www.w3.org/2000/svg">
        <path d="M6,6 C6,40 6,70 6,104" />
        <path d="M6,6 C40,6 70,6 104,6" />
        <path d="M6,20 C30,20 34,10 30,4" />
        <path d="M20,6 C20,30 10,34 4,30" />
        <path d="M6,45 C26,45 40,38 34,22 C30,12 16,14 14,26 C12,38 24,44 34,36" />
        <path d="M45,6 C45,26 38,40 22,34 C12,30 14,16 26,14 C38,12 44,24 36,34" />
        <circle class="bloom" cx="16" cy="16" r="3.2" />
        <circle class="bloom" cx="34" cy="8" r="2" />
        <circle class="bloom" cx="8" cy="34" r="2" />
        <ellipse cx="24" cy="24" rx="5" ry="3" transform="rotate(45 24 24)" />
      </svg>
    </div>

    <header>
      <svg class="flourish" viewBox="0 0 300 30" xmlns="http://www.w3.org/2000/svg">
        <path d="M10,15 C60,-5 120,35 150,15 C180,-5 240,35 290,15" fill="none" stroke="#4a3626" stroke-width="1.5"/>
        <circle cx="150" cy="15" r="3" fill="#4a3626"/>
      </svg>
      <h1>Monster Battle</h1>
      <hr class="subrule">
    </header>

   <main>
        {{ $slot }}
    </main>

  </div>

</body>
</html>