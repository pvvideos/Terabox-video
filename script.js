const container = document.getElementById("poster-container");

posters.forEach(item => {
  const link = document.createElement("a");
  link.href = `details.html?id=${item.id}`;
  link.className = "poster";

  link.innerHTML = `
    <img src="${item.image}">
    <h3>${item.title}</h3>
  `;

  container.appendChild(link);
});
