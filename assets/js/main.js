/* INTRO ANIMATION CONTROL */
const intro = document.getElementById("intro");

if (intro) {
  if (sessionStorage.getItem("introPlayed")) {
    intro.remove();
  } else {
    sessionStorage.setItem("introPlayed", "true");
    setTimeout(() => {
      intro.style.opacity = "0";
      setTimeout(() => intro.remove(), 600);
    }, 3000);
  }
}

/* DARK MODE */
const toggle = document.getElementById("themeToggle");

if (toggle) {
  toggle.onclick = () => {
    const theme = document.documentElement.getAttribute("data-theme") === "dark"
      ? "light"
      : "dark";
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
  };
}

const saved = localStorage.getItem("theme");
if (saved) {
  document.documentElement.setAttribute("data-theme", saved);
}

/* SCROLL REVEAL */
const reveals = document.querySelectorAll(".reveal");

const revealOnScroll = () => {
  const trigger = window.innerHeight * 0.85;
  reveals.forEach(el => {
    if (el.getBoundingClientRect().top < trigger) {
      el.classList.add("active");
    }
  });
};

window.addEventListener("scroll", revealOnScroll);
window.addEventListener("load", revealOnScroll);
