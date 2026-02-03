const perPage = 30;

const params = new URLSearchParams(window.location.search);
const page = parseInt(params.get("page")) || 1;

const container = document.getElementById("poster-container");

const start = (page - 1) * perPage;
const end = start + perPage;

const pagePosts = posters.slice(start, end);

pagePosts.forEach(item => {
  const a = document.createElement("a");
  a.href = "details.html?id=" + item.id;
  a.className = "poster";

  a.innerHTML = `
    <img src="${item.image}">
    <h3>${item.title}</h3>
  `;

  container.appendChild(a);
});

/* pagination */
const totalPages = Math.ceil(posters.length / perPage);

if (totalPages > 1) {
  const nav = document.createElement("div");
  nav.style.textAlign = "center";
  nav.style.margin = "15px";

  for (let i = 1; i <= totalPages; i++) {
    nav.innerHTML += `<a href="?page=${i}" style="margin:8px;font-weight:bold;">${i}</a>`;
  }

  document.body.appendChild(nav);
}
