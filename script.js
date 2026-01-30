alert("JS WORKING");

const container = document.getElementById("poster-container");

posters.forEach(item => {
  const box = document.createElement("a");
  box.href = "details.html?id=" + item.id;
  box.classList.add("poster");

  box.innerHTML = `
    <img src="./${item.image}" alt="poster">
    <h3>${item.title}</h3>
  `;

  container.appendChild(box);
});
