// scroll progress bar
window.onscroll = function () {
  const scrollTop =
    document.documentElement.scrollTop || document.body.scrollTop;
  const scrollHeight =
    document.documentElement.scrollHeight -
    document.documentElement.clientHeight;
  const scrolled = (scrollTop / scrollHeight) * 100;
  document.getElementById("scrollProgress").style.width = scrolled + "%";
};

// Nav active
// Get url path
const currentPath = window.location.pathname;
const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

navLinks.forEach((link) => {
  const href = link.getAttribute("href");
  if (currentPath.endsWith(href)) {
    link.classList.add("active-page");
  }
});

// search event
function searchEvent() {
  const keyword = document.getElementById("searchInput").value;

  fetch(
    "/src/Components/Event/eventComponent.php?search=" +
      encodeURIComponent(keyword)
  )
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("event-container").innerHTML = html;
    })
    .catch((error) => console.error("Search error:", error));
}

// filter event by kategori
function filterKategori(kategori) {
  fetch("/src/Components/Event/eventComponent.php?kategori=" + kategori)
    .then((response) => response.text())
    .then((html) => {
      document.getElementById("event-container").innerHTML = html;
    })
    .catch((error) => console.error("Error:", error));
}

function sendToWhatsApp(event) {
  event.preventDefault(); // Mencegah reload

  const nama = document.getElementById("nama").value;
  const email = document.getElementById("email").value;
  const pesan = document.getElementById("pesan").value;

  const nomorWA = "6289681117903"; // Ganti dengan nomor Anda, tanpa +
  const message = `Hi! namaku ${nama} emaiku ${email}. Aku mau ngasih tau kalo ${pesan}`;

  const url = `https://wa.me/${nomorWA}?text=${encodeURIComponent(message)}`;
  window.open(url, "_blank"); // Buka WA di tab baru
}
